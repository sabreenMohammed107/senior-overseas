<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Financial_entry;
use App\Models\Bank;
use App\Models\Client;
use App\Models\Open_balance;
use App\Models\Currency;
use App\Models\Finan_trans_type;
use App\Models\Supplier;
use App\Models\Agent;
use App\Models\Cashbox_expenses_type;
use App\Models\Carrier;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Terbilang;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use PDF;

class SuppliersReport extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Client $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'supplier-report.';
        $this->routeName = 'supplier-report.';
        $this->message = 'The Data has been saved';
        $this->errormessage = 'check Your Data ';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cashExpenseOut = Cashbox_expenses_type::where('expense_type', '=', 2)->get();
        $filtters = [];
        $totals = [];
        $curs = [];
        return view($this->viewName . 'index', compact('cashExpenseOut', 'filtters', 'totals', 'curs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fristSelect = $request->input('selector_type');
        $xxselector = $request->input('xxselector');

        $from_date = Carbon::parse($request->input('from_date'));
        $to_date = Carbon::parse($request->input('to_date'));

        $filtters = Financial_entry::orderBy('currency_id','asc')->orderBy('entry_date','asc');

        if (!empty($request->get("from_date"))) {
            $filtters->where('entry_date', '>=', Carbon::parse($request->get("from_date")));
        }
        if (!empty($request->get("to_date"))) {
            $filtters->where('entry_date', '<=', Carbon::parse($request->get("to_date")));
        }
        if (!empty($request->get("selector_type")) && $fristSelect == 3) {
            if (!empty($request->get("xxselector"))) {
                $filtters->where('ocean_carrier_id', '=', $request->get("xxselector"));
            }
        }
        if (!empty($request->get("selector_type")) && $fristSelect == 4) {
            if (!empty($request->get("xxselector"))) {
                $filtters->where('air_carrier_id', '=', $request->get("xxselector"));
            }
        }

        if (!empty($request->get("selector_type")) && $fristSelect == 6) {
            if (!empty($request->get("xxselector"))) {
                $filtters->where('trucking_id', '=', $request->get("xxselector"));
            }
        }
        if (!empty($request->get("selector_type")) && $fristSelect == 5) {

            if (!empty($request->get("xxselector"))) {
                $filtters->where('clearance_id', '=', $request->get("xxselector"));
            }
        }
        if (!empty($request->get("selector_type")) && $fristSelect == 7) {
            if (!empty($request->get("xxselector"))) {
                $filtters->where('agent_id', '=', $request->get("xxselector"));
            }
        }

        if (!empty($request->get("selector_type")) && empty($request->get("xxselector"))) {
            $filtters->where('trans_type_id', '=', $request->get("selector_type"));
        }
        $filtters = $filtters->get();



        $curs = [];
        foreach ($filtters as $row) {
            $cur = $row->currency->currency_name;
            array_push($curs, $cur);
        }
        $curs = array_unique($curs);
        $totals = [];
        $total = 0;
        $cursIds = [];
        foreach ($filtters as $row) {
            $cursId = $row->currency_id;
            array_push($cursIds, $cursId);
        }
        $cursIds = array_unique($cursIds);




        foreach ($cursIds as $cur) {
            $total = 0;
            foreach ($filtters as $filtter) {
                if ($filtter->ocean_carrier_id) {
                    $total = Financial_entry::where('ocean_carrier_id', $xxselector)->where('currency_id', '=', $cur)->sum('depit') - Financial_entry::where('ocean_carrier_id', $xxselector)->where('currency_id', '=', $cur)->sum('credit');
                break;
                } elseif ($filtter->air_carrier_id) {
                    $total = Financial_entry::where('air_carrier_id', $xxselector)->where('currency_id', '=', $cur)->sum('depit') - Financial_entry::where('air_carrier_id', $xxselector)->where('currency_id', '=', $cur)->sum('credit');
                break;
                } elseif ($filtter->trucking_id) {
                    $total = Financial_entry::where('trucking_id', $xxselector)->where('currency_id', '=', $cur)->sum('depit') - Financial_entry::where('trucking_id', $xxselector)->where('currency_id', '=', $cur)->sum('credit');
                break;
                } elseif ($filtter->clearance_id) {
                    $total = Financial_entry::where('clearance_id', $xxselector)->where('currency_id', '=', $cur)->sum('depit') - Financial_entry::where('clearance_id', $xxselector)->where('currency_id', '=', $cur)->sum('credit');
                break;
                } elseif ($filtter->agent_id) {
                    $total = Financial_entry::where('agent_id', $xxselector)->where('currency_id', '=', $cur)->sum('depit') - Financial_entry::where('agent_id', $xxselector)->where('currency_id', '=', $cur)->sum('credit');
                break;
                } else {
                    $total = Financial_entry::where('trans_type_id', $request->get("selector_type"))->where('currency_id', '=', $cur)->sum('depit') - Financial_entry::where('trans_type_id', $request->get("selector_type"))->where('currency_id', '=', $cur)->sum('credit');
                break;
                }
            }
            //  $total = Financial_entry::where('client_id', $client_id)->where('currency_id', '=', $cur)->sum('credit') - Financial_entry::where('client_id', $client_id)->where('currency_id', '=', $cur)->sum('depit');

            $name = Currency::where('id', '=', $cur)->first();
            $totalNum = $total;
            $total = Terbilang::make($total, " -  $name->currency_name");
            $obj = new Collection();
            $obj->cur = $name->currency_name;
            $obj->total = strtoupper($total);
            $obj->num = $totalNum;

            array_push($totals, $obj);
        }
        $cashExpenseOut = Cashbox_expenses_type::where('expense_type', '=', 2)->get();

        return view($this->viewName . 'report', compact('cashExpenseOut', 'filtters', 'curs', 'totals'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function fetchReport(Request $request)
    {
        $fristSelect = $request->input('selector_type');
        $xxselector = $request->input('xxselector');

        $from_date =$request->input('from_date');
        $to_date =$request->input('to_date');

        $filtters = Financial_entry::orderBy('currency_id','asc')->orderBy('entry_date','asc');

        if (!empty($request->get("from_date"))) {
            $filtters->where('entry_date', '>=', Carbon::parse($request->get("from_date")));
        }
        if (!empty($request->get("to_date"))) {
            $filtters->where('entry_date', '<=', Carbon::parse($request->get("to_date")));
        }
        if (!empty($request->get("selector_type")) && $fristSelect == 3) {
            if (!empty($request->get("xxselector"))) {
                $filtters->where('ocean_carrier_id', '=', $request->get("xxselector"));
            }
        }
        if (!empty($request->get("selector_type")) && $fristSelect == 4) {
            if (!empty($request->get("xxselector"))) {
                $filtters->where('air_carrier_id', '=', $request->get("xxselector"));
            }
        }

        if (!empty($request->get("selector_type")) && $fristSelect == 6) {
            if (!empty($request->get("xxselector"))) {
                $filtters->where('trucking_id', '=', $request->get("xxselector"));
            }
        }
        if (!empty($request->get("selector_type")) && $fristSelect == 5) {

            if (!empty($request->get("xxselector"))) {
                $filtters->where('clearance_id', '=', $request->get("xxselector"));
            }
        }
        if (!empty($request->get("selector_type")) && $fristSelect == 7) {
            if (!empty($request->get("xxselector"))) {
                $filtters->where('agent_id', '=', $request->get("xxselector"));
            }
        }

        if (!empty($request->get("selector_type")) && empty($request->get("xxselector"))) {
            $filtters->where('trans_type_id', '=', $request->get("selector_type"));
        }
        $filtters = $filtters->get();



        $curs = [];
        foreach ($filtters as $row) {
            $cur = $row->currency->currency_name;
            array_push($curs, $cur);
        }
        $curs = array_unique($curs);
        $totals = [];
        $total = 0;
        $cursIds = [];
        foreach ($filtters as $row) {
            $cursId = $row->currency_id;
            array_push($cursIds, $cursId);
        }
        $cursIds = array_unique($cursIds);




        foreach ($cursIds as $cur) {
            $total = 0;
            $objname='';
            foreach ($filtters as $filtter) {
                if ($filtter->ocean_carrier_id) {
                    $total = Financial_entry::where('ocean_carrier_id', $xxselector)->where('currency_id', '=', $cur)->sum('depit') - Financial_entry::where('ocean_carrier_id', $xxselector)->where('currency_id', '=', $cur)->sum('credit');
                    $obj=Carrier::where('id', '=', $request->input('xxselector'))->first();
                    $objname=$obj->carrier_name;

                break;
                } elseif ($filtter->air_carrier_id) {
                    $total = Financial_entry::where('air_carrier_id', $xxselector)->where('currency_id', '=', $cur)->sum('depit') - Financial_entry::where('air_carrier_id', $xxselector)->where('currency_id', '=', $cur)->sum('credit');
                    $obj=Carrier::where('id', '=', $request->input('xxselector'))->first();
                    $objname=$obj->carrier_name;

                break;
                } elseif ($filtter->trucking_id) {
                    $total = Financial_entry::where('trucking_id', $xxselector)->where('currency_id', '=', $cur)->sum('depit') - Financial_entry::where('trucking_id', $xxselector)->where('currency_id', '=', $cur)->sum('credit');
                    $obj=Supplier::where('id', '=', $request->input('xxselector'))->first();
                    $objname=$obj->supplier_name;
                break;
                } elseif ($filtter->clearance_id) {
                    $total = Financial_entry::where('clearance_id', $xxselector)->where('currency_id', '=', $cur)->sum('depit') - Financial_entry::where('clearance_id', $xxselector)->where('currency_id', '=', $cur)->sum('credit');
                    $obj=Supplier::where('id', '=', $request->input('xxselector'))->first();
                    $objname=$obj->supplier_name;
                break;
                } elseif ($filtter->agent_id) {
                    $total = Financial_entry::where('agent_id', $xxselector)->where('currency_id', '=', $cur)->sum('depit') - Financial_entry::where('agent_id', $xxselector)->where('currency_id', '=', $cur)->sum('credit');
                    $obj=Agent::where('id', '=', $request->input('xxselector'))->first();
                    $objname=$obj->agent_name;
                break;
                } else {
                    $total = Financial_entry::where('trans_type_id',$request->get("selector_type"))->where('currency_id', '=', $cur)->sum('depit') - Financial_entry::where('trans_type_id',$request->get("selector_type"))->where('currency_id', '=', $cur)->sum('credit');
                    $obj=Finan_trans_type::where('id', '=', $request->get("selector_type"))->first();
                    $objname=$obj->trans_type;

                break;
                }
            }
            //  $total = Financial_entry::where('client_id', $client_id)->where('currency_id', '=', $cur)->sum('credit') - Financial_entry::where('client_id', $client_id)->where('currency_id', '=', $cur)->sum('depit');

            $name = Currency::where('id', '=', $cur)->first();
            $totalNum = $total;
            $total = Terbilang::make($total, " -  $name->currency_name");
            $obj = new Collection();
            $obj->cur = $name->currency_name;
            $obj->total = strtoupper($total);
            $obj->num = $totalNum;

            array_push($totals, $obj);
        }


        $finance_type=Finan_trans_type::where('id','=',$request->input('selector_type'))->first();
        $data = [
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points.info',
            'filtters' => $filtters,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'selection' =>$finance_type->trans_type,
            'name'=>$objname,
            'curs' => $curs,
            'totals' => $totals,
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.'
        ];


        $title = "My Report";
        $pdf = PDF::loadView($this->viewName . 'supplierReport', $data);
        return $pdf->stream('medium.pdf'); // to open in blank page
    }
    function selector_type(Request $request)
    {
        $dataAjax = array();
        $select = $request->get('select');
        $value = $request->get('value');
        $cash = $request->get('cash');
        $data = [];
        switch ($value) {
            case 3:
                $data = Carrier::where('carrier_type_id', '=', 1)->get();

                break;
            case 4:
                $data = Carrier::where('carrier_type_id', '=', 2)->get();

                break;
            case 5:
                $data = Supplier::where('supplier_type_id', '=', 2)->get();

                break;
            case 6:
                $data = Supplier::where('supplier_type_id', '=', 1)->get();

                break;
            case 7:
                $data = Agent::all();

                break;

            default:
                break;
        }

        $output = '<option value="">Select </option>';

        foreach ($data as $row) {
            if ($value == 3 || $value == 4) {
                $output .= '<option value="' . $row->id . '">' . $row->carrier_name . '</option>';
            }
            if ($value == 5 || $value == 6) {
                $output .= '<option value="' . $row->id . '">' . $row->supplier_name . '</option>';
            }
            if ($value == 7) {
                $output .= '<option value="' . $row->id . '">' . $row->agent_name . '</option>';
            }
        }

        echo $output;
    }
}
