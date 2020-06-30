<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ocean_freight_rate;
use App\Models\Carrier;
use App\Models\Port;
use App\Models\Container;
use App\Models\Currency;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class OceanFreightController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Ocean_freight_rate $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'ocean-freight.';
        $this->routeName = 'ocean-freight.';
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
        $rows = Ocean_freight_rate::orderBy("created_at", "Desc")->get();
        $carriers = Carrier::all();
        $pols = Port::all();
        $pods = Port::all();
        $currencies = Currency::all();
        $containers = Container::all();

        return view($this->viewName . 'index', compact('rows', 'carriers', 'pols', 'pods', 'currencies', 'containers'));
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
         //get max code
         $max = 0;

         $maxValue = Ocean_freight_rate::orderBy('id', 'desc')->value('code');
         if ($maxValue != null) {
             $max = $maxValue + 1;
         } else {
             $max = 100;
         }
        $data = [
            'code'=>$max,
            'ocean_freight' => $request->input('ocean_freight'),
            'price' => $request->input('price'),
            'transit_time' => $request->input('transit_time'),
            'notes' => $request->input('notes'),
            'validity_date'=>Carbon::parse($request->input('validity_date')),
           

        ];
        if ($request->input('carrier_id')) {

            $data['carrier_id'] = $request->input('carrier_id');
        }
        if ($request->input('pol_id')) {

            $data['pol_id'] = $request->input('pol_id');
        }
        if ($request->input('pod_id')) {

            $data['pod_id'] = $request->input('pod_id');
        }
        if ($request->input('container_id')) {

            $data['container_id'] = $request->input('container_id');
        }
        if ($request->input('currency_id')) {

            $data['currency_id'] = $request->input('currency_id');
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
        $row = Ocean_freight_rate::where('id', '=', $id)->first();
        $carriers = Carrier::all();
        $pols = Port::all();
        $pods = Port::all();
        $currencies = Currency::all();
        $containers = Container::all();

        return view($this->viewName . 'edit', compact('row', 'carriers', 'pols', 'pods', 'currencies', 'containers'));
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
        $data = [
            'ocean_freight' => $request->input('ocean_freight'),
            'price' => $request->input('price'),
            'transit_time' => $request->input('transit_time'),
            'notes' => $request->input('notes'),
            'validity_date'=>Carbon::parse($request->input('validity_date')),
           

        ];
        if ($request->input('carrier_id')) {

            $data['carrier_id'] = $request->input('carrier_id');
        }
        if ($request->input('pol_id')) {

            $data['pol_id'] = $request->input('pol_id');
        }
        if ($request->input('pod_id')) {

            $data['pod_id'] = $request->input('pod_id');
        }
        if ($request->input('container_id')) {

            $data['container_id'] = $request->input('container_id');
        }
        if ($request->input('currency_id')) {

            $data['currency_id'] = $request->input('currency_id');
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
        $row = Ocean_freight_rate::where('id', '=', $id)->first();
       

        try {
            $row->delete();
          
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Data Has Been Deleted Successfully !');
    }
    
}
