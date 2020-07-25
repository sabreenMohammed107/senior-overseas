<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Port;
use App\Models\Sale_quote;
use App\Models\Client;
use App\Models\Ocean_freight_rate;
use App\Models\Air_rate;
use App\Models\Car_type;
use App\Models\Currency;
use App\Models\Trucking_rate;
use App\Models\Carrier;
use App\Models\Container;
use App\Models\Supplier;
use App\Models\Sale_quote_air;
use App\Models\Sale_quote_ocean;
use App\Models\Sale_quote_trucking;
use App\Models\Employee;
use App\Models\Agent;
use File;
use DB;
use Log;
use PDF;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class SalesQuoteController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Sale_quote $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'sale-quote.';
        $this->routeName = 'sale-quote.';
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
        $rows = Sale_quote::orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //airs
        $airs = Carrier::all();
        $aols = Port::all();
        $aods = Port::all();
        $ranges = Air_rate::pluck('slide_range')->toArray();
        //ocean
        $oceans = Carrier::all();
        $containers = Container::all();

        //tracking
        $suppliers = Supplier::all();
        $carriers = Carrier::all();
        $cars = Car_type::all();
        //clearance


        return view($this->viewName . 'createSelect', compact(

            'carriers',
            'ranges',
            'aols',
            'aods',
            'containers',
            'airs',
            'cars',
            'oceans',
            'suppliers',

        ));
    }
    public function gotosave(Request $request)
    {
        //get type
        $type = 0;
        if ($request->input('tab') === "igotnone") {
            $type = 0;
        } else {
            $type = 1;
        }
        $filtters = [];
        $trackings = [];

        if ($type == 0) {

            $typeTesting = 0;
            $filtters = Air_rate::orderBy("created_at", "Desc");

            if (!empty($request->get("air_carrier_id"))) {

                $filtters->where('air_carrier_id', '=', $request->get("air_carrier_id"));
            }
            if (!empty($request->get("aol_id"))) {

                $filtters->where('aol_id', '=', $request->get("aol_id"));
            }
            if (!empty($request->get("aod_id"))) {

                $filtters->where('aod_id', '=', $request->get("aod_id"));
            }
            if (!empty($request->get("slide_range"))) {

                $filtters->where('slide_range', '=', $request->get("slide_range"));
            }
        } else {
            $typeTesting = 1;
            $filtters = Ocean_freight_rate::orderBy("created_at", "Desc");
            if (!empty($request->get("carrier_id"))) {

                $filtters->where('carrier_id', '=', $request->get("carrier_id"));
            }

            if (!empty($request->get("container_id"))) {

                $filtters->where('container_id', '=', $request->get("container_id"));
            }
            if (!empty($request->get("pol_id"))) {

                $filtters->where('pol_id', '=', $request->get("pol_id"));
            }
            if (!empty($request->get("pod_id"))) {

                $filtters->where('pod_id', '=', $request->get("pod_id"));
            }
        }
        $filtters = $filtters->get();

        //tracking
        $trackings = Trucking_rate::orderBy("created_at", "Desc");

        if (!empty($request->get("supplier_id"))) {

            $trackings->where('supplier_id', '=', $request->get("supplier_id"));
        }
        if (!empty($request->get("track_aol_id"))) {

            $trackings->where('pol_id', '=', $request->get("track_aol_id"));
        }
        if (!empty($request->get("track_pod_id"))) {

            $trackings->where('pod_id', '=', $request->get("track_pod_id"));
        }
        if (!empty($request->get("car_type_id"))) {

            $trackings->where('car_type_id', '=', $request->get("car_type_id"));
        }
        $trackings = $trackings->get();

        //all Data
        $clients = Client::all();
        $clearances = Currency::all();
        $doors = Currency::all();
        $clearancesSuppliers = Supplier::where('supplier_type_id', '=', 2)->get();
        $employees = Employee::all();
        $agents = Agent::all();
        return view($this->viewName . 'create', compact('typeTesting', 'type', 'employees', 'agents', 'filtters', 'trackings', 'clients', 'clearancesSuppliers', 'clearances', 'doors'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $max = Sale_quote::orderBy('id', 'desc')->value('quote_code');

        if ($max >= 100) {

            $max = $max + 1;
        } else {

            $max = 100;
        }


        //first get data 
        $data = [
            'quote_date' => $request->input('quote_date'),
            'quote_code' => $max,
            'ocean_air_type' => $request->input('savingType'),
            'clearance_price' => $request->input('clearance_price'),
            'clearance_notes' => $request->input('clearance_notes'),
            'door_door_price' => $request->input('door_door_price'),
            'door_door_notes' => $request->input('door_door_notes'),
            'sale_quotes_type_id' => $request->input('sale_quotes_type_id'),


        ];
        if ($request->input('client_id')) {

            $data['client_id'] = $request->input('client_id');
        }
        if ($request->input('sale_person_id')) {

            $data['sale_person_id'] = $request->input('sale_person_id');
        }
        if ($request->input('supplier_id')) {

            $data['supplier_id'] = $request->input('supplier_id');
        }
        if ($request->input('agent_id')) {

            $data['agent_id'] = $request->input('agent_id');
        }
        if ($request->input('clearance_currency_id')) {

            $data['clearance_currency_id'] = $request->input('clearance_currency_id');
        }
        if ($request->input('door_door_currency_id')) {

            $data['door_door_currency_id'] = $request->input('door_door_currency_id');
        }

        $all_ids = [];

        $tracking_ids = [];
        if ($request->input('tableId')) {
            foreach ($request->input('tableId') as $typesId) {


                $all_ids[] = $typesId;
            }
        }

        if ($request->input('idTracking')) {
            foreach ($request->input('idTracking') as $idTrack) {


                $tracking_ids[] = $idTrack;
            }
        }

        //passing parameter to transaction
        DB::transaction(function () use ($data, $all_ids, $tracking_ids, $request) {
            $Sale_quote = Sale_quote::create($data);
            //air
            if ($data['ocean_air_type'] == 0) {
                foreach ($all_ids as $all) {
                    $air = Air_rate::where('id', '=', $all)->first();
                    $currency = $air->currency_id;
                    $x = array_search(('price' . $all), $request->all());

                    $input = [
                        'air_rate_id' => $all,
                        'sale_quote_id' => $Sale_quote->id,
                        'currency_id' => $currency,
                        'price' => $request->input('price' . $all)[0],
                    ];

                    Sale_quote_air::create($input);
                }
            } else {
                //ocean
                foreach ($all_ids as $all) {
                    $ocean = Ocean_freight_rate::where('id', '=', $all)->first();
                    $currency = $ocean->currency_id;
                    $x = array_search(('price' . $all), $request->all());

                    $input = [
                        'ocean_rate_id' => $all,
                        'sale_quote_id' => $Sale_quote->id,
                        'currency_id' => $currency,
                        'price' => $request->input('price' . $all)[0],
                    ];
                    Sale_quote_ocean::create($input);
                }
            }


            foreach ($tracking_ids as $tracking) {
                $truck = Trucking_rate::where('id', '=', $tracking)->first();
                $currency = $truck->car_currency_id;
                $x = array_search(('car_price' . $tracking), $request->all());

                $input = [
                    'trucking_rate_id' => $tracking,
                    'sale_quote_id' => $Sale_quote->id,
                    'currency_id' => $currency,
                    'car_price' => $request->input('car_price' . $tracking)[0],
                ];
                Sale_quote_trucking::create($input);
            }
        });





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
        $clients = Client::all();
        $clearances = Currency::all();
        $doors = Currency::all();
        $employees = Employee::all();
        $clearancesSuppliers = Supplier::where('supplier_type_id', '=', 2)->get();
        $agents = Agent::all();
         // This  $data array will be passed to our PDF blade
         $data = [
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points.info',
            'row' => $row,
            'typeTesting' => $typeTesting,
            'employees' => $employees,
            'agents'=>$agents,
            'filtters' => $filtters,
            'trackings' => $trackings,
            'clients' => $clients,
            'clearancesSuppliers'=>$clearancesSuppliers,
            'clearances' => $clearances,
            'doors'=>$doors,
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.'
        ];


        $title = "My Report";
        $pdf = PDF::loadView($this->viewName . 'report', $data);
        return $pdf->stream('medium.pdf'); // to open in blank page
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $clients = Client::all();
        $clearances = Currency::all();
        $doors = Currency::all();
        $employees = Employee::all();
        $clearancesSuppliers = Supplier::where('supplier_type_id', '=', 2)->get();
        $agents = Agent::all();
        return view($this->viewName . 'edit', compact('row', 'typeTesting', 'employees','agents',  'filtters', 'trackings', 'clients', 'clearancesSuppliers', 'clearances', 'doors'));
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
            'quote_date' => $request->input('quote_date'),

            'quote_code' => $request->input('quote_code'),
            'ocean_air_type' => $request->input('savingType'),
            'clearance_price' => $request->input('clearance_price'),
            'clearance_notes' => $request->input('clearance_notes'),
            'door_door_price' => $request->input('door_door_price'),
            'door_door_notes' => $request->input('door_door_notes'),


        ];
        if ($request->input('sale_person_id')) {

            $data['sale_person_id'] = $request->input('sale_person_id');
        }
        if ($request->input('client_id')) {

            $data['client_id'] = $request->input('client_id');
        }
        if ($request->input('clearance_currency_id')) {

            $data['clearance_currency_id'] = $request->input('clearance_currency_id');
        }
        if ($request->input('door_door_currency_id')) {

            $data['door_door_currency_id'] = $request->input('door_door_currency_id');
        }

        $all_ids = [];

        $tracking_ids = [];
        if ($request->input('tableId')) {
            foreach ($request->input('tableId') as $typesId) {


                $all_ids[] = $typesId;
            }
        }

        if ($request->input('idTracking')) {
            foreach ($request->input('idTracking') as $idTrack) {


                $tracking_ids[] = $idTrack;
            }
        }

        //passing parameter to transaction
        DB::transaction(function () use ($id, $data, $all_ids, $tracking_ids, $request) {
            $Sale_quote = Sale_quote::findOrFail($id)->update($data);

            //air
            if ($data['ocean_air_type'] == 0) {
                foreach ($all_ids as $all) {
                    $air = Sale_quote_air::where('id', '=', $all)->first();
                    if ($request->input('price' . $all)[0] != $air->price) {
                        $input = [

                            'price' => $request->input('price' . $all)[0],
                        ];

                        Sale_quote_air::findOrFail($all)->update($input);
                    }
                }
            } else {
                //ocean
                foreach ($all_ids as $all) {
                    $ocean = Sale_quote_ocean::where('id', '=', $all)->first();
                    if ($request->input('price' . $all)[0] != $ocean->price) {
                        $input = [

                            'price' => $request->input('price' . $all)[0],
                        ];
                        Sale_quote_ocean::findOrFail($all)->update($input);
                    }
                }
            }


            foreach ($tracking_ids as $tracking) {
                $truck = Sale_quote_trucking::where('id', '=', $all)->first();
                if ($request->input('price' . $tracking)[0] != $truck->price) {
                    $input = [

                        'car_price' => $request->input('car_price' . $tracking)[0],
                    ];
                    Sale_quote_trucking::findOrFail($tracking)->update($input);
                }
            }
        });





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
        $row = Sale_quote::where('id', '=', $id)->first();


        try {
            $row->delete();
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Data Has Been Deleted Successfully !');
    }
}
