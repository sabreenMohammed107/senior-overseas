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
                <h6>Operation</h6>
                <div>
                    <a href="{{ route('operations.create') }}" class="btn btn-dark"> add new </a>
                    <!-- <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#addSubCat"> Send to Accounting </a> -->
                </div>
            </div>
            <div class="ms-panel-body">
                <div class="table-responsive">
                    <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Operation Code</th>
                                <th>Operation Date</th>
                                <th>Shipper</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $index => $row)
                            <tr>
                                <td>{{$index+1}}</td>

                                <td>{{$row->operation_code}}</td>
                                <td><?php $date = date_create($row->operation_date) ?>
                                    {{ date_format($date,'Y-m-d') }}</td>
                                <td>@if($row->shipper)
                                    {{$row->shipper->client_name}}
                                    @endif</td>
                                <td>
                                    @if($row->account_confirm==1)
                                    <button class="btn btn-info d-inline-block" disabled>view</button>
                                    <button class="btn btn-info d-inline-block" disabled>edit</button>
                                    <button class="btn d-inline-block btn-danger" disabled>delete</button>
                                    <button class="btn d-inline-block btn-dark" disabled>send To Account</button>

                                    @else
                                    <a href="{{ route('operations.show',$row->id) }}" class="btn btn-info d-inline-block" role="button" data-role="button" disabled='disabled'>view</a>
                                    <a href="{{ route('operations.edit',$row->id) }}" class="btn btn-info d-inline-block">edit</a>
                                    <a href="#" onclick="destroy('operations','{{$row->id}}')" class="btn d-inline-block btn-danger">delete</a>
                                    <form id="delete_{{$row->id}}" action="{{ route('operations.destroy', $row->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" value=""></button>
                                    </form>

                                    <a href="#" onclick="sendAccount('operations','{{$row->id}}')" class="btn d-inline-block btn-dark">Send To Account</a>
                                    <form id="send_{{$row->id}}" action="{{ route('aaa', $row->id) }}" method="POST" style="display: none;">
                                        @csrf

                                        <button type="submit" value=""></button>
                                    </form>
                                    @endif
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
</div>
<!-- /.row -->


</div>




<!-- Add new Modal -->
<div class="modal fade" id="addSubCat" tabindex="-1" role="dialog" aria-labelledby="addSubCat">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">X

            </button>
            <h3>Add Agent</h3>
            <div class="modal-body">
                <div class="ms-auth-container row no-gutters">
                    <div class="col-12 p-3">
                        <form action="">
                            <div class="ms-auth-container row">

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Agent_Name</label>
                                        <input type="text" class="form-control" placeholder="Client Name">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Contact_Person</label>
                                        <input type="text" class="form-control" placeholder="Contact Person">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Email</label>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Phone</label>
                                        <input type="tel" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Mobile</label>
                                        <input type="tel" class="form-control" placeholder="Mobile">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Country</label>
                                        <select class=" form-control" data-live-search="true">
                                            <option>Select ...</option>
                                            <option>Egypt</option>
                                            <option>Kuwait</option>
                                            <option>Emarate</option>
                                        </select>


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
@section('scripts')

<script>
    // delete alert
    function sendAccount(thing, id) {
        Swal.fire({
            title: 'Are you sure send this to account ?',
            text: "You won't be able to  this  " + thing + " again!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, send it!'
        }).then((result) => {
            if (result.value) {
                $('#send_' + id).submit();
            }
        })
    }
</script>
@endsection