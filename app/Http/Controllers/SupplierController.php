<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Country;
use App\Models\Supplier_type;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
class SupplierController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Supplier $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'supplier.';
        $this->routeName = 'supplier.';
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
        $rows = Supplier::orderBy("created_at", "Desc")->get();
        $countries = Country::all();
        $types=Supplier_type::all();

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
            'supplier_name' => $request->input('supplier_name'),
            'contact_person' => $request->input('contact_person'),
            'phone' => $request->input('phone'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
           
          

        ];
        if ($request->input('supplier_type_id')) {

            $data['supplier_type_id'] = $request->input('supplier_type_id');
        }
        if ($request->input('country_id')) {

            $data['country_id'] = $request->input('country_id');
        }
        if ($request->hasFile('supplier_document')) {
            $file = $request->file('supplier_document');

            $data['supplier_document'] = $this->UplaodFile($file);
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
       

        $row = Supplier::where('id', '=', $id)->first();
        $countries = Country::all();
        $types=Supplier_type::all();
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
            'supplier_name' => $request->input('supplier_name'),
            'contact_person' => $request->input('contact_person'),
            'phone' => $request->input('phone'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
           
          

        ];
        if ($request->input('supplier_type_id')) {

            $data['supplier_type_id'] = $request->input('supplier_type_id');
        }
        if ($request->input('country_id')) {

            $data['country_id'] = $request->input('country_id');
        }
        if ($request->hasFile('supplier_document')) {
            $file = $request->file('supplier_document');

            $data['supplier_document'] = $this->UplaodFile($file);
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
        $row = Supplier::where('id', '=', $id)->first();
        // Delete File ..
        $file = $row->supplier_document;

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
}
