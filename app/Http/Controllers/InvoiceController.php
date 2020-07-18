<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Operation;
use App\Models\Operation_expense;
use File;
use DB;
use Log;
use PDF;
use Terbilang;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;

class InvoiceController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Invoice $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'invoice.';
        $this->routeName = 'invoice.';
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
        $rows = Invoice::orderBy("id", "Desc")->get();
        return view($this->viewName . 'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*---to get choose one only --*/
        $ids = Invoice::get('operation_id');

        $operations = Operation::whereNOTIN('id', $ids)->get();




        $expenses = [];
        return view($this->viewName . 'add', compact('operations', 'expenses'));
    }
    public function fetExist(Request $request)
    {
        $ids = Invoice::get('operation_id');

        $operations = Operation::whereNOTIN('id', $ids)->get();

        $id = $request->input('buildings_id');
        $selected = Operation::where('id', '=', $id)->first();
        $expenses = Operation_expense::where('operation_id', '=', $id)->whereNotNull('sell')->orderBy("id", "Desc")->get();

        return view($this->viewName . 'search', compact('operations', 'selected', 'expenses'))->render();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $max = Invoice::orderBy('id', 'desc')->value('invoice_no');

        if ($max >= 100) {

            $max = $max + 1;
        } else {

            $max = 100;
        }


        $data = [
            'invoice_no' => $max,
            'operation_id' => $request->input('operation_id'),
            'invoice_date' => Carbon::parse($request->input('invoice_date')),
            'notes' => $request->input('invoice_note'),


        ];


        $this->object::create($data);



        return redirect()->route($this->routeName . 'index')->with('flash_success', $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rowSelected = Invoice::where('id', '=', $id)->first();

        $operations = Operation::orderBy("created_at", "Desc")->get();


        $selected = Operation::where('id', '=', $rowSelected->operation_id)->first();
        $expensesInvoice = Operation_expense::where('operation_id', '=', $rowSelected->operation_id)->whereNotNull('sell')->where('invoice_statement_flag', '=', 1)->orderBy("id", "Desc")->get();
        $expensesStatment = Operation_expense::where('operation_id', '=', $rowSelected->operation_id)->whereNotNull('sell')->where('invoice_statement_flag', '=', 2)->orderBy("id", "Desc")->get();
        return view($this->viewName . 'view', compact('rowSelected', 'operations', 'selected', 'expensesStatment', 'expensesInvoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rowSelected = Invoice::where('id', '=', $id)->first();

        $operations = Operation::orderBy("created_at", "Desc")->get();


        $selected = Operation::where('id', '=', $rowSelected->operation_id)->first();
        $expensesInvoice = Operation_expense::where('operation_id', '=', $rowSelected->operation_id)->whereNotNull('sell')->where('invoice_statement_flag', '=', 1)->orderBy("id", "Desc")->get();
        $expensesStatment = Operation_expense::where('operation_id', '=', $rowSelected->operation_id)->whereNotNull('sell')->where('invoice_statement_flag', '=', 2)->orderBy("id", "Desc")->get();
        return view($this->viewName . 'edit', compact('rowSelected', 'operations', 'selected', 'expensesStatment', 'expensesInvoice'));
    }


    public function sendStatment(Request $request)
    {
        $id = $request->input('id');
        $obj = Operation_expense::where('id', '=', $id)->first();

        $data = [
            'invoice_statement_flag' => 2,

        ];


        Operation_expense::findOrFail($id)->update($data);
        $expensesStatment = Operation_expense::where('operation_id', '=', $obj->operation_id)->whereNotNull('sell')->where('invoice_statement_flag', '=', 2)->orderBy("id", "Desc")->get();
        $expensesInvoice = Operation_expense::where('operation_id', '=',  $obj->operation_id)->whereNotNull('sell')->where('invoice_statement_flag', '=', 1)->orderBy("id", "Desc")->get();


        return view($this->viewName . 'statment_table', compact('expensesInvoice', 'expensesStatment'))->render();
    }

    public function sendInvoice(Request $request)
    {
        $id = $request->input('id');
        $obj = Operation_expense::where('id', '=', $id)->first();

        $data = [
            'invoice_statement_flag' => 1,

        ];


        Operation_expense::findOrFail($id)->update($data);
        $expensesStatment = Operation_expense::where('operation_id', '=', $obj->operation_id)->whereNotNull('sell')->where('invoice_statement_flag', '=', 2)->orderBy("id", "Desc")->get();
        $expensesInvoice = Operation_expense::where('operation_id', '=',  $obj->operation_id)->whereNotNull('sell')->where('invoice_statement_flag', '=', 1)->orderBy("id", "Desc")->get();


        return view($this->viewName . 'statment_table', compact('expensesInvoice', 'expensesStatment'))->render();
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
        $row = Invoice::where('id', '=', $id)->first();

        try {

            $row->delete();
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->back()->with('flash_success', 'Data Has Been Deleted Successfully !');
    }



    public function printInvoicePDF($id)
    {
        $invoice = Invoice::where('id', '=', $id)->first();
        $rows = Operation_expense::where('operation_id', '=', $invoice->operation_id)->whereNotNull('sell')->where('invoice_statement_flag', '=', 1)->orderBy("id", "Desc")->get();
        $curs = [];
        foreach ($rows as $row) {
            $cur = $row->currency->currency_name;
            array_push($curs, $cur);
        }
        $curs = array_unique($curs);
        $totals = [];
        $total = 0;
        foreach ($curs as $cur) {
            $total=0;
            foreach ($rows as $row) {
                if ($row->currency->currency_name === $cur) {
                    if($row->automatic==1){
                        $total = $total + ($row->sell *$row->operation->container_counts);
                    }else{
                        $total = $total + ($row->sell *1);
                    }
                  
                  
                }
               
            }
            $totalNum=$total;
            $total=Terbilang::make($total, " - $cur");
            $obj = new Collection();
            $obj->cur = $cur;
            $obj->total =strtoupper($total);
            $obj->num = $totalNum;
           
            array_push($totals, $obj);
           
        }
      
        // six hundred and fifty-four thousand, three hundred and twenty-one dollars
        // This  $data array will be passed to our PDF blade

        $data = [
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points.info',
            'rows' => $rows,
            'invoice' => $invoice,
            'curs' => $curs,
            'totals'=>$totals,
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.'
        ];


        $title = "My Report";
        $pdf = PDF::loadView($this->viewName . 'invoceTemp', $data);
        return $pdf->stream('medium.pdf'); // to open in blank page


        // return $pdf->dawnload('medium.pdf');  to open in blank page


    }

    public function printStatmentPDF($id)
    {
        $invoice = Invoice::where('id', '=', $id)->first();
        $rows = Operation_expense::where('operation_id', '=', $invoice->operation_id)->whereNotNull('sell')->where('invoice_statement_flag', '=',2 )->orderBy("id", "Desc")->get();
        $curs = [];
        foreach ($rows as $row) {
            $cur = $row->currency->currency_name;
            array_push($curs, $cur);
        }
        $curs = array_unique($curs);
        $totals = [];
        $total = 0;
        foreach ($curs as $cur) {
            $total=0;
            foreach ($rows as $row) {
                if ($row->currency->currency_name === $cur) {
                    if($row->automatic==1){
                        $total = $total + ($row->sell *$row->operation->container_counts);
                    }else{
                        $total = $total + ($row->sell *1);
                    }
                  
                  
                }
               
            }
            $totalNum=$total;
            $total=Terbilang::make($total, " - $cur");
            $obj = new Collection();
            $obj->cur = $cur;
            $obj->total = strtoupper($total);
            $obj->num = $totalNum;
           
            array_push($totals, $obj);
          
        }
 
        // This  $data array will be passed to our PDF blade
        $data = [
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points.info',
            'rows' => $rows,
            'invoice' => $invoice,
            'curs' => $curs,
            'totals'=>$totals,
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.'
        ];


        $title = "My Report";
        $pdf = PDF::loadView($this->viewName . 'statmentTemp', $data);
        return $pdf->stream('medium.pdf'); // to open in blank page


        // return $pdf->dawnload('medium.pdf');  to open in blank page


    }
}
