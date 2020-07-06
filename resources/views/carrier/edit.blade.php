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
				<h6>Carrier</h6>
				<!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
			</div>
			<div class="ms-panel-body">
				<div class="ms-auth-container row no-gutters">
					<div class="col-12 p-3">
						<form action="{{route('carrier.update',$row->id)}}" method="POST">

							{{ csrf_field() }}

							@method('PUT')
							<div class="ms-auth-container row">
								<div class="col-md-12 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Carrier Name</label>
										<input type="text" class="form-control" value="{{$row->carrier_name}}" name="carrier_name" placeholder="Carrier Name">
									</div>
								</div>
								<div class="col-md-12 mb-3">
									<div class="ui-widget form-group">
										<label>Carrier Type</label>
										<select class=" form-control" name="carrier_type_id" data-live-search="true">
											<option value=""> @if($row->type)
												{{ $row->type->carrier_name}}
												@endif</option>
											@foreach ($types as $type)
											<option value='{{$type->id}}'>
												{{ $type->carrier_name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-12 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Phone</label>
										<input type="text" class="form-control" value="{{$row->phone}}" name="phone" placeholder=" phone">
									</div>
								</div>
								<div class="col-md-12 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Address</label>
										<textarea id="newClint" name="address" class="form-control" placeholder="Address">{{$row->address}}</textarea>
									</div>
								</div>
							</div>
							<div class="input-group d-flex justify-content-end text-center">
								<a href="{{ route('carrier.index') }}" class="btn btn-dark mx-2"> Cancel</a>

								<input type="submit" value="Add" class="btn btn-success ">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- New Data -->
<div class="ms-auth-container row">
	<div class="col-md-12 mb-3">
		<div class="tabbable-panel">
			<div class="tabbable-line">
				<ul class="nav nav-tabs " role="tablist">
					<li class="btn btn-light test">
						<a href="#tab_default_1" class="active" data-toggle="tab" role="tab">
							Balance Data
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
										<button class="btn btn-dark" data-toggle="modal" data-target="#addSubCat"> add new </a>
									</div>
									<div class="ms-panel-body">

										<div class="table-responsive">
											<table id="courseEval" class="dattable table table-striped thead-dark  w-100">
												<thead>
													<tr>
														<th>#</th>
														<th>Open Balance</th>
														<th>Balance Date</th>
														<th>Current Balance</th>
														<th> Currency</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>


													@foreach($balances as $index => $balance)
													<tr>
														<td>{{$index+1}}</td>
														<td>
															{{$balance->open_balance}}
														</td>
														<td><?php $date = date_create($balance->balance_start_date) ?>
															{{ date_format($date,'Y-m-d') }}
														</td>
														<td>
															<?php
															if ($row->carrier_type_id == 1) {
																$currentBalance = App\Models\Financial_entry::where('ocean_carrier_id', $row->id)->where('currency_id', $balance->currency_id) ->sum('depit')- App\Models\Financial_entry::where('ocean_carrier_id', $row->id)->where('currency_id', $balance->currency_id) ->sum('credit');
															} else {
																$currentBalance = App\Models\Financial_entry::where('air_carrier_id', $row->id)->where('currency_id', $balance->currency_id) ->sum('depit') - App\Models\Financial_entry::where('air_carrier_id', $row->id)->where('currency_id', $balance->currency_id) ->sum('credit');
															}

															?>
															{{$currentBalance}}
														</td>
														<td>@if($balance->currency)
															{{$balance->currency->currency_name}}
															@endif
														</td>

														<td>
															<!-- <a href="#" class="btn btn-info d-inline-block" data-toggle="modal" data-target="#addSubCat">edit</a>
																	<a href="#" onclick="destroy('expense','')" class="btn d-inline-block btn-danger">delete</a> -->

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
						<!--End Expenses-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- /.row -->
</div>

</div>


<!-- Add new Modal -->
<div class="modal fade" id="addSubCat" tabindex="-1" role="dialog" aria-labelledby="addSubCat">
	<div class="modal-dialog modal-lg " role="document">
		<div class="modal-content">
			<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">X

			</button>
			<h3>Add Balance</h3>
			<div class="modal-body">
				<div class="ms-auth-container row no-gutters">
					<div class="col-12 p-3">
						<form action="{{route('addopenBalance')}}" method="POST">
							@csrf
							<input type="hidden" name="carrier_id" value="{{$row->id}}">
							<div class="ms-auth-container row">




								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">*Open Balance</label>
										<input name="open_balance" type="text" class="form-control" placeholder="open balance">
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">* Balance Date</label>
										<input name="balance_start_date" type="date" class="form-control" placeholder="date">
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
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
										<textarea name="note" id="newClint" class="form-control" placeholder="Notes" rows="3"></textarea>
									</div>
								</div>
							</div>
							<div class="input-group d-flex justify-content-end text-center">
								<a href="{{ route('carrier.index') }}" class="btn btn-dark mx-2"> Cancel</a>
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