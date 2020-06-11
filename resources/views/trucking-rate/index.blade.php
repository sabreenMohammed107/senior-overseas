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
                <h6>Trucking Rates</h6>
                <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#addSubCat"> add new </a>
            </div>
            <div class="ms-panel-body">
                <div class="table-responsive">
                    <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Supplier</th>
                                <th>Pol</th>
                                <th>Pod</th>
                                <th>Car Price</th>
                                <th>Car Currency</th>
                                <th>Car Type</th>
                              
                                <th>Validity Date</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $index => $row)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->code}}</td>
                                <td>@if($row->supplier)
                                    {{$row->supplier->supplier_name}} 
                                    @endif</td>
                                <td>@if($row->pol)
                                    {{$row->pol->port_name}} - {{$row->pol->country->country_name}}
                                    @endif</td>
                                <td>@if($row->pod)
                                    {{$row->pod->port_name}} - {{$row->pod->country->country_name}}
                                    @endif</td>
                                <td>{{$row->car_price}}</td>
                                <td>@if($row->currency)
                                    {{$row->currency->currency_name}}
                                    @endif</td>
                              
                                <td>@if($row->car)
                                    {{$row->car->car_type}}
                                    @endif</td>
                               
                                <td>  <?php $date = date_create($row->validity_date) ?>
                                {{ date_format($date,'Y-m-d') }}</td>

                                <td>
                                    <a href="{{ route('trucking-rate.edit',$row->id) }}" class="btn btn-info d-inline-block">edit</a>
                                    <a href="#" onclick="destroy('this trucking-rate','{{$row->id}}')" class="btn d-inline-block btn-danger">delete</a>
                                    <form id="delete_{{$row->id}}" action="{{ route('trucking-rate.destroy', $row->id) }}" method="POST" style="display: none;">
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
            <h3>Add Trucking Rates</h3>
            <div class="modal-body">
                <div class="ms-auth-container row no-gutters">
                    <div class="col-12 p-3">
                        <form action="{{route('trucking-rate.store')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="ms-auth-container row">
                            <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Supplier</label>
                                        <select name="supplier_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($suppliers as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->supplier_name}}  </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3"></div>
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Pol</label>
                                        <select name="pol_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($pols as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->port_name}} - @if($type->country){{$type->country->country_name}}@endif </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Pod</label>
                                        <select name="pod_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($pods as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->port_name}} - @if($type->country){{$type->country->country_name}}@endif </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Car Price</label>
                                        <input type="number" name="car_price" class="form-control" placeholder="Car Price">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Transit Time (Days)</label>
                                        <input type="number" name="transit_time"  class="form-control" placeholder="Transit Time (Days)">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Car Currency</label>
                                        <select name="car_currency_id" class="form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($courencies as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->currency_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Car Type</label>
                                        <select name="car_type_id" class="form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($cars as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->car_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                              
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Validitiy Date</label>
                                        <input type="date" class="form-control" name="validity_date" placeholder="Validitiy Date">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
                                        <textarea id="newClint" class="form-control" name="notes" placeholder="Notes" rows="3"></textarea>
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