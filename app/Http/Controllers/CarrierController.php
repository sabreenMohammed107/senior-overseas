<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrier;

use App\Models\Carrier_type;
use App\Models\Currency;
use App\Models\Open_balance;
use App\Models\Financial_entry;
use App\Models\Finan_trans_type;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
class CarrierController extends Controller
{

    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Carrier $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'carrier.';
        $this->routeName = 'carrier.';
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
        $rows = Carrier::orderBy("created_at", "Desc")->get();
      
        $types=Carrier_type::all();

        return view($this->viewName . 'index', compact('rows','types'));
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
        $data = [
            'carrier_name' => $request->input('carrier_name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
           

        ];
        if ($request->input('carrier_type_id')) {

            $data['carrier_type_id'] = $request->input('carrier_type_id');
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
        $row = Carrier::where('id', '=', $id)->first();
      
        $types=Carrier_type::all();
        $carrencies=Currency::all();
        $balances=Open_balance::where('carrier_id','=',$id)->get();
        return view($this->viewName . 'edit', compact('row','types' ,'carrencies','balances'));
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
            'carrier_name' => $request->input('carrier_name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
           

        ];
        if ($request->input('carrier_type_id')) {

            $data['carrier_type_id'] = $request->input('carrier_type_id');
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
        $row = Carrier::where('id', '=', $id)->first();
       

        try {
            $row->delete();
          
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Data Has Been Deleted Successfully !');
    }

    /***
     * addOpenBalance
     */
    public function addOpenBalance(Request $request){
        $data = [
            'carrier_id' => $request->input('carrier_id'),
            'open_balance' => $request->input('open_balance'),
            'current_balance' => $request->input('open_balance'),
            'note' => $request->input('note'),
            'balance_start_date' => Carbon::parse($request->input('balance_start_date')),

        ];

        if ($request->input('currency_id')) {

            $data['currency_id'] = $request->input('currency_id');
        }
       
        DB::transaction(function () use ($data,  $request) {
            
            $open=Open_balance::create($data);
   
            //save in finance entry
            $fin_data=[
                'trans_type_id'=>Finan_trans_type::where('id','=',1)->first()->id,
                'entry_date'=>Carbon::parse($request->input('balance_start_date')),
                'depit'=> $request->input('open_balance'),
                'currency_id'=> $request->input('currency_id'),
               
                'notes'=> $request->input('note'),
               
            ];
            if (Carrier::where('id','=',$request->input('carrier_id'))->first()->carrier_type_id==1) {

                $fin_data['ocean_carrier_id'] = Carrier::where('id','=',$request->input('carrier_id'))->first()->id;
            }else{
                $fin_data['air_carrier_id'] =Carrier::where('id','=',$request->input('carrier_id'))->first()->id;
            }
            Financial_entry::create($fin_data);
        });

        return redirect()->back()->with('flash_success', $this->message);

    }
}
