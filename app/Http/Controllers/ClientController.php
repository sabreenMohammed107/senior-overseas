<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Open_balance;
use App\Models\Financial_entry;
use App\Models\Finan_trans_type;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class ClientController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Client $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'client.';
        $this->routeName = 'client.';
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
        $rows = Client::orderBy("created_at", "Desc")->get();
        $countries = Country::all();

        return view($this->viewName . 'index', compact('rows', 'countries'));
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
            'client_name' => $request->input('client_name'),
            'contact_person' => $request->input('contact_person'),
            'phone' => $request->input('phone'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
           
          

        ];
        if ($request->input('country_id')) {

            $data['country_id'] = $request->input('country_id');
        }
        if ($request->hasFile('client_document')) {
            $file = $request->file('client_document');

            $data['client_document'] = $this->UplaodFile($file);
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
        $row = Client::where('id', '=', $id)->first();
        $countries = Country::all();
        $carrencies=Currency::all();
        $balances=Open_balance::where('client_id','=',$id)->get();
        return view($this->viewName . 'edit', compact('row','countries','carrencies','balances' ));
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
            'client_name' => $request->input('client_name'),
            'contact_person' => $request->input('contact_person'),
            'phone' => $request->input('phone'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
           
          

        ];
        if ($request->input('country_id')) {

            $data['country_id'] = $request->input('country_id');
        }
        if ($request->hasFile('client_document')) {
            $file = $request->file('client_document');

            $data['client_document'] = $this->UplaodFile($file);
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
        $row = Client::where('id', '=', $id)->first();
        // Delete File ..
        $file = $row->client_document;

        $file_name = public_path('uploads/' . $file);

        try {
            $row->delete();
            File::delete($file_name);
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->route($this->routeName . 'index')->with('flash_success', 'Data Has Been Deleted Successfully !');
    }


    public function UplaodFile($file_request)
	{
		//  This is Image Info..
		$file = $file_request;
		$name = $file->getClientOriginalName();
		$ext  = $file->getClientOriginalExtension();
		$size = $file->getSize();
		$path = $file->getRealPath();
		$mime = $file->getMimeType();


		// Rename The Image ..
		$imageName =$name;
		$uploadPath = public_path('uploads');
		
		// Move The image..
		$file->move($uploadPath, $imageName);
       
		return $imageName;
    }
       /***
     * addOpenBalance
     */
    public function addOpenBalance(Request $request){
        $data = [
            'client_id' => $request->input('client_id'),
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
            'credit'=> $request->input('open_balance'),
            'currency_id'=> $request->input('currency_id'),
            'client_id'=>Client::where('id','=',$request->input('client_id'))->first()->id,
            'notes'=> $request->input('note'),
           
        ];
        Financial_entry::create($fin_data);
    });
        return redirect()->back()->with('flash_success', $this->message);

    }
}
