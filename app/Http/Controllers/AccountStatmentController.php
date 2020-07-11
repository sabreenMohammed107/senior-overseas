<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank_account;
use App\Models\Currency;
use App\Models\Financial_entry;
use App\Models\Finan_trans_type;
use App\Models\Cashbox_expenses_type;
use App\Models\Carrier;
use App\Models\Supplier;
use App\Models\Agent;
use App\Models\Client;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class AccountStatmentController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Financial_entry $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'account-statment.';
        $this->routeName = 'account-statment.';
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
        $Finantypes =Cashbox_expenses_type::all();
        $currencies = Currency::all();
        $filtters = [];
        $current_balance=0;
        return view($this->viewName . 'index', compact('Finantypes', 'currencies', 'filtters','current_balance'));
    }


    function selector_type(Request $request)
    {
        $dataAjax = array();
        $select = $request->get('select');
        $value = $request->get('value');

        $data = [];
        switch ($value) {
            case 2:
                $data = Client::all();

                break;
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
            if ($value == 2) {
                $output .= '<option value="' . $row->id . '">' . $row->client_name . '</option>';
            }
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
       
        $current_balance=0;
        $Finantypes = cashbox_expenses_type::all();
        $currencies = Currency::all();

        $filtters = Financial_entry::orderBy("created_at", "Desc");

        if (!empty($request->get("from"))) {
            $filtters->where('entry_date', '>=', Carbon::parse($request->get("from")));
        }
        if (!empty($request->get("to"))) {
            $filtters->where('entry_date', '<=', Carbon::parse($request->get("to")));
        }
        if (!empty($request->get("currency_id"))) {

            $filtters->where('currency_id', '=', $request->get("currency_id"));
        }

        if (!empty($request->get("selector_type"))) {

            if (!empty($request->get("xxselector"))) {
                if ($request->get("selector_type") == 2) {

                    $filtters->where('client_id', '=', $request->get("xxselector"));
                    $current_balance =  Financial_entry::where('client_id', $request->get("xxselector"))->where('currency_id', $request->get("currency_id"))->sum('credit')-Financial_entry::where('client_id', $request->get("xxselector"))->where('currency_id', $request->get("currency_id"))->sum('depit') ;

                }
                if ($request->get("selector_type") == 3) {

                    $filtters->where('ocean_carrier_id', '=', $request->get("xxselector"));
                    $current_balance = Financial_entry::where('ocean_carrier_id', $request->get("xxselector"))->where('currency_id', $request->get("currency_id"))->sum('depit') - Financial_entry::where('ocean_carrier_id', $request->get("xxselector"))->where('currency_id', $request->get("currency_id"))->sum('credit');

                }
                if ($request->get("selector_type") == 4) {

                    $filtters->where('air_carrier_id', '=', $request->get("xxselector"));
                    $current_balance = Financial_entry::where('air_carrier_id', $request->get("xxselector"))->where('currency_id', $request->get("currency_id"))->sum('depit') - Financial_entry::where('air_carrier_id', $request->get("xxselector"))->where('currency_id', $request->get("currency_id"))->sum('credit');

                }

                if ($request->get("selector_type") == 5) {

                    $filtters->where('trucking_id', '=', $request->get("xxselector"));
                    $current_balance = Financial_entry::where('trucking_id', $request->get("xxselector"))->where('currency_id', $request->get("currency_id"))->sum('depit') - Financial_entry::where('trucking_id', $request->get("xxselector"))->where('currency_id', $request->get("currency_id"))->sum('credit');

                }
                if ($request->get("selector_type") == 6) {

                    $filtters->where('clearance_id', '=', $request->get("xxselector"));
                    $current_balance = Financial_entry::where('clearance_id', $request->get("xxselector"))->where('currency_id', $request->get("currency_id"))->sum('depit') - Financial_entry::where('clearance_id', $request->get("xxselector"))->where('currency_id', $request->get("currency_id"))->sum('credit');

                }
                if ($request->get("selector_type") == 7) {

                    $filtters->where('agent_id', '=', $request->get("xxselector"));
                    $current_balance = Financial_entry::where('agent_id', $request->get("xxselector"))->where('currency_id', $request->get("currency_id"))->sum('depit') - Financial_entry::where('agent_id', $request->get("xxselector"))->where('currency_id', $request->get("currency_id"))->sum('credit');

                }
            }else{
             $filtters->where('trans_type_id', '=', $request->get("selector_type"));

            }

            $filtters = $filtters->get();
        }
      

 
        return view($this->viewName . 'search', compact('Finantypes', 'currencies', 'filtters','current_balance'))->render();
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
}
