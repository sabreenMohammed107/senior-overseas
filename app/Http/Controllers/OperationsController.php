<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Operation;
use App\Models\Sale_quote;
use App\Models\Client;
use App\Models\Ocean_freight_rate;
use App\Models\Air_rate;
use App\Models\Car_type;
use App\Models\Currency;
use App\Models\Trucking_rate;
use App\Models\Carrier;
use App\Models\Commodity;
use App\Models\Supplier;
use App\Models\Sale_quote_air;
use App\Models\Sale_quote_ocean;
use App\Models\Sale_quote_trucking;
use App\Models\Operation_expense;
use App\Models\Expenses_provider_type;
use App\Models\Expense;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class OperationsController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Operation $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'operations.';
        $this->routeName = 'operations.';
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
        $rows = Operation::orderBy("id", "Desc")->get();
        return view($this->viewName . 'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = 1;
        $qouts = Sale_quote::where('sale_quotes_type_id', '=', 2)->get();
        $qoutsFake = Sale_quote::where('sale_quotes_type_id', '=', 1)->get();
        $filtters = Sale_quote_air::where('sale_quote_id', '=', $id)->orderBy("created_at", "Desc")->get();
        $typeTesting = 0;

        $filtters = Sale_quote_ocean::where('sale_quote_id', '=', $id)->orderBy("created_at", "Desc")->get();
        $typeTesting = 1;

        $trackings = Sale_quote_trucking::where('sale_quote_id', '=', $id)->orderBy("created_at", "Desc")->get();
        //all Data
        $sale_qoute = new Sale_quote();
        $clients = Client::all();
        $clearances = Currency::all();
        $doors = Currency::all();
        $consinee = Client::all();
        $notify = Client::all();
        $Commodity = Commodity::all();
        $clearancesSuppliers = Supplier::where('supplier_type_id', '=', 2)->get();
        return view($this->viewName . 'create', compact('qouts', 'qoutsFake', 'sale_qoute', 'consinee', 'notify', 'Commodity', 'typeTesting',  'filtters', 'trackings', 'clients', 'clearancesSuppliers', 'clearances', 'doors'));

        // return view($this->viewName . 'create');
    }

    public function fetExist(Request $request)
    {

        $rows = Operation::orderBy("created_at", "Desc")->get();

        $id = $request->input('buildings_id');

        $row = Sale_quote::where('id', '=', $id)->first();
        $filtters = [];
        if ($row->ocean_air_type == 0) {
            $filtters = Sale_quote_air::where('sale_quote_id', '=', $id)->orderBy("created_at", "Desc")->get();
            $typeTesting = 0;
        } else {
            $filtters = Sale_quote_ocean::where('sale_quote_id', '=', $id)->orderBy("created_at", "Desc")->get();
            $typeTesting = 1;
        }
        $trackings = Sale_quote_trucking::where('sale_quote_id', '=', $id)->orderBy("created_at", "Desc")->get();
        //all Data
        $sale_qoute = Sale_quote::where('id', '=', $id)->first();
        $clients = Client::all();
        $clearances = Currency::all();
        $doors = Currency::all();
        $consinee = Client::all();
        $notify = Client::all();
        $Commodity = Commodity::all();
        $clearancesSuppliers = Supplier::where('supplier_type_id', '=', 2)->get();

        return view($this->viewName . 'search', compact('row', 'consinee', 'notify', 'Commodity', 'sale_qoute', 'typeTesting',  'filtters', 'trackings', 'clients', 'clearancesSuppliers', 'clearances', 'doors'))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $max = Operation::orderBy('id', 'desc')->value('operation_code');

        if ($max >= 100) {

            $max = $max + 1;
        } else {

            $max = 100;
        }



        //first get data 
        $data = [
            'shipper_id' => $request->input('shipper_id'),
            'operation_code' => $max,
            'operation_date' => Carbon::parse($request->input('operation_date')),
            'container_counts' => $request->input('container_counts'),
            'container_name' => $request->input('container_name'),
            'pl_no' => $request->input('pl_no'),
            'loading_date' => Carbon::parse($request->input('loading_date')),
            'vassel_name' => $request->input('vassel_name'),
            'cut_off_date' => Carbon::parse($request->input('cut_off_date')),
            'booking_no' => $request->input('booking_no'),
            'notes' => $request->input('notes'),


        ];
        if ($request->input('sales_quote_id_fake')) {

            $data['sales_quote_id'] = $request->input('sales_quote_id_fake');
        }
        if ($request->input('sales_quote_id_exist')) {

            $data['sales_quote_id'] = $request->input('sales_quote_id_exist');
        }
        if ($request->input('consignee_id')) {

            $data['consignee_id'] = $request->input('consignee_id');
        }
        if ($request->input('notify_id')) {

            $data['notify_id'] = $request->input('notify_id');
        }
        if ($request->input('commodity_id')) {

            $data['commodity_id'] = $request->input('commodity_id');
        }
        if ($request->input('oceanSelected')) {

            $data['sales_quote_ocean_id'] = $request->input('oceanSelected');
        }
        if ($request->input('airSelected')) {

            $data['sales_quote_air_id'] = $request->input('airSelected');
        }

        if ($request->input('TrackingSelected')) {

            $data['sales_quote_tracking_id'] = $request->input('TrackingSelected');
        }
        if ($request->input('import_export_flag')) {

            $data['import_export_flag'] = $request->input('import_export_flag');
        }
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
        $row = Operation::where('id', '=', $id)->first();

        $trackings = Sale_quote_trucking::where('id', '=', $row->sales_quote_tracking_id)->get();
        $filtters = [];
        if ($row->sales_quote_ocean_id) {
            $filtters = Sale_quote_ocean::where('id', '=', $row->sales_quote_ocean_id)->get();
            $typeTesting = 1;
        } else {
            $filtters = Sale_quote_air::where('id', '=', $row->sales_quote_air_id)->get();
            $typeTesting = 0;
        }
        $qouts = Sale_quote::all();
        $clearances = Currency::all();
        $consinee = Client::all();
        $notify = Client::all();
        $Commodity = Commodity::all();
        $doors = Currency::all();
        // get expenses
        $expenses = Operation_expense::where('operation_id','=',$id)->orderBy("id", "Desc")->get();

        return view($this->viewName . 'view', compact('row', 'qouts', 'consinee', 'notify', 'expenses','clearances', 'doors', 'typeTesting', 'Commodity', 'trackings', 'filtters'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Operation::where('id', '=', $id)->first();

        $trackings = Sale_quote_trucking::where('id', '=', $row->sales_quote_tracking_id)->get();
        $filtters = [];
        if ($row->sales_quote_ocean_id) {
            $filtters = Sale_quote_ocean::where('id', '=', $row->sales_quote_ocean_id)->get();
            $typeTesting = 1;
        } else {
            $filtters = Sale_quote_air::where('id', '=', $row->sales_quote_air_id)->get();
            $typeTesting = 0;
        }
        $qouts = Sale_quote::all();
        $clearances = Currency::all();
        $consinee = Client::all();
        $notify = Client::all();
        $Commodity = Commodity::all();
        $doors = Currency::all();
        // get expenses
        $expenses = Operation_expense::where('operation_id','=',$id)->orderBy("id", "Desc")->get();
        $providers = Expenses_provider_type::all();
        $expenseTypes = Expense::all();
        $expenseCurrency = Currency::all();
        return view($this->viewName . 'edit', compact('row', 'qouts', 'consinee', 'expenses', 'providers', 'expenseTypes', 'expenseCurrency', 'notify', 'clearances', 'doors', 'typeTesting', 'Commodity', 'trackings', 'filtters'));
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
        //first get data 
        $data = [
            'operation_date' => Carbon::parse($request->input('operation_date')),
            'container_counts' => $request->input('container_counts'),
            'container_name' => $request->input('container_name'),
            'pl_no' => $request->input('pl_no'),
            'loading_date' => Carbon::parse($request->input('loading_date')),
            'vassel_name' => $request->input('vassel_name'),
            'cut_off_date' => Carbon::parse($request->input('cut_off_date')),
            'booking_no' => $request->input('booking_no'),
            'notes' => $request->input('notes'),


        ];

        if ($request->input('consignee_id')) {

            $data['consignee_id'] = $request->input('consignee_id');
        }
        if ($request->input('notify_id')) {

            $data['notify_id'] = $request->input('notify_id');
        }
        if ($request->input('commodity_id')) {

            $data['commodity_id'] = $request->input('commodity_id');
        }

        $this->object::findOrFail($id)->update($data);

        return redirect()->route($this->routeName . 'index')->with('flash_success', $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Operation::where('id', '=', $id)->first();


        try {
            $row->delete();
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Data Has Been Deleted Successfully !');
    }
    /**
     * Expenses
     * 
     */

    public function addExpenses(Request $request)
    {

        $data = [
            'operation_id' => $request->input('operation_id'),
            'buy' => $request->input('buy'),
            'sell' => $request->input('sell'),
            'note' => $request->input('note'),

        ];

        if ($request->input('expenses_type_id')) {

            $data['expenses_type_id'] = $request->input('expenses_type_id');
        }
        if ($request->input('provider_type_id')) {

            $data['provider_type_id'] = $request->input('provider_type_id');
        }
        if ($request->input('currency_id')) {

            $data['currency_id'] = $request->input('currency_id');
        }
        Operation_expense::create($data);


        return redirect()->back()->with('flash_success', $this->message);
    }

    public function updateExpenses(Request $request)
    {
        $id = $request->input('expenses_id');
        $data = [
            'operation_id' => $request->input('operation_id'),
            'buy' => $request->input('buy'),
            'sell' => $request->input('sell'),
            'note' => $request->input('note'),

        ];

        if ($request->input('expenses_type_id')) {

            $data['expenses_type_id'] = $request->input('expenses_type_id');
        }
        if ($request->input('provider_type_id')) {

            $data['provider_type_id'] = $request->input('provider_type_id');
        }
        if ($request->input('currency_id')) {

            $data['currency_id'] = $request->input('currency_id');
        }
        Operation_expense::findOrFail($id)->update($data);

        return redirect()->back()->with('flash_success', $this->message);
    }


    public function deleteExpenses($id)
    {
        $row = Operation_expense::where('id', '=', $id)->first();

        try {

            $row->delete();
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->back()->with('flash_success', 'Data Has Been Deleted Successfully !');
    }
}
