<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use Illuminate\Http\Request;
use App\Models\Financial_entry;
use App\Models\Cash_box;
use App\Models\Client;
use App\Models\Open_balance;
use App\Models\Currency;
use App\Models\Finan_trans_type;
use App\Models\Supplier;
use App\Models\Agent;
use App\Models\Bank;
use App\Models\Cashbox_expenses_type;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class CashFinanceController extends Controller
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
        $this->viewName = 'cash-finance.';
        $this->routeName = 'cash-finance.';
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
        $rows = Cash_box::orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'index', compact('rows'));
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
     * Adding with id
     */
    public function addCashFinance($id)
    {
        $Selectrow = Cash_box::where('id', '=', $id)->first();
        $currentBalance = Financial_entry::where('cash_box_id', $Selectrow->id)->sum('depit') - Financial_entry::where('cash_box_id', $Selectrow->id)->sum('credit');

        $clients = Client::all();
        $cashExpenseIn = Cashbox_expenses_type::where('expense_type', '=', 1)->get();
        $cashExpenseOut = Cashbox_expenses_type::where('expense_type', '=', 2)->get();
        $Cashes = Cash_box::where('id', '!=', $id)->get();
        $banks=Bank::all();
        return view($this->viewName . 'add', compact('Selectrow', 'clients', 'currentBalance', 'Cashes', 'cashExpenseOut', 'cashExpenseIn' ,'banks'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //save in finance entry


        if ($request->input('tab') == 2) {
            $obj = new Financial_entry();

            $obj->trans_type_id = Finan_trans_type::where('id', '=', 2)->first()->id;
            $obj->entry_date = Carbon::parse($request->input('entry_date'));
            $obj->depit = $request->input('depit');
            $obj->currency_id = $request->input('currency_id');
            $obj->cash_box_id = $request->input('cash_box_id');
            $obj->notes = $request->input('notesIn');
            $Clientdata = 0;
            if ($request->input('client_id')) {
                $obj->client_id = $request->input('client_id');
                $Clientdata = Financial_entry::where('client_id', $request->input('client_id'))->where('currency_id', '=', $request->input('currency_id'))->sum('credit') - Financial_entry::where('client_id', $request->input('client_id'))->where('currency_id', '=', $request->input('currency_id'))->sum('depit');
                // if ($request->input('depit') > $Clientdata) {
                //     return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
                // }
            }
        }
        if ($request->input('tab') == 1) {
            $fristSelect = $request->input('selector_type');
            $obj = new Financial_entry();
            $obj->trans_type_id = Finan_trans_type::where('id', '=', $request->input('selector_type'))->first()->id;
            $obj->entry_date = Carbon::parse($request->input('entry_date'));
            $obj->credit = $request->input('credit');
            $obj->currency_id = $request->input('currency_id');
            $obj->cash_box_id = $request->input('cash_box_id');
            $obj->notes = $request->input('notesOut');
            $data = 0;
            if ($fristSelect == 3) {
                $obj->ocean_carrier_id = $request->input('xxselector');
                $data = Financial_entry::where('ocean_carrier_id',  $request->input('xxselector'))->where('currency_id', '=', $request->input('currency_id'))->sum('depit') - Financial_entry::where('ocean_carrier_id', $request->input('xxselector'))->where('currency_id', '=', $request->input('currency_id'))->sum('credit');
                // if ($request->input('credit') > $data) {
                //     return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
                // }
            }
            if ($fristSelect == 4) {
                $obj->air_carrier_id = $request->input('xxselector');
                $data = Financial_entry::where('air_carrier_id',  $request->input('xxselector'))->where('currency_id', '=', $request->input('currency_id'))->sum('depit') - Financial_entry::where('air_carrier_id', $request->input('xxselector'))->where('currency_id', '=', $request->input('currency_id'))->sum('credit');
                // if ($request->input('credit') > $data) {
                //     return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
                // }
            }

            if ($fristSelect == 6) {
                $obj->trucking_id = $request->input('xxselector');
                $data = Financial_entry::where('trucking_id',  $request->input('xxselector'))->where('currency_id', '=', $request->input('currency_id'))->sum('depit') - Financial_entry::where('trucking_id', $request->input('xxselector'))->where('currency_id', '=', $request->input('currency_id'))->sum('credit');
                // if ($request->input('credit') > $data) {
                //     return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
                // }
            }
            if ($fristSelect == 5) {
                $obj->clearance_id = $request->input('xxselector');
                $data = Financial_entry::where('clearance_id', $request->input('xxselector'))->where('currency_id', '=', $request->input('currency_id'))->sum('depit') - Financial_entry::where('clearance_id', $request->input('xxselector'))->where('currency_id', '=', $request->input('currency_id'))->sum('credit');
                // if ($request->input('credit') > $data) {
                //     return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
                // }
            }
            if ($fristSelect == 7) {
                $obj->agent_id = $request->input('xxselector');
                $data = Financial_entry::where('agent_id', $request->input('xxselector'))->where('currency_id', '=', $request->input('currency_id'))->sum('depit') - Financial_entry::where('agent_id', $request->input('xxselector'))->where('currency_id', '=', $request->input('currency_id'))->sum('credit');
                // if ($request->input('credit') > $data) {
                //     return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
                // }
            }
        }

        if ($request->input('tab') == 2 || $request->input('tab') == 1) {
            $currentBalance = Financial_entry::where('cash_box_id', $request->input('cash_box_id'))->sum('depit') - Financial_entry::where('cash_box_id', $request->input('cash_box_id'))->sum('credit');

            // if ($request->input('credit') > $currentBalance) {

            //     return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
            // } else {
                DB::transaction(function () use ($obj,  $request) {

                    $obj->save();
                });
            // }
            return redirect()->route($this->routeName . 'show', $request->input('cash_box_id'))->with('flash_success', $this->message);
        }
        //cash exchanger
        if ($request->input('tab') == 3) {
            $currentBalanceexchanger = Financial_entry::where('cash_box_id', $request->input('cash_box_id'))->sum('depit') - Financial_entry::where('cash_box_id', $request->input('cash_box_id'))->sum('credit');
            $exchanger = new Financial_entry();
            $exchanger->trans_type_id = Finan_trans_type::where('id', '=', 20)->first()->id;
            $exchanger->entry_date = Carbon::parse($request->input('entry_date'));
            $exchanger->credit = $request->input('amountOut');
            $exchanger->currency_id = $request->input('currency_id');
            $exchanger->cash_box_id = $request->input('cash_box_id');
            $exchanger->notes = $request->input('notesexchanger');


            $exchangerIn = new Financial_entry();
            $exchangerIn->trans_type_id = Finan_trans_type::where('id', '=', 20)->first()->id;
            $exchangerIn->entry_date = Carbon::parse($request->input('entry_date'));
            $exchangerIn->depit = $request->input('amountIn');
            $exchangerIn->currency_id = Cash_box::where('id', '=', $request->input('CashBoxes_inOut'))->first()->currency_id;
            $exchangerIn->cash_box_id = $request->input('CashBoxes_inOut');

            $exchangerIn->notes = $request->input('notesexchanger');

            // if ($request->input('amountOut') > $currentBalanceexchanger) {

            //     return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
            // } else {
                DB::beginTransaction();
                try {
                    // Disable foreign key checks!
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

                    $exchanger->save();

                    $exchangerIn->parent_id = $exchanger->id;
                    \Log::info($exchangerIn);
                    $exchangerIn->save();


                    DB::commit();
                    // Enable foreign key checks!
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                    return redirect()->route($this->routeName . 'show', $request->input('cash_box_id'))->with('flash_success', $this->message);
                } catch (\Throwable $e) {
                    // throw $th;
                    DB::rollback();

                    return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
                }
            // }
            return redirect()->route($this->routeName . 'show', $request->input('cash_box_id'))->with('flash_success', $this->message);
        }
        //bank exchanger
        if ($request->input('tab') == 4) {
            $currentBalanceexchanger = Financial_entry::where('cash_box_id', $request->input('cash_box_id'))->sum('depit') - Financial_entry::where('cash_box_id', $request->input('cash_box_id'))->sum('credit');
            $exchanger = new Financial_entry();
            $exchanger->trans_type_id = Finan_trans_type::where('id', '=', 21)->first()->id;
            $exchanger->entry_date = Carbon::parse($request->input('entry_date'));
            $exchanger->credit = $request->input('amountOutBank');
            $exchanger->currency_id = $request->input('currency_id');
            $exchanger->cash_box_id = $request->input('cash_box_id');
            $exchanger->notes = $request->input('notesexchangerBank');


            $exchangerIn = new Financial_entry();
            $exchangerIn->trans_type_id = Finan_trans_type::where('id', '=', 21)->first()->id;
            $exchangerIn->entry_date = Carbon::parse($request->input('entry_date'));
            $exchangerIn->depit = $request->input('amountInBank');
            $exchangerIn->currency_id = Bank::where('id', '=', $request->input('banks_inOut'))->first()->currency_id;
            $exchangerIn->bank_account_id = $request->input('banks_inOut');

            $exchangerIn->notes = $request->input('notesexchangerBank');

            // if ($request->input('amountOut') > $currentBalanceexchanger) {

            //     return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
            // } else {
                DB::beginTransaction();
                try {
                    // Disable foreign key checks!
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

                    $exchanger->save();

                    $exchangerIn->parent_id = $exchanger->id;
                    \Log::info($exchangerIn);
                    $exchangerIn->save();


                    DB::commit();
                    // Enable foreign key checks!
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                    return redirect()->route($this->routeName . 'show', $request->input('cash_box_id'))->with('flash_success', $this->message);
                } catch (\Throwable $e) {
                    // throw $th;
                    DB::rollback();

                    return redirect()->back()->withInput()->with('flash_danger', $e->getMessage());
                }
            // }
            return redirect()->route($this->routeName . 'show', $request->input('cash_box_id'))->with('flash_success', $this->message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Selectrow = Cash_box::where('id', '=', $id)->first();
        $currentBalance = Financial_entry::where('cash_box_id', $Selectrow->id)->sum('depit') - Financial_entry::where('cash_box_id', $Selectrow->id)->sum('credit');

        $rows = Financial_entry::where('cash_box_id', '=', $id)->orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'select', compact('Selectrow', 'rows', 'currentBalance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editrow = Financial_entry::where('id', '=', $id)->first();
        $Selectrow = Cash_box::where('id', '=', $editrow->cash_box_id)->first();
        $currentBalance = Financial_entry::where('cash_box_id', $Selectrow->id)->sum('depit') - Financial_entry::where('cash_box_id', $Selectrow->id)->sum('credit');

        $clients = Client::all();
        $dataClient = 0;
        $dataOther = 0;
        if ($editrow->client_id) {
            $dataClient = Financial_entry::where('client_id', $editrow->client_id)->where('currency_id', '=', $editrow->currency_id)->sum('credit') - Financial_entry::where('client_id', $editrow->client_id)->where('currency_id', '=', $editrow->currency_id)->sum('depit');
        }
        if ($editrow->ocean_carrier_id) {
            $dataOther = Financial_entry::where('ocean_carrier_id', $editrow->ocean_carrier_id)->where('currency_id', '=', $editrow->currency_id)->sum('depit') - Financial_entry::where('ocean_carrier_id', $editrow->ocean_carrier_id)->where('currency_id', '=', $editrow->currency_id)->sum('credit');
        }
        if ($editrow->air_carrier_id) {
            $dataOther = Financial_entry::where('air_carrier_id', $editrow->air_carrier_id)->where('currency_id', '=', $editrow->currency_id)->sum('depit') - Financial_entry::where('air_carrier_id', $editrow->air_carrier_id)->where('currency_id', '=', $editrow->currency_id)->sum('credit');
        }
        if ($editrow->trucking_id) {
            $dataOther = Financial_entry::where('trucking_id', $editrow->trucking_id)->where('currency_id', '=', $editrow->currency_id)->sum('depit') - Financial_entry::where('trucking_id', $editrow->trucking_id)->where('currency_id', '=', $editrow->currency_id)->sum('credit');
        }
        if ($editrow->clearance_id) {
            $dataOther = Financial_entry::where('clearance_id', $editrow->clearance_id)->where('currency_id', '=', $editrow->currency_id)->sum('depit') - Financial_entry::where('clearance_id', $editrow->clearance_id)->where('currency_id', '=', $editrow->currency_id)->sum('credit');
        }
        if ($editrow->agent_id) {
            $dataOther = Financial_entry::where('agent_id', $editrow->agent_id)->where('currency_id', '=', $editrow->currency_id)->sum('depit') - Financial_entry::where('agent_id', $editrow->agent_id)->where('currency_id', '=', $editrow->currency_id)->sum('credit');
        }

        $cashExpenseIn = Cashbox_expenses_type::where('id', '=', $editrow->trans_type_id)->where('expense_type', '=', 1)->first();

        $cashExpenseOut = Cashbox_expenses_type::where('id', '=', $editrow->trans_type_id)->where('expense_type', '=', 2)->first();
        $Cashes = Cash_box::where('id', '!=', $Selectrow->id)->get();
        $cashesObj = Financial_entry::where('parent_id', $id)->first();
        $banks=Bank::all();
        $cashesObjBank= Financial_entry::where('parent_id', $id)->first();
        return view($this->viewName . 'edit', compact('editrow', 'cashesObj','banks', 'cashesObjBank','Selectrow', 'Cashes', 'clients', 'dataOther', 'currentBalance', 'dataClient', 'cashExpenseIn', 'cashExpenseOut'));
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
        $obj = $this->object::findOrFail($id);
        //save in finance entry
        if ($request->input('tab') == 2) {



            $obj->entry_date = Carbon::parse($request->input('entry_date'));
            $diffetant = $request->input('depit') - $obj->depit;
            $obj->depit = $obj->depit + $diffetant;

            $obj->notes = $request->input('notes');
            $Clientdata = Financial_entry::where('client_id', $obj->client_id)->where('currency_id', '=', $obj->currency_id)->sum('credit') - Financial_entry::where('client_id', $obj->client_id)->where('currency_id', '=', $obj->currency_id)->sum('depit');

            $currentBalance = Financial_entry::where('cash_box_id', $obj->cash_box_id)->sum('depit') - Financial_entry::where('cash_box_id', $obj->cash_box_id)->sum('credit');

            // if ($diffetant  > $Clientdata || $diffetant > $currentBalance) {

                // return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
            // } else {
                $obj->update();




                return redirect()->route($this->routeName . 'show', $request->input('cash_box_id'))->with('flash_success', $this->message);
            // }
        }
        if ($request->input('tab') == 1) {


            $obj->entry_date = Carbon::parse($request->input('entry_date'));
            $diffetant = $request->input('credit') - $obj->credit;
            $obj->credit = $obj->credit + $diffetant;
            $obj->notes = $request->input('notes');
            $currentBalance = Financial_entry::where('cash_box_id', $obj->cash_box_id)->sum('depit') - Financial_entry::where('cash_box_id', $obj->cash_box_id)->sum('credit');

            if ($obj->ocean_carrier_id) {

                $data = Financial_entry::where('ocean_carrier_id',  $obj->ocean_carrier_id)->where('currency_id', '=', $obj->cash_box_id)->sum('depit') - Financial_entry::where('ocean_carrier_id', $request->input('xxselector'))->where('currency_id', '=', $obj->cash_box_id)->sum('credit');
            }
            if ($obj->air_carrier_id) {

                $data = Financial_entry::where('air_carrier_id', $obj->air_carrier_id)->where('currency_id', '=', $obj->cash_box_id)->sum('depit') - Financial_entry::where('air_carrier_id', $request->input('xxselector'))->where('currency_id', '=', $obj->cash_box_id)->sum('credit');
            }

            if ($obj->trucking_id) {

                $data = Financial_entry::where('trucking_id', $obj->trucking_id)->where('currency_id', '=', $obj->cash_box_id)->sum('depit') - Financial_entry::where('trucking_id', $request->input('xxselector'))->where('currency_id', '=', $obj->cash_box_id)->sum('credit');
            }
            if ($obj->clearance_id) {

                $data = Financial_entry::where('clearance_id', $obj->clearance_id)->where('currency_id', '=', $obj->cash_box_id)->sum('depit') - Financial_entry::where('clearance_id', $request->input('xxselector'))->where('currency_id', '=', $obj->cash_box_id)->sum('credit');
            }
            if ($obj->agent_id) {

                $data = Financial_entry::where('agent_id', $obj->agent_id)->where('currency_id', '=', $obj->cash_box_id)->sum('depit') - Financial_entry::where('agent_id', $obj->agent_id)->where('currency_id', '=', $obj->cash_box_id)->sum('credit');
            }


            $currentBalance = Financial_entry::where('cash_box_id', $obj->cash_box_id)->sum('depit') - Financial_entry::where('cash_box_id', $obj->cash_box_id)->sum('credit');


            // if ($diffetant  > $currentBalance || $diffetant > $currentBalance) {

                // return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
            // } else {
                $obj->update();




                return redirect()->route($this->routeName . 'show', $request->input('cash_box_id'))->with('flash_success', $this->message);
            // }
        }
        if ($request->input('tab') == 3) {
            $cashObj = $this->object::findOrFail($id);
            $cashObj->entry_date = Carbon::parse($request->input('entry_date'));
            $diffetant = $request->input('amountOut') - $cashObj->credit;
            $cashObj->credit = $cashObj->credit + $diffetant;
            $cashObj->notes = $request->input('notesexchanger');
            $currentBalance = Financial_entry::where('cash_box_id', $cashObj->cash_box_id)->sum('depit') - Financial_entry::where('cash_box_id', $cashObj->cash_box_id)->sum('credit');

            \Log::info([$cashObj->credit, $currentBalance + $diffetant]);
            // if ($diffetant  > $currentBalance) {

                // return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
            // } else {

                $cashObj->update();
                $secondCash = Financial_entry::where('parent_id', $id)->first();
                $secondCash->entry_date = Carbon::parse($request->input('entry_date'));
                $diffetant = $request->input('amountIn') - $secondCash->depit;
                $secondCash->depit = $secondCash->depit + $diffetant;
                $secondCash->notes = $request->input('notesexchanger');

                $secondCash->update();

                return redirect()->route($this->routeName . 'show', $request->input('cash_box_id'))->with('flash_success', $this->message);
            // }
        }
        if ($request->input('tab') == 4) {
            $cashesObjBank = $this->object::findOrFail($id);
            $cashesObjBank->entry_date = Carbon::parse($request->input('entry_date'));
            $diffetant = $request->input('amountOutBank') - $cashesObjBank->credit;
            $cashesObjBank->credit = $cashesObjBank->credit + $diffetant;
            $cashesObjBank->notes = $request->input('notesexchangerBank');
            $currentBalance = Financial_entry::where('cash_box_id', $cashesObjBank->cash_box_id)->sum('depit') - Financial_entry::where('cash_box_id', $cashesObjBank->cash_box_id)->sum('credit');

            \Log::info([$cashesObjBank->credit, $currentBalance + $diffetant]);
            // if ($diffetant  > $currentBalance) {

                // return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
            // } else {

                $cashesObjBank->update();
                $secondCash = Financial_entry::where('parent_id', $id)->first();
                $secondCash->entry_date = Carbon::parse($request->input('entry_date'));
                $diffetant = $request->input('amountInBank') - $secondCash->depit;
                $secondCash->depit = $secondCash->depit + $diffetant;
                $secondCash->notes = $request->input('notesexchangerBank');

                $secondCash->update();

                return redirect()->route($this->routeName . 'show', $request->input('cash_box_id'))->with('flash_success', $this->message);
            // }
        }

        // return redirect()->route($this->routeName . 'show', $request->input('cash_box_id'))->with('flash_success', $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Financial_entry::where('id', '=', $id)->first();

        try {
            $row->delete();
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->back()->with('flash_success', 'Data Has Been Deleted Successfully !');
    }

    function clientSelect(Request $request)
    {
        $dataAjax = array();
        $select = $request->get('select');
        $value = $request->get('value');
        $cash = $request->get('cash');
        $clients = Open_balance::where('client_id', '=', $value)->get();
        $clients = Financial_entry::where('client_id', $value)->get();
        foreach ($clients as $client) {

            if ($cash == $client->currency_id) {

                $data = Financial_entry::where('client_id', $value)->where('currency_id', '=', $cash)->sum('credit') - Financial_entry::where('client_id', $value)->where('currency_id', '=', $cash)->sum('depit');
                break;
            } else {

                $data = 0;
            }
        }


        $currency = Currency::where('id', '=', $cash)->first()->currency_name;

        array_push($dataAjax, $data);
        array_push($dataAjax, $currency);

        return ($dataAjax);
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


    function SelectionSelect(Request $request)
    {
        $dataAjax = array();
        $select = $request->get('select');
        $value = $request->get('value');
        $cash = $request->get('cash');
        $fristSelect = $request->get('fristSelect');

        if ($fristSelect == 3 || $fristSelect == 4) {
            $rows = Open_balance::where('carrier_id', '=', $value)->get();
        }
        if ($fristSelect == 5 || $fristSelect == 6) {
            $rows = Open_balance::where('supplier_id', '=', $value)->get();
        }
        if ($fristSelect == 7) {
            $rows = Open_balance::where('agent_id', '=', $value)->get();
        }
        //  foreach ($rows as $row) {

        //         if ($cash==$row->currency_id) {
        $data = 0;
        if ($fristSelect == 3) {
            $data = Financial_entry::where('ocean_carrier_id', $value)->where('currency_id', '=', $cash)->sum('depit') - Financial_entry::where('ocean_carrier_id', $value)->where('currency_id', '=', $cash)->sum('credit');
        }
        if ($fristSelect == 4) {
            $data = Financial_entry::where('air_carrier_id', $value)->where('currency_id', '=', $cash)->sum('depit') - Financial_entry::where('air_carrier_id', $value)->where('currency_id', '=', $cash)->sum('credit');
        }

        if ($fristSelect == 5) {
            $data = Financial_entry::where('clearance_id', $value)->where('currency_id', '=', $cash)->sum('depit') - Financial_entry::where('clearance_id', $value)->where('currency_id', '=', $cash)->sum('credit');
        }
        if ($fristSelect == 6) {
            $data = Financial_entry::where('trucking_id', $value)->where('currency_id', '=', $cash)->sum('depit') - Financial_entry::where('trucking_id', $value)->where('currency_id', '=', $cash)->sum('credit');
        }
        if ($fristSelect == 7) {
            $data = Financial_entry::where('agent_id', $value)->where('currency_id', '=', $cash)->sum('depit') - Financial_entry::where('agent_id', $value)->where('currency_id', '=', $cash)->sum('credit');
        }
        //     $xx=10;
        //     break;
        // } else {
        //     $data = 0;
        // }
        // }

        $currency = Currency::where('id', '=', $cash)->first()->currency_name;

        array_push($dataAjax, $data);
        array_push($dataAjax, $currency);

        return ($dataAjax);
    }
}
