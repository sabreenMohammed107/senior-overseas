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
                <h6>Ocean Freight</h6>
                <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#addSubCat"> add new </a>
            </div>
            <div class="ms-panel-body">
                <div class="table-responsive">
                    <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Carrier Name</th>
                                <th>Pol</th>
                                <th>Pod</th>
                                <th>Container</th>
                                <th>Price</th>
                                <th>Currency</th>
                                <th>Transit Time (Days</th>
                                <th>Validitiy date</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $index => $row)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->code}}</td>
                                <!-- <td>
                                    {{$row->ocean_freight}}</td>-->
                                <td> 
                                    @if($row->carrier)
                                    {{$row->carrier->carrier_name}}
                                    @endif
                                </td>
                                <td> @if($row->pol)
                                    {{$row->pol->port_name}} - {{$row->pol->country->country_name}}
                                    @endif</td>
                                <td> @if($row->pod)
                                    {{$row->pod->port_name}} - {{$row->pod->country->country_name}}
                                    @endif</td>
                                <td> @if($row->container)
                                {{$row->container->container_size}}-{{$row->container->container_type}} 
                                    @endif</td>
                                <td> {{$row->price}}</td>
                                <td> @if($row->currency)
                                    {{$row->currency->currency_name}}
                                    @endif</td>
                                <td> {{$row->transit_time}}</td>
                                <td>   <?php $date = date_create($row->validity_date) ?>
                                {{ date_format($date,'Y-m-d') }}</td>

                                <td>
                                    <a href="{{ route('ocean-freight.edit',$row->id) }}" class="btn btn-info d-inline-block">edit</a>
                                    <a href="#" onclick="destroy('this ocean-freight','{{$row->id}}')" class="btn d-inline-block btn-danger">delete</a>
                                    <form id="delete_{{$row->id}}" action="{{ route('ocean-freight.destroy', $row->id) }}" method="POST" style="display: none;">
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
            <h3>Add Ocean Freight</h3>
            <div class="modal-body">
                <div class="ms-auth-container row no-gutters">
                    <div class="col-12 p-3">
                    <form action="{{route('ocean-freight.store')}}" method="POST" >
                            {{ csrf_field() }}
                            <div class="ms-auth-container row">
                                <!-- <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Ocean Freight</label>
                                        <input type="text" name="ocean_freight" class="form-control" placeholder="Ocean Freight">
                                    </div>
                                </div> -->
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Carrier Name</label>
                                        <select name="carrier_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($carriers as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->carrier_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Price</label>
                                        <input type="number" name="price" class="form-control" placeholder="Price">
                                    </div>
                                </div>
                               
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Pol</label>
                                        <select name="pol_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($pols as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->port_name}} - {{$type->country->country_name}}</option>
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
                                                {{ $type->port_name}} - {{$type->country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Container</label>
                                        <select name="container_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($containers as $type)
                                            <option value='{{$type->id}}'>
                                            {{$type->container_size}}-{{$type->container_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Currency</label>
                                        <select name="currency_id" class="form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($currencies as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->currency_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Transit Time (Days)</label>
                                        <input type="number" name="transit_time" class="form-control" placeholder="Transit Time (Days)">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Validitiy Date</label>
                                        <input type="date" name="validity_date" class="form-control" placeholder="Validitiy Date">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
                                        <textarea id="newClint" name="notes" class="form-control" placeholder="Notes" rows="3"></textarea>
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