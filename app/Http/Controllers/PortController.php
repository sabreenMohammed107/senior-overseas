<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Port;
use App\Models\Country;
use App\Models\Port_type;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
class PortController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Port $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'port.';
        $this->routeName = 'port.';
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
        $rows = Port::orderBy("created_at", "Desc")->get();
        $countries = Country::all();
        $types=Port_type::all();

        return view($this->viewName . 'index', compact('rows', 'countries','types'));
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
            'port_name' => $request->input('port_name'),
            'door_port' => $request->input('door_port'),
           

        ];
        if ($request->input('port_type_id')) {

            $data['port_type_id'] = $request->input('port_type_id');
        }
        if ($request->input('country_id')) {

            $data['country_id'] = $request->input('country_id');
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
        $row = Port::where('id', '=', $id)->first();
        $countries = Country::all();
        $types=Port_type::all();
        return view($this->viewName . 'edit', compact('row','countries','types' ));
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
            'port_name' => $request->input('port_name'),
            'door_port' => $request->input('door_port'),
           

        ];
        if ($request->input('port_type_id')) {

            $data['port_type_id'] = $request->input('port_type_id');
        }
        if ($request->input('country_id')) {

            $data['country_id'] = $request->input('country_id');
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
        $row = Port::where('id', '=', $id)->first();
       

        try {
            $row->delete();
          
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Data Has Been Deleted Successfully !');
    }
}
