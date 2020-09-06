<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Open_balance;
use App\Models\Financial_entry;
use App\Models\Finan_trans_type;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Terbilang;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use PDF;

class ClientReport extends Controller
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
        $this->viewName = 'client-report.';
        $this->routeName = 'client-report.';
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
        $rows = Client::orderBy("created_at", "Desc")->get();
        $filtters = [];
        $totals = [];
        $curs = [];
        return view($this->viewName . 'index', compact('rows', 'filtters', 'curs', 'totals'));
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
        $client_id = $request->input('client_id');
        $from_date = Carbon::parse($request->input('from_date'));
        $to_date = Carbon::parse($request->input('to_date'));

        $filtters = Financial_entry::orderBy('currency_id')->orderBy('entry_date');

        if (!empty($request->get("from_date"))) {
            $filtters->where('entry_date', '>=', Carbon::parse($request->get("from_date")));
        }
        if (!empty($request->get("to_date"))) {
            $filtters->where('entry_date', '<=', Carbon::parse($request->get("to_date")));
        }
        if (!empty($request->get("client_id"))) {

            $filtters->where('client_id', '=', $request->get("client_id"));
        }
        $filtters = $filtters->get();


        $rows = Client::orderBy("created_at", "Desc")->get();

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

            $total =  $filtters->where('client_id', $client_id)->where('currency_id', '=', $cur)->sum('credit') -  $filtters->where('client_id', $client_id)->where('currency_id', '=', $cur)->sum('depit');
            $name = Currency::where('id', '=', $cur)->first();
            $totalNum = $total;
            $total = Terbilang::make($total, " -  $name->currency_name");
            $obj = new Collection();
            $obj->cur = $name->currency_name;
            $obj->total = strtoupper($total);
            $obj->num = $totalNum;

            array_push($totals, $obj);
        }
        return view($this->viewName . 'report', compact('rows', 'filtters', 'curs', 'totals'))->render();
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
        $client_id = $request->input('client_id');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $client = Client::where('id', '=', $client_id)->first();
        $filtters = Financial_entry::orderBy('currency_id')->orderBy('entry_date');

        if (!empty($request->get("from_date"))) {
            $filtters->where('entry_date', '>=', Carbon::parse($request->get("from_date")));
        }
        if (!empty($request->get("to_date"))) {
            $filtters->where('entry_date', '<=', Carbon::parse($request->get("to_date")));
        }
        if (!empty($request->get("client_id"))) {

            $filtters->where('client_id', '=', $request->get("client_id"));
        }
        $filtters = $filtters->get();


        // ----------------- //
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

            $total =  $filtters->where('client_id', $client_id)->where('currency_id', '=', $cur)->sum('credit') -  $filtters->where('client_id', $client_id)->where('currency_id', '=', $cur)->sum('depit');
            $name = Currency::where('id', '=', $cur)->first();
            $totalNum = $total;
            $total = Terbilang::make($total, " -  $name->currency_name");
            $obj = new Collection();
            $obj->cur = $name->currency_name;
            $obj->total = strtoupper($total);
            $obj->num = $totalNum;

            array_push($totals, $obj);
        }
        $data = [
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points.info',
            'filtters' => $filtters,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'client_name' => $client->client_name,
            'curs' => $curs,
            'totals' => $totals,

        ];


        $title = "My Report";
        $pdf = PDF::loadView($this->viewName . 'clientReport', $data);
        return $pdf->stream('medium.pdf'); // to open in blank page

    }

    // App\Models\Financial_entry::where('client_id', $Report[$index]->client_id)->where('operation_id', $Report[$index]->operation_id)->where('currency_id', 1)->sum('credit') - App\Models\Financial_entry::where('client_id', $Report[$index]->client_id)->where('operation_id', $Report[$index]->operation_id)->where('currency_id', 1)->sum('depit')}}

    public function fetchAllReport(Request $request)
    {
        $client_id = $request->input('client_id');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $client = Client::where('id', '=', $client_id)->first();
        $filtters = Financial_entry::orderBy('currency_id')->orderBy('entry_date');

        if (!empty($request->get("from_date"))) {
            $filtters->where('entry_date', '>=', Carbon::parse($request->get("from_date")));
        }
        if (!empty($request->get("to_date"))) {
            $filtters->where('entry_date', '<=', Carbon::parse($request->get("to_date")));
        }
        if (!empty($request->get("client_id"))) {

            $filtters->where('client_id', '=', $request->get("client_id"));
        }
        $operationIds = $filtters->whereNotNull('operation_id')->distinct()->pluck('operation_id');


        $new = Financial_entry::orderBy('currency_id')->orderBy('entry_date', "Asc");

        if (!empty($request->get("from_date"))) {
            $new->where('entry_date', '>=', Carbon::parse($request->get("from_date")));
        }
        if (!empty($request->get("to_date"))) {
            $new->where('entry_date', '<=', Carbon::parse($request->get("to_date")));
        }
        if (!empty($request->get("client_id"))) {

            $new->where('client_id', '=', $request->get("client_id"));
        }
        $filtterTotal = $new->get();

      
        $test = array();

        foreach ($filtterTotal as $ff) {
            if(!$ff->operation_id){
                array_push($test, $ff);
            }
        }


        foreach ($operationIds as $op) {
            foreach ($filtterTotal as $ff) {
                 if ($ff->operation_id == $op) {
                    array_push($test, $ff);
                break; 
                }

              
            }
        }
        
       $test=collect($test)->sortBy('entry_date');
        //-----------------End----------------//
        // ----------------- //
        $curs = [];
        foreach ($filtterTotal as $row) {
            $cur = $row->currency->currency_name;
            array_push($curs, $cur);
        }
        $curs = array_unique($curs);
        $totals = [];
        $total = 0;
        $cursIds = [];
        foreach ($filtterTotal as $row) {
            $cursId = $row->currency_id;
            array_push($cursIds, $cursId);
        }
        $cursIds = array_unique($cursIds);




        foreach ($cursIds as $cur) {
            $total = 0;

            $total =  $filtterTotal->where('client_id', $client_id)->where('currency_id', '=', $cur)->sum('credit') -  $filtterTotal->where('client_id', $client_id)->where('currency_id', '=', $cur)->sum('depit');
            $name = Currency::where('id', '=', $cur)->first();
            $totalNum = $total;
            $total = Terbilang::make($total, " -  $name->currency_name");
            $obj = new Collection();
            $obj->cur = $name->currency_name;
            $obj->total = strtoupper($total);
            $obj->num = $totalNum;

            array_push($totals, $obj);
        }
        $data = [
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points.info',
            'filtters' => $test,
            'operationIds' => $operationIds,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'client_name' => $client->client_name,
            'curs' => $curs,
            'totals' => $totals,
        ];


        $title = "My Report";
        $pdf = PDF::loadView($this->viewName . 'allClientOperation', $data);
        return $pdf->stream('medium.pdf'); // to open in blank page

    }
}
