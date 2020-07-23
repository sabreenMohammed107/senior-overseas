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
use App\Models\Cash_box;
use App\Models\Operation_expense;
use App\Models\Client;

use App\Models\Bank;
use App\Models\Operation;
use File;
use DB;
use Log;
use PDF;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class EarnReportController extends Controller
{
    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Financial_entry $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'earn-balance.';
        $this->routeName = 'earn-balance.';
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
        return view($this->viewName . 'index');
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
        $from=$request->get("from_date");
        $to=$request->get("to_date");

        $operations = Operation::select('id');
        if (!empty($request->get("from_date"))) {
            $operations->where('operation_date', '>=', Carbon::parse($request->get("from_date")));
        }
        if (!empty($request->get("to_date"))) {
            $operations->where('operation_date', '<=', Carbon::parse($request->get("to_date")));
        }
        $operations =$operations->pluck('id');
      
        $sellExpensesEgp = Operation_expense::whereNotNull('sell')->where('currency_id', 2)->whereIn('operation_id', $operations)->sum('sell');
        $sellExpensesUse = Operation_expense::whereNotNull('sell')->where('currency_id', 1)->whereIn('id', $operations)->sum('sell');
        $sellExpensesUre = Operation_expense::whereNotNull('sell')->where('currency_id', 3)->whereIn('operation_id', $operations)->sum('sell');
        $buyExpensesEgp = Operation_expense::whereNotNull('buy')->where('currency_id', 2)->whereIn('operation_id', $operations)->sum('buy');
        $buyExpensesUse = Operation_expense::whereNotNull('buy')->where('currency_id', 1)->whereIn('operation_id', $operations)->sum('buy');
        $buyExpensesUre = Operation_expense::whereNotNull('buy')->where('currency_id', 3)->whereIn('operation_id', $operations)->sum('buy');
       

        /**
         * Expenses
         */
       
       $extraExpense=Cashbox_expenses_type::whereNotIn('id',[2,3,4,5,6,7])->get();
     
        $data = [
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points.info',
            'sellExpensesEgp' => $sellExpensesEgp,
            'sellExpensesUse' => $sellExpensesUse,
            'sellExpensesUre' => $sellExpensesUre,
            'buyExpensesEgp' => $buyExpensesEgp,
            'buyExpensesUse' => $buyExpensesUse,
            'buyExpensesUre' => $buyExpensesUre,
            'from'=>$from,
            'to'=>$to,
            'extraExpense'=>$extraExpense,



            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.'
        ];


        $title = "My Report";
        // return view($this->viewName . 'report' ,$data);
        $pdf = PDF::loadView($this->viewName . 'report', $data);
        return $pdf->stream('medium.pdf'); // to open in blank page
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
