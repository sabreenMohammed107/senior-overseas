<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trucking_rate;

use App\Models\Port;
use App\Models\Supplier;
use App\Models\Currency;
use App\Models\Car_type;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
class TruckingRateController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Trucking_rate $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'trucking-rate.';
        $this->routeName = 'trucking-rate.';
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
        $rows = Trucking_rate::orderBy("created_at", "Desc")->get();
       
        $pols = Port::all();
        $pods = Port::all();
        $cars = Car_type::all();
        $courencies = Currency::all();
        
       $suppliers=Supplier::where('supplier_type_id','=',1)->get();

        return view($this->viewName . 'index', compact('rows','suppliers', 'pols', 'pods', 'cars', 'courencies'));
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

          $maxValue = Trucking_rate::orderBy('id', 'desc')->value('code');
          if ($maxValue != null) {
              $max = $maxValue + 1;
          } else {
              $max = 100;
          }
        $data = [
            'code'=>$max,
            'car_price' => $request->input('car_price'),
          
            'transit_time' => $request->input('transit_time'),
            'notes' => $request->input('notes'),
            'validity_date'=>Carbon::parse($request->input('validity_date')),
           

        ];
      
        if ($request->input('supplier_id')) {

            $data['supplier_id'] = $request->input('supplier_id');
        }
        if ($request->input('pol_id')) {

            $data['pol_id'] = $request->input('pol_id');
        }
        if ($request->input('pod_id')) {

            $data['pod_id'] = $request->input('pod_id');
        }
     
        if ($request->input('car_currency_id')) {

            $data['car_currency_id'] = $request->input('car_currency_id');
        }
        if ($request->input('car_type_id')) {

            $data['car_type_id'] = $request->input('car_type_id');
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
        $row = Trucking_rate::where('id', '=', $id)->first();
       
        $pols = Port::all();
        $pods = Port::all();
        $cars = Car_type::all();
        $courencies = Currency::all();
        $suppliers=Supplier::where('supplier_type_id','=',1)->get();

        return view($this->viewName . 'edit', compact('row','suppliers', 'pols', 'pods', 'cars', 'courencies'));
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
            'car_price' => $request->input('car_price'),
          
            'transit_time' => $request->input('transit_time'),
            'notes' => $request->input('notes'),
            'validity_date'=>Carbon::parse($request->input('validity_date')),
           

        ];
      
        if ($request->input('supplier_id')) {

            $data['supplier_id'] = $request->input('supplier_id');
        }
        if ($request->input('pol_id')) {

            $data['pol_id'] = $request->input('pol_id');
        }
        if ($request->input('pod_id')) {

            $data['pod_id'] = $request->input('pod_id');
        }
     
        if ($request->input('car_currency_id')) {

            $data['car_currency_id'] = $request->input('car_currency_id');
        }
        if ($request->input('car_type_id')) {

            $data['car_type_id'] = $request->input('car_type_id');
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
        $row = Trucking_rate::where('id', '=', $id)->first();
       

        try {
            $row->delete();
          
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Data Has Been Deleted Successfully !');
    }
    
}
