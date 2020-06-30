<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Air_rate;
use App\Models\Carrier;
use App\Models\Port;

use App\Models\Currency;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class AirRateController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Air_rate $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'air-rate.';
        $this->routeName = 'air-rate.';
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
        $rows = Air_rate::orderBy("created_at", "Desc")->get();
        $carriers = Carrier::all();
        $aols = Port::all();
        $aods = Port::all();
        $currencies = Currency::all();


        return view($this->viewName . 'index', compact('rows', 'carriers', 'aols', 'aods', 'currencies',));
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

         $maxValue = Air_rate::orderBy('id', 'desc')->value('code');
         if ($maxValue != null) {
             $max = $maxValue + 1;
         } else {
             $max = 100;
         }
        $data = [
            'code'=>$max,
            'slide_range' => $request->input('slide_range'),
            'price' => $request->input('price'),
            'notes' => $request->input('notes'),
            'validity_date' => Carbon::parse($request->input('validity_date')),


        ];
        if ($request->input('air_carrier_id')) {

            $data['air_carrier_id'] = $request->input('air_carrier_id');
        }
        if ($request->input('aol_id')) {

            $data['aol_id'] = $request->input('aol_id');
        }
        if ($request->input('aod_id')) {

            $data['aod_id'] = $request->input('aod_id');
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
        $row = Air_rate::where('id', '=', $id)->first();
       
        $carriers = Carrier::all();
        $aols = Port::all();
        $aods = Port::all();
        $currencies = Currency::all();


        return view($this->viewName . 'edit', compact('row', 'carriers', 'aols', 'aods', 'currencies',));
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
            'slide_range' => $request->input('slide_range'),
            'price' => $request->input('price'),
            'notes' => $request->input('notes'),
            'validity_date' => Carbon::parse($request->input('validity_date')),


        ];
        if ($request->input('air_carrier_id')) {

            $data['air_carrier_id'] = $request->input('air_carrier_id');
        }
        if ($request->input('aol_id')) {

            $data['aol_id'] = $request->input('aol_id');
        }
        if ($request->input('aod_id')) {

            $data['aod_id'] = $request->input('aod_id');
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
        $row = Air_rate::where('id', '=', $id)->first();
       

        try {
            $row->delete();
          
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Data Has Been Deleted Successfully !');
    }
    
}
