<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Cash_box;
use App\Models\Financial_entry;
use App\Models\Finan_trans_type;

use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
class CashBoxController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Cash_box $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'cash-box.';
        $this->routeName = 'cash-box.';
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
        $rows = Cash_box::orderBy("created_at", "Desc")->get();
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
       
        

        DB::transaction(function () use ($data,  $request) {
            
            $cash=$this->object::create($data);
         
            //save in finance entry
            $fin_data=[
                'trans_type_id'=>Finan_trans_type::where('id','=',1)->first()->id,
                'entry_date'=>Carbon::parse($request->input('balance_start_date')),
                'depit'=> $request->input('open_balance'),
                'currency_id'=> $request->input('currency_id'),
                'cash_box_id'=>$cash->id,
                'notes'=> $request->input('note'),
               
            ];
            Financial_entry::create($fin_data);
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
        $row = Cash_box::where('id', '=', $id)->first();
      
        $carrencies=Currency::all();
        // $currentBalance = Financial_entry::where('cash_box_id', $id)->sum('depit') - Financial_entry::where('cash_box_id', $id)->sum('credit');
      
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
        $row = Cash_box::where('id', '=', $id)->first();
      
        try {
            $row->delete();
         
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Data Has Been Deleted Successfully !');
    }
}
