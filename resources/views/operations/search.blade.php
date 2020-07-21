<div class="ms-auth-container row">
	<input type="hidden" name="shipper_id" value="{{$sale_qoute->client->id ?? 'Client ( Shipper )' }}">
	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">Client ( Shipper )</label>
			<input type="text" class="form-control" value="{{$sale_qoute->client->client_name ?? 'Client ( Shipper )' }}" placeholder="Client ( Shipper )" readonly>
		</div>
	</div>
	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">Sale Person</label>
			<input type="text" class="form-control" value="{{$sale_qoute->employee->employee_name ?? 'Sale person' }}" placeholder="Sale Person" readonly>
		</div>
	</div>
	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">Operation Date</label>
			<input type="date" name="operation_date" required class="form-control" placeholder="Operation Date">
		</div>
	</div>
	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">Import Export</label>
			<select class="form-control" required name="import_export_flag" data-live-search="true">
				<!-- <option>Select ...</option> -->
				<option value="1">Import</option>
				<option value="2">Export</option>

			</select>
		</div>
	</div>
	<div class="col-md-12 mb-3">
		<div class="ms-panel ms-panel-fh">
			<div class="ms-panel-body">
				<div class="accordion has-gap ms-accordion-chevron" id="accordionExample2">
					<div class="card">
						<div class="card-header" data-toggle="collapse" role="button" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
							<span> Quote Data</span>
						</div>
						<div id="collapseSix" class="collapse" data-parent="#accordionExample2">
							<div class="card-body">
								<style>
									.hide {
										display: none;
									}
								</style>
								<div class="row">
									<div class="col-md-12">
										<div class="ms-panel">
											<div class="ms-panel-header d-flex justify-content-between">
												<!-- <h6>Ocean Freight</h6> -->
												<!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
											</div>
											<div class="ms-panel-body">
												<!-- <form>
													  						<input type="radio" name="tab" value="igotnone" onclick="show1();" checked /> Air
													  						<input type="radio" name="tab" value="igottwo" onclick="show2();" clicked="clicked" /> Ocean
													  					</form> -->
												<div class="ms-auth-container row no-gutters">
													<div class="col-12 p-3">

														<div class="ms-auth-container row">




														<div class="col-md-6 mb-3">
																<div class="form-group">
																	<label class="exampleInputPassword1" for="exampleCheck1">*Clearance supplier</label>
																	<input type="text" value="{{ $sale_qoute->supplier->supplier_name  ??'' }}" class="form-control" placeholder="Clearance supplier" disabled>
																</div>
															</div>


															<div class="col-md-6 mb-3">
																<div class="form-group">
																	<label class="exampleInputPassword1" for="exampleCheck1">*Clearance Price</label>
																	<input type="number" value="{{ $sale_qoute->clearance_price ?? 'Clearance Price' }}" class="form-control" placeholder="Clearance Price" disabled>
																</div>
															</div>
															<div class="col-md-6 mb-3">
																<div class="ui-widget form-group">
																	<label>Currency</label>
																	<select class=" form-control" data-live-search="true" disabled>
																		@foreach ($clearances as $type)
																		<option value='{{$type->id}}' {{ $type->id == $sale_qoute->clearance_currency_id ? 'selected' : '' }}>
																			{{ $type->currency_name}}</option>
																		@endforeach
																	</select>
																</div>
															</div>
															<div class="col-md-6 mb-3">
																<div class="form-group">
																	<label class="exampleInputPassword1" for="exampleCheck1">Clearance Notes</label>
																	<textarea id="newClint" class="form-control" placeholder="Notes" rows="3" disabled>{{$sale_qoute->clearance_notes}}</textarea>
																</div>
															</div>
														</div>


														<div style="border-bottom:solid #0094ff 2px;margin-bottom:15px"></div>
														<div class="ms-auth-container row">
														<div class="col-md-6 mb-3">
																<div class="form-group">
																	<label class="exampleInputPassword1" for="exampleCheck1">*Door Agent</label>
																	<input type="text" value="{{ $sale_qoute->agent->agent_name  ??'' }}" class="form-control" placeholder="Door Agent" disabled>
																</div>
															</div>
															<div class="col-md-6 mb-3">
																<div class="form-group">
																	<label class="exampleInputPassword1" for="exampleCheck1">*Door to Door Price</label>
																	<input type="number" value="{{$sale_qoute->door_door_price ?? 'Door to Door Price' }}" class="form-control" placeholder="Door to Door Price" disabled>
																</div>
															</div>
															<div class="col-md-6 mb-3">
																<div class="ui-widget form-group">
																	<label>Currency</label>
																	<select class=" form-control" data-live-search="true" disabled>
																		@foreach ($doors as $type)
																		<option value='{{$type->id}}' {{ $type->id == $sale_qoute->door_door_currency_id ? 'selected' : '' }}>
																			{{ $type->currency_name}}</option>
																		@endforeach
																	</select>
																</div>
															</div>
															<div class="col-md-6 mb-3">
																<div class="form-group">
																	<label class="exampleInputPassword1" for="exampleCheck1">Door to Door notes</label>
																	<textarea id="newClint" class="form-control" placeholder="Notes" rows="3" disabled>{{$sale_qoute->door_door_notes}}</textarea>
																</div>
															</div>
														</div>



													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Data Table-->
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

					<th>Select</th>
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
						{{$filter->price}}
					</td>
					<td scope="col">
						@if($typeTesting==0)

						<input name="airSelected" id="userSelected_1" type="radio" value="{{$filter->id}}" >
						@else
						<input name="oceanSelected" id="userSelected_1" type="radio" value="{{$filter->id}}" >

						@endif
					</td>


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

								<th>Supplier</th>
								<th> Pol</th>
								<th> Pod</th>
								<th> Car</th>
								<th>Transit Time (Days</th>
								<th>Notes</th>
								<th>Price</th>
								<th>Select</th>
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
									<?php echo $trackings[$index]->car_price; ?>
								</td>
								<td scope="col">
									<input name="TrackingSelected" id="TrackingSelected" type="radio" value="{{$track->id}}" >
								</td>

							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
				<!-- End Table -->


			</div>
		</div>


	</div>
</div>
<!-- End Data Table-->
<div style="border-bottom:solid #0094ff 2px;">
	<h2>Operations Data</h2>
</div><br />
<div class="ms-auth-container row">

	<div class="col-md-6 mb-3">
		<div class="ui-widget form-group">
			<label>Consignee</label>
			<select class="form-control" data-live-search="true" name="consignee_id">
				<option value="">Select ...</option>
				@foreach ($consinee as $type)
				<option value='{{$type->id}}'>
					{{ $type->client_name}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-md-6 mb-3">
		<div class="ui-widget form-group">
			<label>Notify</label>
			<select class="form-control" data-live-search="true" name="notify_id">
				<option value="">Select ...</option>
				@foreach ($notify as $type)
				<option value='{{$type->id}}'>
					{{ $type->client_name}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">Containers Counts</label>
			<input type="text" class="form-control" name="container_counts" placeholder="Containers Counts">
		</div>
	</div>
	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">Container/s Names</label>
			<textarea id="newClint" class="form-control" name="container_name" placeholder="Container/s Names" rows="3"></textarea>
		</div>
	</div>
	<!-- <div class="col-md-6 mb-3">
		<div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
			<textarea id="newClint" name="notes" class="form-control" placeholder="Notes" rows="3"></textarea>
		</div>
	</div> -->
	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">Loading Date</label>
			<input type="date" name="loading_date" class="form-control" placeholder="Loading Date">
		</div>
	</div>
	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">Arrival Date</label>
			<input type="date" name="arrival_date" class="form-control" placeholder="arrival Date">
		</div>
	</div>
</div>

<div style="border-bottom:solid #0094ff 2px;">
	<h2>Policy Data</h2>
</div><br />
<div class="ms-auth-container row">

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">PL No</label>
			<input type="text" name="pl_no" class="form-control" placeholder="PL No">
		</div>
	</div>
	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">Vassel Name</label>
			<input type="text" name="vassel_name" class="form-control" placeholder="Vassel Name">
		</div>
	</div>
	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">Booking No</label>
			<input type="text" name="booking_no" class="form-control" placeholder="Booking No">
		</div>
	</div>

	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">Commodity</label>
			<select class="form-control" name="commodity_id" data-live-search="true">
				<option value="">Select ...</option>
				@foreach ($Commodity as $type)
				<option value='{{$type->id}}'>
					{{ $type->name}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-md-6 mb-3">
		<div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">cut-off date</label>
			<input type="date" name="cut_off_date" class="form-control" placeholder="cut-off date">
		</div>
	</div>
</div>
<div class="col-md-6 mb-3">
	<div class="form-group">
		<label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
		<textarea id="newClint" name="notes" class="form-control" placeholder="Notes" rows="3"></textarea>
	</div>
</div>
<div class="input-group d-flex justify-content-end text-center">
	<a href="{{ route('operations.index') }}" class="btn btn-dark mx-2"> Cancel</a>
	<!-- <input type="button" value="Cancel" class="btn btn-dark mx-2" data-dismiss="modal" aria-label="Close"> -->
	<input type="submit" value="Add" class="btn btn-success ">
</div>
</form>