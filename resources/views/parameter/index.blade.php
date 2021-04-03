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
                <h6>Parameters</h6>
            </div>
            <div class="ms-panel-body">
                <div class="table-responsive">
                    <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $index => $row)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->value}}</td>
                                <td>
                                    <a href="#" class="btn btn-info d-inline-block" data-toggle="modal" data-target="#addSubCat{{$row->id}}">edit</a>

                                </td>
                            </tr>
                            <!-- Add new Modal -->
                            <div class="modal fade" id="addSubCat{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="addSubCat">
                                <div class="modal-dialog modal-lg " role="document">
                                    <div class="modal-content">
                                        <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">X

                                        </button>
                                        <h3>Add Parameter</h3>
                                        <div class="modal-body">
                                            <div class="ms-auth-container row no-gutters">
                                                <div class="col-12 p-3">
                                                    <form action="{{route('parameter.update',$row->id)}}" method="POST">

                                                        {{ csrf_field() }}

                                                        @method('PUT')
                                                        <div class="ms-auth-container row">

                                                            <div class="col-md-12 mb-3">
                                                                <div class="form-group">
                                                                    <label class="exampleInputPassword1" for="exampleCheck1">Parameter Name</label>
                                                                    <input type="text" class="form-control" disabled value="{{$row->name}}" name="name" placeholder="Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <div class="form-group">
                                                                    <label class="exampleInputPassword1" for="exampleCheck1">Parameter Value</label>
                                                                    <input type="text" class="form-control"  value="{{$row->value}}" name="value" placeholder="value">
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


@endsection