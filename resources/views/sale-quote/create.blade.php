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
				<form action="{{ route('sale-quote.store') }}" method="post">
					@csrf
					<div class="row">
						<input type="hidden" name="savingType" value="{{$typeTesting}}">
						<div class="col-md-4 mb-3">
							<div class="ui-widget form-group">
								<label>Client</label>
								<select name="client_id" class=" form-control" data-live-search="true">
									<option value="">Select ...</option>
									@foreach ($clients as $type)
									<option value='{{$type->id}}'>
										{{ $type->client_name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-md-4 mb-3">
							<div class="form-group">
								<label class="exampleInputPassword1" for="exampleCheck1">Quote Date</label>
								<input type="date" class="form-control" name="quote_date" placeholder="Quote Date">
							</div>
						</div>
						<div class="col-md-4 mb-3">
						<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">qoute type</label>
				  					<select class="form-control" name="sale_quotes_type_id" data-live-search="true" required>
				  						<option>Select ...</option>
				  						<option value="1">Fake</option>
				  						<option value="2">Exist</option>
				  						
									  </select>
						</div>
								  </div>
								  <div class="col-md-4 mb-3">
							<div class="ui-widget form-group">
								<label>Employee</label>
								<select name="sale_person_id" class=" form-control" data-live-search="true">
									<option value="">Select ...</option>
									@foreach ($employees as $type)
									<option value='{{$type->id}}'>
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
										<th> Carrier</th>
										@if($typeTesting==0)
										<th>Range</th>
										<th> Aol</th>
										<th> Aod</th>
										
										<th> Note</th>
										@else
										<th> Pol</th>
										<th> Pod</th>
										<th>Transit Time (Days</th>
										<th> Note</th>
										@endif
										<th>Price</th>

										<th>Ckecked box</th>
									</tr>
								</thead>
								<tbody>
									@foreach($filtters as $index => $row)
									<tr>
										<td>{{$index+1}}</td>
										<td>@if($row->carrier)
											{{$row->carrier->carrier_name}}
											@endif</td>
										@if($typeTesting==0)
										<td>{{$row->slide_range}}</td>
										<td>@if($row->aol)
											{{$row->aol->port_name}} - {{$row->aol->country->country_name}}
											@endif</td>
										<td>@if($row->aod)
											{{$row->aod->port_name}} - {{$row->aod->country->country_name}}
											@endif</td>
											
											<td>{{$row->notes}}</td>
										@else
										<td>@if($row->pol)
											{{$row->pol->port_name}} - {{$row->pol->country->country_name}}
											@endif</td>
										<td>@if($row->pod)
											{{$row->pod->port_name}} - {{$row->pod->country->country_name}}
											@endif</td>
											<td> {{$row->transit_time}}</td>
											<td>{{$row->notes}}</td>
										@endif

										<td>
											<input name='price{{$row->id}}[]' type="number" value="{{$row->price}}">
										</td>
										<td><input name='tableId[]' type="checkbox" id="checkItem" value="{{$row->id}}">


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

												@foreach($trackings as $index => $row)
												<tr>
													<td>{{$index+1}}</td>
													<td>@if($row->supplier)
														{{$row->supplier->supplier_name}}
														@endif</td>
													<td>@if($row->pol)
														{{$row->pol->port_name}} - {{$row->pol->country->country_name}}
														@endif</td>
													<td>@if($row->pod)
														{{$row->pod->port_name}} - {{$row->pod->country->country_name}}
														@endif</td>
														<td>@if($row->car)
														{{$row->car->car_type}} 
														@endif</td>
														<td>{{$row->transit_time}}</td>
                                                    <td>{{$row->notes}}</td>
													<td>
														<input name='car_price{{$row->id}}[]' type="number" value="<?php echo $trackings[$index]->car_price; ?>">
													</td>
													<td>
														<input name='idTracking[]' type="checkbox" id="checkItem" value="<?php echo $trackings[$index]->id; ?>">
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
											<select name="supplier_id" class="form-control" data-live-search="true">
												<option value="">Select ...</option>
												@foreach ($clearancesSuppliers as $type)
												<option value='{{$type->id}}'>
													{{ $type->supplier_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6 mb-3">
										<div class="form-group">
											<label class="exampleInputPassword1" for="exampleCheck1">*Clearance Price</label>
											<input type="number" name="clearance_price" class="form-control" placeholder="Clearance Price">
										</div>
									</div>
									<div class="col-md-6 mb-3">
										<div class="ui-widget form-group">
											<label>Clearance Currency</label>
											<select name="clearance_currency_id" class="form-control" data-live-search="true">
												<option value="">Select ...</option>
												@foreach ($clearances as $type)
												<option value='{{$type->id}}'>
													{{ $type->currency_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6 mb-3">
										<div class="form-group">
											<label class="exampleInputPassword1" for="exampleCheck1">Clearance Notes</label>
											<textarea name="clearance_notes" class="form-control" placeholder="Notes" rows="3"></textarea>
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
											<select name="agent_id"  class="form-control" data-live-search="true">
												<option value="">Select ...</option>
												@foreach ($agents as $type)
												<option value='{{$type->id}}'>
													{{ $type->agent_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6 mb-3">
										<div class="form-group">
											<label class="exampleInputPassword1" for="exampleCheck1">*Door to Door Price</label>
											<input type="number" name="door_door_price" class="form-control" placeholder="Door to Door Price">
										</div>
									</div>
									<div class="col-md-6 mb-3">
										<div class="ui-widget form-group">
											<label>Door Currency</label>
											<select name="door_door_currency_id" class="form-control" data-live-search="true">
												<option value="">Select ...</option>
												@foreach ($doors as $type)
												<option value='{{$type->id}}'>
													{{ $type->currency_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6 mb-3">
										<div class="form-group">
											<label class="exampleInputPassword1" for="exampleCheck1">Door to Door notes</label>
											<textarea name="door_door_notes" class="form-control" placeholder="Notes" rows="3"></textarea>
										</div>
									</div>
								</div>

							</div>
							<div class="input-group d-flex justify-content-end text-center">
								<a href="{{ route('sale-quote.index') }}" class="btn btn-dark mx-2"> Cancel</a>
								<!-- <input type="button" value="Cancel" class="btn btn-dark mx-2" data-dismiss="modal" aria-label="Close"> -->
								<input type="submit" value="Add" class="btn btn-success ">
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