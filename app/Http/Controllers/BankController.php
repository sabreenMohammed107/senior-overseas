<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Bank;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
class BankController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Bank $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'bank.';
        $this->routeName = 'bank.';
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
        $rows = Bank::orderBy("created_at", "Desc")->get();
        $carrencies = Currency::all();

        return view($this->viewName . 'index', compact('rows', 'carrencies'));
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
            'name' => $request->input('name'),
            'open_balance' => $request->input('open_balance'),
            'current_balance' => $request->input('open_balance'),
            'note' => $request->input('note'),
            'balance_start_date' => Carbon::parse($request->input('balance_start_date')),

        ];

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
        $row = Bank::where('id', '=', $id)->first();
      
        $carrencies=Currency::all();
      
        return view($this->viewName . 'edit', compact('row','carrencies', ));
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
            'name' => $request->input('name'),
            'open_balance' => $request->input('open_balance'),
            'current_balance' => $request->input('open_balance'),
            'note' => $request->input('note'),
            'balance_start_date' => Carbon::parse($request->input('balance_start_date')),

        ];

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
        $row = Bank::where('id', '=', $id)->first();
      
        try {
            $row->delete();
         
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Data Has Been Deleted Successfully !');
    }
}