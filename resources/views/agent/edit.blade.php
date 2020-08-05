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
				<h6>Agent</h6>
				<!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
			</div>
			<div class="ms-panel-body">
				<div class="ms-auth-container row no-gutters">
					<div class="col-12 p-3">
						<form action="{{route('agent.update',$row->id)}}" method="POST" enctype="multipart/form-data">

							{{ csrf_field() }}

							@method('PUT')
							<div class="ms-auth-container row">
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">*Agent Name</label>
										<input type="text" class="form-control" value="{{$row->agent_name}}" name="agent_name" placeholder="Agent Name">
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">*Contact Person</label>
										<input type="text" class="form-control" value="{{$row->contact_person}}" name="contact_person" placeholder="Contact Person">
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Email</label>
										<input type="email" class="form-control" value="{{$row->email}}" name="email" placeholder="Email">
									</div>
								</div>

								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">*Mobile</label>
										<input type="tel" class="form-control" name="mobile" value="{{$row->mobile}}" placeholder="Mobile">
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="ui-widget form-group">
										<label>Country</label>
										<select name="country_id" class="form-control" data-live-search="true">
											<option value="">
												@if($row->country)
												{{ $row->country->country_name}}
												@endif
											</option>
											@foreach ($countries as $country)
											<option value='{{$country->id}}'>
												{{ $country->country_name}}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Phone</label>
										<input type="tel" class="form-control" name="phone" value="{{$row->phone}}" placeholder="Phone">
									</div>
								</div>


							</div>
							<div class="input-group d-flex justify-content-end text-center">
								<a href="{{ route('agent.index') }}" class="btn btn-dark mx-2"> Cancel</a>

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
															$currentBalance = App\Models\Financial_entry::where('agent_id', $row->id)->where('currency_id', $balance->currency_id)->sum('credit') - App\Models\Financial_entry::where('agent_id', $row->id)->where('currency_id', $balance->currency_id)->sum('depit');

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
						<form action="{{route('addopenBalanceAgent')}}" method="POST">
							@csrf
							<input type="hidden" name="agent_id" value="{{$row->id}}">
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
										<input name="balance_start_date" required type="date" class="form-control" placeholder="date">
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
@endsection