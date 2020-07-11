<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank_account;
use App\Models\Currency;
use App\Models\Financial_entry;
use App\Models\Finan_trans_type;
use App\Models\cashbox_expenses_type;
use App\Models\Carrier;
use App\Models\Supplier;
use App\Models\Agent;
use App\Models\Cash_box;
use App\Models\Client;
use App\Models\Bank;
use File;
use DB;
use Log;
use Carbon\Carbon;
class BankCashStatmentController extends Controller
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
        $this->routeName = 'bank-cash-statment.';
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
        $banks = Bank::orderBy("created_at", "Desc")->get();
        $cashs = Cash_box::orderBy("created_at", "Desc")->get();
        $currencies = Currency::all();
        $filtters = [];
        $current_balance=0;
        return view($this->viewName . 'bank-cash', compact( 'currencies', 'filtters','current_balance','banks','cashs'));
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
        $banks = Bank::orderBy("created_at", "Desc")->get();
        $cashs = Cash_box::orderBy("created_at", "Desc")->get();
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

       

        if (!empty($request->get("cash_box_id"))) {

            $filtters->where('cash_box_id', '=', $request->get("cash_box_id"));
            $current_balance = Financial_entry::where('cash_box_id', $request->get("cash_box_id"))->where('currency_id', $request->get("currency_id"))->sum('depit') - Financial_entry::where('cash_box_id', $request->get("cash_box_id"))->where('currency_id', $request->get("currency_id"))->sum('credit');

        }

        if (!empty($request->get("bank_account_id"))) {

            $filtters->where('bank_account_id', '=', $request->get("bank_account_id"));
            $current_balance = Financial_entry::where('bank_account_id', $request->get("bank_account_id"))->where('currency_id', $request->get("currency_id"))->sum('depit') - Financial_entry::where('bank_account_id', $request->get("bank_account_id"))->where('currency_id', $request->get("currency_id"))->sum('credit');

        }

            $filtters = $filtters->get();
     
        return view($this->viewName . 'bank-cash-search', compact( 'currencies', 'filtters','current_balance','banks','cashs'))->render();
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
