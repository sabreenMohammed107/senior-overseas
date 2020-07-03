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
    <style>
        .hide {
            display: none;
        }
    </style>

    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header d-flex justify-content-between">
                <h6>Sale Quote</h6>
                <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
            </div>
            <div class="ms-panel-body">
                <form action="{{ route('sale-quote.update',$row->id) }}" method="post">
                    {{ csrf_field() }}

                    @method('PUT')
                    <div class="row">
                      
                        <input type="hidden" name="savingType" value="{{$typeTesting}}">
                        <div class="col-md-4 mb-3">
                            <div class="ui-widget form-group">
                                <label>Client</label>
                                <select name="client_id" disabled class=" form-control" data-live-search="true">
                                    <option value="">Select ...</option>
                                    @foreach ($clients as $type)
                                    <option value='{{$type->id}}' {{ $type->id == $row->client_id ? 'selected' : '' }}>
                                        {{ $type->client_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
            <div class="form-group">
              <label>Quote Date </label>
              <?php $date = date_create($row->quote_date) ?>
                                   
              <input type="date" disabled name="quote_date" value="{{ date_format($date,'Y-m-d') }}" class="form-control" >
            </div>
          </div>
          <div class="col-md-4 mb-3">
							<div class="form-group">
								<label class="exampleInputPassword1" for="exampleCheck1">Quote Code</label>
								<input type="text" class="form-control" name="quote_code" readonly value="{{$row->quote_code}}" placeholder="Quote code">
							</div>
						</div>
          <div class="col-md-4 mb-3">
							<div class="ui-widget form-group">
								<label>Employee</label>
								<select name="sale_person_id" class=" form-control"disabled data-live-search="true">
									<option value="">Select ...</option>
									@foreach ($employees as $type)
                                    <option value='{{$type->id}}' {{ $type->id == $row->sale_person_id ? 'selected' : '' }}>
										{{ $type->employee_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
                    </div>

                    <div class="ms-auth-container row no-gutters">
                        <div class="col-12 p-3">
                            <!--datatable select data -->
                            <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        @if($typeTesting==0)
                                        <th> Carrier</th>
                                       
                                        <th> Rang</th>
                                        <th> Aol</th>
                                        <th> Aod</th>
                                        <th> Notes</th>

                                        @else
                                        <th> Carrier</th>
                                       
                                        <th> Pol</th>
                                        <th> Pod</th>
                                        <th>Transit Time (Days</th>
                                        <th> Notes</th>
                                        @endif
                                        <th>Price</th>

                                        <th>Ckecked box</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($filtters as $index => $filter)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                       
                                            
                                        @if($typeTesting==0)
                                        <td>@if($filter->air->carrier)
                                            {{$filter->air->carrier->carrier_name}}
                                            @endif</td>
                                        <td>{{$filter->air->slide_range}}</td>
                                        
                                        <td>@if($filter->air->aol)
                                            {{$filter->air->aol->port_name}} - {{$filter->air->aol->country->country_name}}
                                            @endif</td>
                                        <td>@if($filter->air->aod)
                                            {{$filter->air->aod->port_name}} - {{$filter->air->aod->country->country_name}}
                                            @endif</td>
                                        <td>{{$filter->air->notes}}</td>
                                        @else
                                        <td>@if($filter->ocean->carrier)
                                            {{$filter->ocean->carrier->carrier_name}}
                                            @endif</td>
                                        <td>@if($filter->ocean->pol)
                                            {{$filter->ocean->pol->port_name}} - {{$filter->ocean->pol->country->country_name}}
                                            @endif</td>
                                        <td>@if($filter->ocean->pod)
                                            {{$filter->ocean->pod->port_name}} - {{$filter->ocean->pod->country->country_name}}
                                            @endif</td>
                                            <td> {{$filter->ocean->transit_time}}</td>
                                        <td>{{$filter->ocean->notes}}</td>

                                        @endif

                                        <td>
                                            <input disabled name='price{{$filter->id}}[]' type="number" value="{{$filter->price}}">
                                        </td>
                                        <td>

                                            <input disabled name='tableId[]' checked type="checkbox" id="checkItem" value="{{$filter->id}}">


                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                <div style="border-bottom:solid 2px #0094ff;margin-bottom:20px"></div>
                                <div class="ms-auth-container row">
                                    <!-- Tracking table -->
                                    <div class="col-12 p-3">
                                        <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> supplier</th>
                                                    
                                                    <th> Pol</th>
                                                    <th> Pod</th>
                                                    <th> Car</th>
                                                    <th>Transit Time (Days</th>
                                                    <th>Notes</th>
                                                    <th>Price</th>
                                                    <th>Ckecked box</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($trackings as $index => $track)
                                                <tr>
                                                    <td>{{$index+1}}</td>
                                                    <td>@if($track->truck->supplier)
                                                        {{$track->truck->supplier->supplier_name}}
                                                        @endif</td>
                                                    <td>@if($track->truck->pol)
                                                        {{$track->truck->pol->port_name}} - {{$track->truck->pol->country->country_name}}
                                                        @endif</td>
                                                    <td>@if($track->truck->pod)
                                                        {{$track->truck->pod->port_name}} - {{$track->truck->pod->country->country_name}}
                                                        @endif</td>
                                                    <td>@if($track->truck->car)
                                                        {{$track->truck->car->car_type}}
                                                        @endif</td>
                                                        <td>{{$track->truck->transit_time}}</td>
                                                    <td>{{$track->truck->notes}}</td>
                                                    <td>
                                                        <input disabled name='car_price{{$track->id}}[]' type="number" value="<?php echo $trackings[$index]->car_price; ?>">
                                                    </td>
                                                    <td>
                                                        <input disabled name='idTracking[]' checked type="checkbox" id="checkItem" value="<?php echo $trackings[$index]->id; ?>">
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- End Table -->


                                </div>
                            </div>
                            <div>
                                <div style="border-bottom:solid 2px #0094ff;margin-bottom:20px"></div>
                                <div class="ms-auth-container row">
                                <div class="col-md-6 mb-3">
										<div class="ui-widget form-group">
											<label>Clearance Suppliers</label>
											<select name="supplier_id" disabled class="form-control" data-live-search="true">
												<option value="">Select ...</option>
												@foreach ($clearancesSuppliers as $type)
												<option value='{{$type->id}}' {{ $type->id == $row->supplier_id ? 'selected' : '' }}>
													{{ $type->supplier_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">*Clearance Price</label>
                                            <input type="number" disabled name="clearance_price" value="{{$row->clearance_price}}" class="form-control" placeholder="Clearance Price">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="ui-widget form-group">
                                            <label>Clearance Currency</label>
                                            <select name="clearance_currency_id" disabled class="form-control" data-live-search="true">
                                                <option value="">Select ...</option>
                                                @foreach ($clearances as $type)
                                                <option value='{{$type->id}}' {{ $type->id == $row->clearance_currency_id ? 'selected' : '' }}>
                                                    {{ $type->currency_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">Clearance Notes</label>
                                            <textarea name="clearance_notes" disabled class="form-control" placeholder="Notes" rows="3">{{$row->clearance_notes}}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div>
                                <div style="border-bottom:solid 2px #0094ff;margin-bottom:20px"></div>
                                <div class="ms-auth-container row">
                                <div class="col-md-6 mb-3">
										<div class="ui-widget form-group">
											<label>Door Agent</label>
											<select name="agent_id" disabled class="form-control" data-live-search="true">
												<option value="">Select ...</option>
												@foreach ($agents as $type)
												<option value='{{$type->id}}' {{ $type->id == $row->agent_id ? 'selected' : '' }}>
													{{ $type->agent_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">*Door to Door Price</label>
                                            <input type="number" disabled name="door_door_price" class="form-control" value="{{$row->door_door_price}}" placeholder="Door to Door Price">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="ui-widget form-group">
                                            <label>Door Currency</label>
                                            <select name="door_door_currency_id" disabled class="form-control" data-live-search="true">
                                                <option value="">Select ...</option>
                                                @foreach ($doors as $type)
                                                <option value='{{$type->id}}' {{ $type->id == $row->door_door_currency_id ? 'selected' : '' }}>
                                                    {{ $type->currency_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">Door to Door notes</label>
                                            <textarea name="door_door_notes" disabled class="form-control" placeholder="Notes" rows="3">{{$row->door_door_notes}}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="input-group d-flex justify-content-end text-center">
                                <a href="{{ route('sale-quote.index') }}" class="btn btn-dark mx-2"> Cancel</a>
                                <!-- <input type="button" value="Cancel" class="btn btn-dark mx-2" data-dismiss="modal" aria-label="Close"> -->
                                <!-- <input type="submit" value="Add" class="btn btn-success "> -->
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->


</div>
@endsection
@section('scripts')


<!--radio button-->
<script>
    function show1() {
        document.getElementById('div1').style.display = 'none';
        document.getElementById('div2').style.display = 'block';
    }

    function show2() {
        document.getElementById('div2').style.display = 'none';
        document.getElementById('div1').style.display = 'block';
    }


    function air() {
        var value = document.getElementById('code').value;

        $.ajax({
            url: "{{route('fetchAir')}}",
            method: "get",
            data: {

                value: value
            },
            success: function(result) {

                $('#air_aol_id').val(result[0]);
                $('#air_aod_id').val(result[1]);
                $('#air_slide_range').val(result[2]);
                $('#air_validity_date').val(result[3]);
                $('#air_notes').html(result[4]);
                $('#air_rate_id').val(result[5]);
                $('#air_price').val(result[6]);
                $output = '<option value="">' + result[7] + '</option>';
                $('#air_currency_id').html($output);

            }

        })
    }
</script>
<!--/radio button-->


<script>
    $(document).ready(function() {





        //trucking
        // $('.truckingCarrier').change(function() {

        // 	if ($(this).val() != '') {
        // 		var select = $(this).attr("id");
        // 		var value = $(this).val();



        // 		$.ajax({
        // 			url: "{{route('fetchTrucking')}}",
        // 			method: "get",
        // 			data: {
        // 				select: select,
        // 				value: value
        // 			},
        // 			success: function(result) {

        // 				$('#trucking_pol_id').val(result[0]);
        // 				$('#trucking_pod_id').val(result[1]);
        // 				$('#trucking_validity_date').val(result[2]);
        // 				$('#trucking_notes').html(result[3]);


        // 			}

        // 		})
        // 	}
        // });




    });

    function codetrack() {
        var value = document.getElementById('codetracking').value;


        $.ajax({
            url: "{{route('fetchTrucking')}}",
            method: "get",
            data: {

                value: value
            },
            success: function(result) {

                $('#trucking_pol_id').val(result[0]);
                $('#trucking_pod_id').val(result[1]);
                $('#trucking_validity_date').val(result[2]);
                $('#trucking_notes').html(result[3]);


            }

        })
    }

    function codeocean() {


        var value = document.getElementById('codeOcean').value;

        $.ajax({
            url: "{{route('fetchOcean')}}",
            method: "get",
            data: {

                value: value
            },
            success: function(result) {
                alert(result[7]);
                $('#ocean_pol_id').val(result[0]);
                $('#ocean_pod_id').val(result[1]);
                $('#ocean_container_id').val(result[2]);
                $('#ocean_validity_date').val(result[3]);
                $('#ocean_notes').html(result[4]);
                $('#ocean_transit_time').val(result[5]);
                $('#ocean_rate_id').val(result[6]);
                $('#ocean_price').val(result[7]);
                $output = '<option value="">' + result[8] + '</option>';
                $('#ocean_currency_id').html($output);

            }

        })

    }
</script>
@endsection