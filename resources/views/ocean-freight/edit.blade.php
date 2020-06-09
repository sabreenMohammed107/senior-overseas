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
                <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
            </div>
            <div class="ms-panel-body">
                <div class="ms-auth-container row no-gutters">
                    <div class="col-12 p-3">
                        <form action="{{route('ocean-freight.update',$row->id)}}" method="POST">

                            {{ csrf_field() }}

                            @method('PUT')
                            <div class="ms-auth-container row">
                                <!-- <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Ocean Freight</label>
                                        <input type="text" name="ocean_freight" value="{{$row->ocean_freight}}" class="form-control" placeholder="Ocean Freight">
                                    </div>
                                </div> -->
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Carrier Name</label>
                                        <select name="carrier_id" class=" form-control" data-live-search="true">
                                            <option value=""> @if($row->carrier)
                                                {{$row->carrier->carrier_name}}
                                                @endif</option>
                                            @foreach ($carriers as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->carrier_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
							<div class="form-group">
								<label class="exampleInputPassword1" for="exampleCheck1"> Code</label>
								<input type="text" class="form-control" value="{{$row->code}}" placeholder="Code" disabled>
							</div>
						</div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Price</label>
                                        <input type="number" name="price" value="{{$row->ocean_freight}}" class="form-control" placeholder="Price">
                                    </div>
                                </div>
                               
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Pol</label>
                                        <select name="pol_id" class=" form-control" data-live-search="true">
                                            <option value="">@if($row->pol)
                                                {{$row->pol->port_name}} - {{$row->pol->country->country_name}}
                                                @endif</option>
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
                                            <option value="">@if($row->pod)
                                                {{$row->pod->port_name}} - {{$row->pod->country->country_name}}
                                                @endif</option>
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
                                            <option value="">@if($row->container)
                                            {{$row->container->container_size}}-{{$row->container->container_type}}
                                                @endif</option>
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
                                            <option value="">@if($row->currency)
                                                {{$row->currency->currency_name}}
                                                @endif</option>
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
                                        <input type="number" name="transit_time" value="{{$row->transit_time}}" class="form-control" placeholder="Transit Time (Days)">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <?php $date = date_create($row->validity_date) ?>
                                        <label class="exampleInputPassword1" for="exampleCheck1">Validitiy Date</label>
                                        <input type="date" name="validity_date" value="{{ date_format($date,'Y-m-d') }}" class="form-control" placeholder="Validitiy Date">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
                                        <textarea id="newClint" name="notes" class="form-control" placeholder="Notes" rows="3">{{$row->notes}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group d-flex justify-content-end text-center">
                                <a href="{{ route('ocean-freight.index') }}" class="btn btn-dark mx-2"> Cancel</a>


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