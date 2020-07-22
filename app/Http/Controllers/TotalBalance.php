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
use PDF;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class TotalBalance extends Controller
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
        $this->viewName = 'total-balance.';
        $this->routeName = 'total-balance.';
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
        $banks = Bank::all();
        $clients = Client::all();
        $cashs = Cash_box::all();
        $bankEgp = 0;
        $bankUsa = 0;
        $bankUre = 0;
        $clientEgp = 0;
        $clientUsa = 0;
        $clientUre = 0;
        $cashEgp = 0;
        $cashUsa = 0;
        $cashUre = 0;
        $banksReport = [];
        $clientsReport = [];
        $cashsReport = [];
        foreach ($banks as $bank) {
            $bankEgp = Financial_entry::where('bank_account_id', $bank->id)->where('currency_id', 2)->sum('depit') - Financial_entry::where('bank_account_id', $bank->id)->where('currency_id', 2)->sum('credit');
            $bankUsa = Financial_entry::where('bank_account_id', $bank->id)->where('currency_id', 1)->sum('depit') - Financial_entry::where('bank_account_id', $bank->id)->where('currency_id', 1)->sum('credit');
            $bankUre = Financial_entry::where('bank_account_id', $bank->id)->where('currency_id', 3)->sum('depit') - Financial_entry::where('bank_account_id', $bank->id)->where('currency_id', 3)->sum('credit');

            $obj = new Collection();
            $obj->bank = $bank;
            $obj->bankEgp = $bankEgp;
            $obj->bankUsa = $bankUsa;
            $obj->bankUre = $bankUre;

            array_push($banksReport, $obj);
        }

        foreach ($clients as $client) {
            $clientEgp = Financial_entry::where('client_id', $client->id)->where('currency_id', 2)->sum('credit') - Financial_entry::where('client_id', $client->id)->where('currency_id', 2)->sum('depit');
            $clientUsa = Financial_entry::where('client_id', $client->id)->where('currency_id', 1)->sum('credit') - Financial_entry::where('client_id', $client->id)->where('currency_id', 1)->sum('depit');
            $clientUre = Financial_entry::where('client_id', $client->id)->where('currency_id', 3)->sum('credit') - Financial_entry::where('client_id', $client->id)->where('currency_id', 3)->sum('depit');

            $obj = new Collection();
            $obj->client = $client;
            $obj->clientEgp = $clientEgp;
            $obj->clientUsa = $clientUsa;
            $obj->clientUre = $clientUre;

            array_push($clientsReport, $obj);
        }

        foreach ($cashs as $cash) {
            $cashEgp = Financial_entry::where('cash_box_id', $cash->id)->where('currency_id', 2)->sum('depit') - Financial_entry::where('cash_box_id', $cash->id)->where('currency_id', 2)->sum('credit');
            $cashUsa = Financial_entry::where('cash_box_id', $cash->id)->where('currency_id', 1)->sum('depit') - Financial_entry::where('cash_box_id', $cash->id)->where('currency_id', 1)->sum('credit');
            $cashUre = Financial_entry::where('cash_box_id', $cash->id)->where('currency_id', 3)->sum('depit') - Financial_entry::where('cash_box_id', $cash->id)->where('currency_id', 3)->sum('credit');

            $obj = new Collection();
            $obj->cash = $cash;
            $obj->cashEgp = $cashEgp;
            $obj->cashUsa = $cashUsa;
            $obj->cashUre = $cashUre;

            array_push($cashsReport, $obj);
        }

        /***
         * get All Total Suppliers
         */
        $suppliers = Supplier::all();
        $carriers = Carrier::all();
        $agents = Agent::all();
        $supplierEgp = 0;
        $supplierUsa = 0;
        $supplierUre = 0;
        $carrierEgp = 0;
        $carrierUsa = 0;
        $carrierUre = 0;
        $agentEgp = 0;
        $agentUsa = 0;
        $agentUre = 0;
        foreach ($suppliers as $supplier) {
           
            if($supplier->supplier_type_id==1){
                $supplierEgp = $supplierEgp+(Financial_entry::where('trucking_id', $supplier->id)->where('currency_id', 2)->sum('depit') - Financial_entry::where('trucking_id', $supplier->id)->where('currency_id', 2)->sum('credit'));
                $supplierUsa =$supplierUsa+( Financial_entry::where('trucking_id', $supplier->id)->where('currency_id', 1)->sum('depit') - Financial_entry::where('trucking_id', $supplier->id)->where('currency_id', 1)->sum('credit'));
                $supplierUre = $supplierUre+(Financial_entry::where('trucking_id', $supplier->id)->where('currency_id', 3)->sum('depit') - Financial_entry::where('trucking_id', $supplier->id)->where('currency_id', 3)->sum('credit'));

            }else{
                $supplierEgp =  $supplierEgp+(Financial_entry::where('clearance_id', $supplier->id)->where('currency_id', 2)->sum('depit') - Financial_entry::where('clearance_id', $supplier->id)->where('currency_id', 2)->sum('credit'));
                $supplierUsa = $supplierUsa+(Financial_entry::where('clearance_id', $supplier->id)->where('currency_id', 1)->sum('depit') - Financial_entry::where('clearance_id', $supplier->id)->where('currency_id', 1)->sum('credit'));
                $supplierUre = $supplierUre+(Financial_entry::where('clearance_id', $supplier->id)->where('currency_id', 3)->sum('depit') - Financial_entry::where('clearance_id', $supplier->id)->where('currency_id', 3)->sum('credit'));

            }
 
        }
        foreach ($carriers as $carrier) {
           
            if($carrier->carrier_type_id==1){
                $carrierEgp = $carrierEgp+(Financial_entry::where('ocean_carrier_id', $carrier->id)->where('currency_id', 2)->sum('depit') - Financial_entry::where('ocean_carrier_id', $carrier->id)->where('currency_id', 2)->sum('credit'));
                $carrierUsa =$carrierUsa+( Financial_entry::where('ocean_carrier_id', $carrier->id)->where('currency_id', 1)->sum('depit') - Financial_entry::where('ocean_carrier_id', $carrier->id)->where('currency_id', 1)->sum('credit'));
                $carrierUre = $carrierUre+(Financial_entry::where('ocean_carrier_id', $carrier->id)->where('currency_id', 3)->sum('depit') - Financial_entry::where('ocean_carrier_id', $carrier->id)->where('currency_id', 3)->sum('credit'));

            }else{
                $carrierEgp =  $carrierEgp+(Financial_entry::where('air_carrier_id', $carrier->id)->where('currency_id', 2)->sum('depit') - Financial_entry::where('air_carrier_id', $carrier->id)->where('currency_id', 2)->sum('credit'));
                $carrierUsa = $carrierUsa+(Financial_entry::where('air_carrier_id', $carrier->id)->where('currency_id', 1)->sum('depit') - Financial_entry::where('air_carrier_id', $carrier->id)->where('currency_id', 1)->sum('credit'));
                $carrierUre = $carrierUre+(Financial_entry::where('air_carrier_id', $carrier->id)->where('currency_id', 3)->sum('depit') - Financial_entry::where('air_carrier_id', $carrier->id)->where('currency_id', 3)->sum('credit'));

            }
 
        }

        foreach ($agents as $aget) {
           
          
                $agentEgp = $agentEgp+(Financial_entry::where('agent_id', $aget->id)->where('currency_id', 2)->sum('depit') - Financial_entry::where('agent_id', $aget->id)->where('currency_id', 2)->sum('credit'));
                $agentUsa =$agentUsa+( Financial_entry::where('agent_id', $aget->id)->where('currency_id', 1)->sum('depit') - Financial_entry::where('agent_id', $aget->id)->where('currency_id', 1)->sum('credit'));
                $agentUre = $agentUre+(Financial_entry::where('agent_id', $aget->id)->where('currency_id', 3)->sum('depit') - Financial_entry::where('agent_id', $aget->id)->where('currency_id', 3)->sum('credit'));

           
 
        }
$sumSuppliersEgp=0;
$sumSuppliersUse=0;
$sumSuppliersUre=0;
$sumSuppliersEgp=$sumSuppliersEgp+($agentEgp+$carrierEgp+$supplierEgp);
$sumSuppliersUse=$sumSuppliersUse+($agentUsa+$carrierUsa+$supplierUsa);
$sumSuppliersUre=$sumSuppliersUre+($agentUre+$carrierUre+$supplierUre);
        // This  $data array will be passed to our PDF blade
        $data = [
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points.info',
            'banksReport' => $banksReport,
            'clientsReport' => $clientsReport,
            'cashsReport' => $cashsReport,
            'sumSuppliersEgp'=>$sumSuppliersEgp,
            'sumSuppliersUse'=>$sumSuppliersUse,
            'sumSuppliersUre'=>$sumSuppliersUre,

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
