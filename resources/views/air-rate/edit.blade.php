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
                <h6>Air Rates</h6>
                <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
            </div>
            <div class="ms-panel-body">
                <div class="ms-auth-container row no-gutters">
                    <div class="col-12 p-3">
                        <form action="{{route('air-rate.update',$row->id)}}" method="POST">

                            {{ csrf_field() }}

                            @method('PUT')
                            <div class="ms-auth-container row">
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Air Carrier</label>
                                        <select name="air_carrier_id" class=" form-control" data-live-search="true">
                                            <option value="">@if($row->carrier)
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
                                    <div class="ui-widget form-group">
                                        <label>Currency</label>
                                        <select name="currency_id" class="form-control" data-live-search="true">
                                            <option value="">@if($row->currency)
                                                {{$row->currency->currency_name}}
                                                @endif</option>
                                            @foreach ($currencies as $type)
                                            <option value='{{$type->id}}'>
                                                {{$type->currency_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Aol</label>
                                        <select name="aol_id" class=" form-control" data-live-search="true">
                                            <option value="">@if($row->aol)
                                                {{$row->aol->port_name}} - {{$row->aol->country->country_name}}
                                                @endif</option>
                                            @foreach ($aols as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->port_name}}- {{$type->country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Aod</label>
                                        <select name="aod_id" class=" form-control" data-live-search="true">
                                            <option value="">@if($row->aod)
                                                {{$row->aod->port_name}} - {{$row->aod->country->country_name}}
                                                @endif</option>
                                            @foreach ($aods as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->port_name}} - {{$type->country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Slide Range</label>
                                        <input type="text" name="slide_range" value="{{$row->slide_range}}" class="form-control" placeholder="Slide Range">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Price</label>
                                        <input type="number" name="price" value="{{$row->price}}" class="form-control" placeholder="Price">
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
                                        <textarea id="newClint" class="form-control" name="notes" placeholder="Notes" rows="3">{{$row->notes}} </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group d-flex justify-content-end text-center">
                                <a href="_air_rates.html" class="btn btn-dark mx-2"> Cancel</a>
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