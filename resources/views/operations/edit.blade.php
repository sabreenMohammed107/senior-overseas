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
		<!--data from create-->
		<div class="ms-panel">
			<div class="ms-panel-header d-flex justify-content-between">
				<h6>Operations</h6>
				<!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
			</div>
			<div class="ms-panel-body">
				<div class="ms-auth-container row no-gutters">
					<div class="col-12 p-3">
						<form action="{{route('operations.update',$row->id)}}" method="POST">

							{{ csrf_field() }}

							@method('PUT')

							<div class="ms-auth-container row">
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Operation Code</label>
										<input type="text" class="form-control" name="operation_code" value="{{$row->operation_code}}" placeholder="code" readonly>
									</div>
								</div>
								<div class="col-md-6 mb-3 " id="exist">
									<div class="ui-widget form-group">
										<label>Read Quote</label>
										<select id="existselect" name="sales_quote_id" disabled class="form-control dynamic" data-dependent="allData" data-show-subtext="true" data-live-search="true" id="exist">
											<option value="">Select ...</option>
											@foreach ($qouts as $data)
											<option value='{{$data->id}}' {{ $data->id == $row->sales_quote_id ? 'selected' : '' }}>
												{{$data->quote_code}}</option>
											@endforeach
										</select>
									</div>
								</div>

							</div>
							<!--other data in search.blade-->
							<div class="ms-auth-container row">
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Client ( Shipper )</label>
										<input type="text" class="form-control" name="shipper_id" value="{{$row->shipper->client_name ?? 'Client ( Shipper )' }}" placeholder="Client ( Shipper )" readonly>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Sale Person</label>
										<input type="text" class="form-control" value="{{$row->sale->employee->employee_name ?? 'Sale person' }}" placeholder="Sale Person" readonly>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Operation Date</label>

										<?php $date = date_create($row->operation_date) ?>



										<input type="date" name="operation_date" value="{{ date_format($date,'Y-m-d') }}" class="form-control" placeholder="Operation Code">
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Import Export</label>
										<select class="form-control" name="import_export_flag" data-live-search="true" disabled>

											<option>Select ...</option>
											<option value='1' {{ 1 ==$row->import_export_flag ? 'selected' : '' }}>Import</option>
											<option value='2' {{ 2 == $row->import_export_flag ? 'selected' : '' }}>Export</option>

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

															<div class="row">
																<div class="col-md-12">
																	<div class="ms-panel">
																		<div class="ms-panel-header d-flex justify-content-between">

																		</div>
																		<div class="ms-panel-body">

																			<div class="ms-auth-container row no-gutters">
																				<div class="col-12 p-3">

																					<div class="ms-auth-container row">




																						<div class="col-md-6 mb-3">
																							<div class="form-group">
																								<label class="exampleInputPassword1" for="exampleCheck1">*Clearance supplier</label>
																								<input type="text" value="{{ $row->sale->supplier->supplier_name  ??'' }}" class="form-control" placeholder="Clearance supplier" disabled>
																							</div>
																						</div>


																						<div class="col-md-6 mb-3">
																							<div class="form-group">
																								<label class="exampleInputPassword1" for="exampleCheck1">*Clearance Price</label>
																								<input type="number" value="{{ $row->sale->clearance_price ?? 'Clearance Price' }}" class="form-control" placeholder="Clearance Price" disabled>
																							</div>
																						</div>
																						<div class="col-md-6 mb-3">
																							<div class="ui-widget form-group">
																								<label>Currency</label>
																								<select class=" form-control" data-live-search="true" disabled>
																									@foreach ($clearances as $type)
																									<option value='{{$type->id}}' {{ $type->id == $row->sale->clearance_currency_id ? 'selected' : '' }}>
																										{{ $type->currency_name}}</option>
																									@endforeach
																								</select>
																							</div>
																						</div>
																						<div class="col-md-6 mb-3">
																							<div class="form-group">
																								<label class="exampleInputPassword1" for="exampleCheck1">Clearance Notes</label>
																								<textarea id="newClint" class="form-control" placeholder="Notes" rows="3" disabled>{{$row->sale->clearance_notes}}</textarea>
																							</div>
																						</div>
																					</div>


																					<div style="border-bottom:solid #0094ff 2px;margin-bottom:15px"></div>
																					<div class="ms-auth-container row">
																						<div class="col-md-6 mb-3">
																							<div class="form-group">
																								<label class="exampleInputPassword1" for="exampleCheck1">*Door Agent</label>
																								<input type="text" value="{{ $row->sale->agent->agent_name  ??'' }}" class="form-control" placeholder="Door Agent" disabled>
																							</div>
																						</div>
																						<div class="col-md-6 mb-3">
																							<div class="form-group">
																								<label class="exampleInputPassword1" for="exampleCheck1">*Door to Door Price</label>
																								<input type="number" value="{{$row->sale->door_door_price ?? 'Door to Door Price' }}" class="form-control" placeholder="Door to Door Price" disabled>
																							</div>
																						</div>
																						<div class="col-md-6 mb-3">
																							<div class="ui-widget form-group">
																								<label>Currency</label>
																								<select class=" form-control" data-live-search="true" disabled>
																									@foreach ($doors as $type)
																									<option value='{{$type->id}}' {{ $type->id == $row->sale->door_door_currency_id ? 'selected' : '' }}>
																										{{ $type->currency_name}}</option>
																									@endforeach
																								</select>
																							</div>
																						</div>
																						<div class="col-md-6 mb-3">
																							<div class="form-group">
																								<label class="exampleInputPassword1" for="exampleCheck1">Door to Door notes</label>
																								<textarea id="newClint" class="form-control" placeholder="Notes" rows="3" disabled>{{$row->sale->door_door_notes}}</textarea>
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

													<input name="airSelected" id="userSelected_1" type="radio" checked value="{{$filter->id}}">
													@else
													<input name="oceanSelected" id="userSelected_1" type="radio" checked value="{{$filter->id}}">

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
																<input name="TrackingSelected" id="TrackingSelected" type="radio" checked value="{{$track->id}}">
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
											<option value='{{$type->id}}' {{ $type->id == $row->consignee_id ? 'selected' : '' }}>
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
											<option value='{{$type->id}}' {{ $type->id == $row->notify_id ? 'selected' : '' }}>
												{{ $type->client_name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Containers Counts</label>
										<input type="text" class="form-control" value="{{$row->container_counts}}" name="container_counts" placeholder="Containers Counts">
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Container/s Names</label>
										<textarea id="newClint" class="form-control" name="container_name" placeholder="Container/s Names" rows="3">{{$row->container_name}}</textarea>
									</div>
								</div>
								<!-- <div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
										<textarea id="newClint" name="notes" class="form-control" placeholder="Notes" rows="3">{{$row->notes}}</textarea>
									</div>
								</div> -->
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Loading Date</label>
										<?php
										$date1 = date_create($row->loading_date)
										?>
										<input type="date" name="loading_date" value="{{ date_format($date1,'Y-m-d') }}" class="form-control" placeholder="Loading Date">
									</div>
								</div>

								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Arrival Date</label>
										<?php
										$datee = date_create($row->loading_date)
										?>
										<input type="date" name="arrival_date" value="{{ date_format($datee,'Y-m-d') }}" class="form-control" placeholder="Loading Date">
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
										<input type="text" value="{{$row->pl_no}}" name="pl_no" class="form-control" placeholder="PL No">
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Vassel Name</label>
										<input type="text" value="{{$row->vassel_name}}" name="vassel_name" class="form-control" placeholder="Vassel Name">
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Booking No</label>
										<input type="text" value="{{$row->booking_no}}" name="booking_no" class="form-control" placeholder="Booking No">
									</div>
								</div>

								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Commodity</label>
										<select class="form-control" name="commodity_id" data-live-search="true">
											<option value="">Select ...</option>
											@foreach ($Commodity as $type)
											<option value='{{$type->id}}' {{ $type->id == $row->commodity_id ? 'selected' : '' }}>
												{{ $type->name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">cut-off date</label>
										<?php
										$date2 = date_create($row->cut_off_date) ?>
										<input type="date" name="cut_off_date" value="{{ date_format($date2,'Y-m-d') }}" class="form-control" placeholder="cut-off date">
									</div>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
									<textarea id="newClint" name="notes" class="form-control" placeholder="Notes" rows="3">{{$row->notes}}</textarea>
								</div>
							</div>
							<div class="input-group d-flex justify-content-end text-center">
								<a href="{{ route('operations.index') }}" class="btn btn-dark mx-2"> Cancel</a>
								<!-- <input type="button" value="Cancel" class="btn btn-dark mx-2" data-dismiss="modal" aria-label="Close"> -->
								<input type="submit" value="Add" class="btn btn-success ">
							</div>
						</form>

						<!--End other data in search.blade-->



					</div>
				</div>
			</div>
		</div>
		<!--End Data-->

		<div class="ms-auth-container row">
			<div class="col-md-12 mb-3">
				<div class="tabbable-panel">
					<div class="tabbable-line">
						<ul class="nav nav-tabs " role="tablist">
							<li class="btn btn-light test">
								<a href="#tab_default_1" class="active" data-toggle="tab" role="tab">
									Expenses Data
								</a>

							</li>
						</ul>
						<div class="tab-content test ">
							<div class="tab-pane active" id="tab_default_1">
								<!-- Add Expenses -->
								<div class="row">
									<div class="col-md-12">

										<div class="ms-panel">
											<div class="ms-panel-header d-flex justify-content-between">
												<!-- <h6>Expenses Data</h6> -->
												<a href="#" class="btn btn-dark" data-toggle="modal" data-target="#addSubCat"> add new </a>
											</div>
											<div class="ms-panel-body">

												<div class="table-responsive">
													<table id="courseEval" class="dattable table table-striped thead-dark  w-100">
														<thead>
															<tr>
																<th>#</th>
																<th>Expense Type</th>
																<th>Buy</th>
																<th>Sale</th>
																<th>Expense provider</th>
																<th>Currency</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>

															@foreach($expenses as $index => $expense)
															<tr>
																<td>{{$index+1}}</td>
																<td>@if($expense->type)
																	{{$expense->type->expense_name}}
																	@endif
																</td>
																<td>{{$expense->buy}}</td>
																<td>{{$expense->sell}}</td>
																<td>@if($expense->provider)
																	{{$expense->provider->expenses_name}}
																	@endif</td>
																<td>@if($expense->currency)
																	{{$expense->currency->currency_name}}
																	@endif</td>
																<td>
																	@if($expense->automatic!=1)
																	<a href="#" class="btn btn-info d-inline-block" data-toggle="modal" data-target="#addSubCat{{$expense->id}}">edit</a>
																	<a href="#" onclick="destroy('expense','{{$expense->id}}')" class="btn d-inline-block btn-danger">delete</a>
																	<form id="delete_{{$expense->id}}" action="{{ route('deleteOperationExpenses', $expense->id) }}" method="POST" style="display: none;">
																		@csrf

																		<button type="submit" value=""></button>
																	</form>
																	@endif
																</td>
															</tr>
															<!-- Add new Modal -->
															<div class="modal fade" id="addSubCat{{$expense->id}}" tabindex="-1" role="dialog" aria-labelledby="addSubCat">
																<div class="modal-dialog modal-lg " role="document">
																	<div class="modal-content">
																		<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">X

																		</button>
																		<h3>Add Expenses</h3>
																		<div class="modal-body">
																			<div class="ms-auth-container row no-gutters">
																				<div class="col-12 p-3">
																					<form action="{{route('updateOperationExpenses')}}" method="POST">
																						{{ csrf_field() }}


																						<input type="hidden" name="operation_id" value="{{$row->id}}">
																						<input type="hidden" name="expenses_id" value="{{$expense->id}}">
																						<div class="ms-auth-container row">



																							<div class="col-md-6 mb-3">
																								<div class="ui-widget form-group">
																									<label>Expense Type</label>
																									<select name="expenses_type_id" class=" form-control" data-live-search="true">
																										<option value="">Select ...</option>
																										@foreach ($expenseTypes as $data)
																										<option value='{{$data->id}}' {{ $data->id == $expense->expenses_type_id ? 'selected' : '' }}>
																											{{$data->expense_name}}</option>
																										@endforeach
																									</select>


																								</div>
																							</div>


																							<div class="col-md-6 mb-3">
																								<div class="form-group">
																									<label class="exampleInputPassword1" for="exampleCheck1">*Buy</label>
																									<input name="buy" type="text" value="{{$expense->buy}}" <?php if (!$expense->buy) { ?> disabled <?php   } ?> class="form-control" placeholder="buy">
																								</div>
																							</div>
																							<div class="col-md-6 mb-3">
																								<div class="form-group">
																									<label class="exampleInputPassword1" for="exampleCheck1">*Sale</label>
																									<input name="sell" type="text" value="{{$expense->sell}}" <?php if (!$expense->sell) { ?> disabled <?php   } ?> class="form-control" placeholder="sell">
																								</div>
																							</div>
																							<div class="col-md-6 mb-3">
																								<div class="form-group">
																									<label class="exampleInputPassword1" for="exampleCheck1">Provider</label>
																									<input name="sell" type="text" value="{{$expense->provider->expense_name ??'Provider' }}" disabled class="form-control" placeholder="sell">
																								</div>
																							</div>
																							<div class="col-md-6 mb-3">
																								<div class="ui-widget form-group">
																									<label>Selection</label>
																									<select name="xxxselector" disabled class=" form-control xxselector" data-show-subtext="true" data-live-search="true">

																										<option value="{{$expense->ocean_carrier_id}}" {{$expense->ocean_carrier_id !=null ? 'selected' : '' }}>{{$expense->carrierocean->carrier_name ?? '' }}</option>
																										<option value="{{$expense->air_carrier_id}}" {{$expense->air_carrier_id !=null ? 'selected' : '' }}>{{$expense->carrierair->carrier_name ?? '' }} </option>
																										<option value="{{$expense->clearance_id}}" {{$expense->clearance_id !=null? 'selected' : '' }}>{{$expense->supplierclearance->supplier_name ?? '' }} </option>
																										<option value="{{ $expense->trucking_id}}" {{ $expense->trucking_id !=null? 'selected' : '' }}>{{$expense->suppliertracking->supplier_name ?? '' }} </option>
																										<option value="{{ $expense->agent_id}}" {{ $expense->agent_id !=null? 'selected' : '' }}>{{$expense->agent->agent_name ?? '' }} </option>

																									</select>
																								</div>
																							</div>

																							<div class="col-md-6 mb-3">
																								<div class="ui-widget form-group">
																									<label>Currency</label>
																									<select name="currency_id" disabled  class=" form-control" data-live-search="true">
																										<option value="">Select ...</option>
																										@foreach ($expenseCurrency as $data)
																										<option value='{{$data->id}}' {{ $data->id == $expense->currency_id ? 'selected' : '' }}>
																											{{$data->currency_name}}</option>
																										@endforeach
																									</select>


																								</div>
																							</div>
																							<div class="col-md-6 mb-3">
																								<div class="form-group">
																									<label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
																									<textarea name="note" id="newClint" class="form-control" placeholder="Notes" rows="3">{{$expense->note}}</textarea>
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
								<!--End Expenses-->
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
<!-- /.row -->


</div>

<!-- Add new Modal -->
<div class="modal fade" id="addSubCat" tabindex="-1" role="dialog" aria-labelledby="addSubCat">
	<div class="modal-dialog modal-lg " role="document">
		<div class="modal-content">
			<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">X

			</button>
			<h3>Add Expenses</h3>
			<div class="modal-body">
				<div class="ms-auth-container row no-gutters">
					<div class="col-12 p-3">
						<form action="{{route('addOperationExpenses')}}" method="POST">
							@csrf
							<input type="hidden" name="operation_id" value="{{$row->id}}">
							<div class="ms-auth-container row">



								<div class="col-md-6 mb-3">
									<div class="ui-widget form-group">
										<label>Expense Type</label>
										<select name="expenses_type_id" class=" form-control" data-live-search="true">
											<option value="">Select ...</option>
											@foreach ($expenseTypes as $data)
											<option value='{{$data->id}}'>
												{{$data->expense_name}}</option>
											@endforeach
										</select>


									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">*Buy</label>
										<input name="buy" type="text" class="form-control" placeholder="buy">
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">*Sale</label>
										<input name="sell" type="text" class="form-control" placeholder="sell">
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="ui-widget form-group">
										<label>Expense Provider</label>
										<select name="selector_type" data-dependent="xxselector" class=" form-control selector_type" data-show-subtext="true" data-live-search="true" id="selector_type">
											<option>Select ...</option>
											@foreach ($providers as $data)
											<option value='{{$data->id}}'>
												{{$data->expenses_name}}</option>
											@endforeach

										</select>


									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="ui-widget form-group">
										<label>Selection</label>
										<select id="xxselector" name="xxselector" class=" form-control xxselector" data-show-subtext="true" data-live-search="true">


										</select>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="ui-widget form-group">
										<label>Currency</label>
										<select name="currency_id" required class=" form-control" data-live-search="true">
											<option value="">Select ...</option>
											@foreach ($expenseCurrency as $data)
											<option value='{{$data->id}}'>
												{{$data->currency_name}}</option>
											@endforeach
										</select>


									</div>
								</div>
								<div class="col-md-6 mb-3">
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

@section('scripts')

<script>
	$(document).ready(function() {
		$('.selector_type').change(function() {

			if ($(this).val() != '') {
				var select = $(this).attr("id");
				var value = $("#selector_type option:selected").val();

				$.ajax({
					url: "{{route('selector_type_operation.fetch')}}",
					method: "get",
					data: {
						select: select,
						value: value,
						cash: $('#cash').val(),
					},
					success: function(result) {
						$('#xxselector').html(result);

					},
					error: function() {}

				})
			}
		});
	});
</script>
@endsection