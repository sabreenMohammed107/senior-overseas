<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrier;

use App\Models\Carrier_type;
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
        return view($this->viewName . 'edit', compact('row','types' ));
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
}
