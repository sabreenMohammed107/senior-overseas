@extends('layout.main')

@section('crumb')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href=""><i class="material-icons"></i> {{ __(' Home') }} </a></li>
    </ol>
  </nav>

@endsection

@section('content')

<div class="row">
<div class="col-md-12">



<div class="ms-panel">
  <div class="ms-panel-header d-flex justify-content-between">
    <h6>Employees</h6>
    <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
  </div>
  <div class="ms-panel-body">
    <div class="ms-auth-container row no-gutters">
        <div class="col-12 p-3">
        <form action="{{route('employee.update',$row->id)}}" method="POST" enctype="multipart/form-data" >

{{ csrf_field() }}

@method('PUT')
            <div class="ms-auth-container row">

<div class="col-md-6 mb-3">
    <div class="form-group">
        <label class="exampleInputPassword1" for="exampleCheck1">*Name</label>
        <input type="text" class="form-control" value="{{$row->employee_name}}" name="employee_name" placeholder="Name">
    </div>
</div>
<div class="col-md-6 mb-3">
    <div class="form-group">
        <label class="exampleInputPassword1" for="exampleCheck1">*National Id</label>
        <input type="text" class="form-control" value="{{$row->national_id}}" name="national_id" placeholder="National Id">
    </div>
</div>
<div class="col-md-6 mb-3">
    <div class="form-group">
        <label class="exampleInputPassword1" for="exampleCheck1">Phone</label>
        <input type="tel" class="form-control" value="{{$row->phone}}" name="phone" placeholder="Phone">
    </div>
</div>
<div class="col-md-6 mb-3">
    <div class="form-group">
        <label class="exampleInputPassword1" for="exampleCheck1">*Mobile</label>
        <input type="tel" class="form-control" value="{{$row->mobile}}" name="mobile" placeholder="Mobile">
    </div>
</div>

<div class="col-md-6 mb-3">
    <div class="form-group">
        <label class="exampleInputPassword1" for="exampleCheck1">*Mobile2</label>
        <input type="tel" class="form-control" value="{{$row->mobile2}}" name="mobile2" placeholder="Mobile2">
    </div>
</div>
<div class="col-md-6 mb-3">
    <div class="form-group">
        <label class="exampleInputPassword1" for="exampleCheck1">*Position</label>
        <input type="text" class="form-control" value="{{$row->position}}" name="position" placeholder="Position">
    </div>
</div>

<div class="col-md-6 mb-3">
    <div class="form-group">
        <label class="exampleInputPassword1" for="exampleCheck1">*Salary</label>
        <input type="number" class="form-control" value="{{$row->salary}}" name="salary" placeholder="Salary">
    </div>
</div>

<div class="col-md-6 mb-3">
    <div class="form-group">
        <label class="exampleInputPassword1" for="exampleCheck1">Address</label>
        <textarea id="newClint" class="form-control" name="address" placeholder="Address" rows="5">{{$row->address}}</textarea>
    </div>
</div>
<div class="col-md-6 mb-3">
    <div class="form-group">
        <label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
        <textarea id="newClint" class="form-control" name="notes" placeholder="Notes" rows="5">{{$row->notes}}</textarea>
    </div>
</div>
<div class="col-md-12 mb-3">
    <label> pdf </label>
    <div class="fileUpload">
        <div class="upload-icon">
            <img src="https://image.flaticon.com/icons/svg/136/136549.svg" class="icon">
            <input type="file" class="upload up" name="employee_document" id="up" onchange="readURLFile(this);" />
            <span class="upl" id="upload">{{$row->employee_document}}</span>
        </div>
    </div>
</div>
</div>
          <div class="input-group d-flex justify-content-end text-center">
          <a href="{{ route('employee.index') }}" class="btn btn-dark mx-2"> Cancel</a>
              <!-- <input type="button" value="Cancel" class="btn btn-dark mx-2" data-dismiss="modal" aria-label="Close"> -->
              <input type="submit" value="Add" class="btn btn-success ">
          </div>
            </form>
        </div>
    </div>
  </div>
</div>
</div>
        </div>
        <!-- /.row -->


</div>
@endsection