<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank_account;
use App\Models\Currency;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
class BankAccountController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Bank_account $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'bank-account.';
        $this->routeName = 'bank-account.';
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
        $rows = Bank_account::orderBy("created_at", "Desc")->get();
        $currancies = Currency::all();

        return view($this->viewName . 'index', compact('rows', 'currancies'));
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
            'beneficiary' => $request->input('beneficiary'),
            'account_number' => $request->input('account_number'),
            'bank_name' => $request->input('bank_name'),
            'company_name' => $request->input('company_name'),
         
            'address' => $request->input('address'),
           
          

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
     

        $row = Bank_account::where('id', '=', $id)->first();
        $currancies = Currency::all();
        
        return view($this->viewName . 'edit', compact('row','currancies' ));
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
            'beneficiary' => $request->input('beneficiary'),
            'account_number' => $request->input('account_number'),
            'bank_name' => $request->input('bank_name'),
            'company_name' => $request->input('company_name'),
         
            'address' => $request->input('address'),
           
          

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
        $row = Bank_account::where('id', '=', $id)->first();
      

        try {
            $row->delete();
         
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Data Has Been Deleted Successfully !');
    }
}
