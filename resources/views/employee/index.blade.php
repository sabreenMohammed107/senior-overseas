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
                <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#addSubCat"> add new </a>
            </div>
            <div class="ms-panel-body">
                <div class="table-responsive">
                    <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>National Id</th>
                                <th>Phone</th>
                                <th>Mobile</th>
                                <th>Mobile2</th>
                                <th>Position </th>
                                <th>Salary</th>
                                <th>Address</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $index => $row)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->employee_name}}</td>
                                <td>{{$row->national_id}}</td>
                                <td>{{$row->phone}}</td>
                                <td>{{$row->mobile}}</td>
                                <td>{{$row->mobile2}}</td>
                                <td>{{$row->position}} </td>
                                <td>{{$row->salary}}</td>
                                <td>{{$row->address}} </td>

                                <td>
                                    <a href="{{ route('employee.edit',$row->id) }}" class="btn btn-info d-inline-block">edit</a>
                                    <a href="#" onclick="destroy('this employee','{{$row->id}}')" class="btn d-inline-block btn-danger">delete</a>
                                    <form id="delete_{{$row->id}}" action="{{ route('employee.destroy', $row->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" value=""></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->


</div>
@endsection

@section('modal')
<!-- Add new Modal -->
<div class="modal fade" id="addSubCat" tabindex="-1" role="dialog" aria-labelledby="addSubCat">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">X

            </button>
            <h3>Add Employee</h3>
            <div class="modal-body">
                <div class="ms-auth-container row no-gutters">
                    <div class="col-12 p-3">
                    <form action="{{route('employee.store')}}" method="POST"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="ms-auth-container row">

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Name</label>
                                        <input type="text" class="form-control" name="employee_name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*National Id</label>
                                        <input type="text" class="form-control" name="national_id" placeholder="National Id">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Phone</label>
                                        <input type="tel" class="form-control" name="phone" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Mobile</label>
                                        <input type="tel" class="form-control" name="mobile" placeholder="Mobile">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Mobile2</label>
                                        <input type="tel" class="form-control" name="mobile2" placeholder="Mobile2">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Position</label>
                                        <input type="text" class="form-control" name="position" placeholder="Position">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Salary</label>
                                        <input type="number" class="form-control" name="salary" placeholder="Salary">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Address</label>
                                        <textarea id="newClint" class="form-control" name="address" placeholder="Address" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
                                        <textarea id="newClint" class="form-control" name="notes" placeholder="Address" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label> pdf </label>
                                    <div class="fileUpload">
                                        <div class="upload-icon">
                                            <img src="https://image.flaticon.com/icons/svg/136/136549.svg" class="icon">
                                            <input type="file" class="upload up" name="employee_document" id="up" onchange="readURLFile(this);" />
                                            <span class="upl" id="upload">Upload document</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group d-flex justify-content-end text-center">
                                <input type="button" value="Cancel" class="btn btn-dark mx-2" data-dismiss="modal" aria-label="Close">
                                <input type="submit" value="Add" class="btn btn-success ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /Add new Modal -->

@endsection