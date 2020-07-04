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
                <h6>Bank</h6>
                <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#addSubCat"> add new </a>
            </div>
            <div class="ms-panel-body">
                <div class="table-responsive">
                    <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bank Name</th>
                                <th>Open Balance</th>
                                <th>Balance Start Date</th>
                                <th>Current Balance</th>
                                <th>Currency</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($rows as $index => $row)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->name}}</td>
                                <td>
                                    <?php $date = date_create($row->balance_start_date) ?>
                                    {{ date_format($date,'Y-m-d') }}
                                </td>
                                <td>{{$row->open_balance}}
                                </td>
                                <td>@if($row->currency)
                                    {{$row->currency->currency_name}}
                                    @endif
                                </td>
                                <td>{{$row->current_balance}}
                                </td>
                                <td>
                                    <a href="{{ route('bank.edit',$row->id) }}" class="btn btn-info d-inline-block">edit</a>
                                    <a href="#" onclick="destroy('this bank','{{$row->id}}')" class="btn d-inline-block btn-danger">delete</a>
                                    <form id="delete_{{$row->id}}" action="{{ route('bank.destroy', $row->id) }}" method="POST" style="display: none;">
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
</div>

@endsection


@section('modal')
<!-- Add new Modal -->
<div class="modal fade" id="addSubCat" tabindex="-1" role="dialog" aria-labelledby="addSubCat">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">X

            </button>
            <h3>Add Bank</h3>
            <div class="modal-body">
                <div class="ms-auth-container row no-gutters">
                    <div class="col-12 p-3">
                    <form action="{{route('bank.store')}}" method="POST">
							@csrf
                            <div class="ms-auth-container row">

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name">
                                    </div>
                                </div>


                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Balance Start Date</label>
										<input name="balance_start_date" type="date" class="form-control" placeholder="date">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Open Balance</label>
										<input name="open_balance" type="text" class="form-control" placeholder="open balance">
                                    </div>
                                </div>
                             
                                <div class="col-md-6 mb-3">
									<div class="ui-widget form-group">
										<label>Currency</label>
										<select name="currency_id" class=" form-control" data-live-search="true">
											<option value="">Select ...</option>
											@foreach ($carrencies as $data)
											<option value='{{$data->id}}'>
												{{$data->currency_name}}</option>
											@endforeach

										</select>


									</div>
								</div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
										<textarea name="note" id="newClint" class="form-control" placeholder="Notes" rows="3"></textarea>
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