<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
class EmployeeController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Employee $object)
    {
        $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'employee.';
        $this->routeName = 'employee.';
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
        $rows = Employee::orderBy("created_at", "Desc")->get();
       

        return view($this->viewName . 'index', compact('rows'));
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
            'employee_name' => $request->input('employee_name'),
            'national_id' => $request->input('national_id'),
            'phone' => $request->input('phone'),
            'mobile' => $request->input('mobile'),
            'mobile2' => $request->input('mobile2'),
            'position' => $request->input('position'),
            'salary' => $request->input('salary'),
            'address' => $request->input('address'),
            'notes' => $request->input('notes'),
           
           
          

        ];
      
        if ($request->hasFile('employee_document')) {
            $file = $request->file('employee_document');

            $data['employee_document'] = $this->UplaodFile($file);
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
        $row = Employee::where('id', '=', $id)->first();
       
        
        return view($this->viewName . 'edit', compact('row' ));
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
            'employee_name' => $request->input('employee_name'),
            'national_id' => $request->input('national_id'),
            'phone' => $request->input('phone'),
            'mobile' => $request->input('mobile'),
            'mobile2' => $request->input('mobile2'),
            'position' => $request->input('position'),
            'salary' => $request->input('salary'),
            'address' => $request->input('address'),
            'notes' => $request->input('notes'),
           
           
          

        ];
      
        if ($request->hasFile('employee_document')) {
            $file = $request->file('employee_document');

            $data['employee_document'] = $this->UplaodFile($file);
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
        $row = Employee::where('id', '=', $id)->first();
        // Delete File ..
        $file = $row->employee_document;

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
