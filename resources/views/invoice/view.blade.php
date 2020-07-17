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
                <h6>Invoice</h6>
                <a href="{{route('invoice.index') }}" class="btn btn-danger" > Cancel</a>
            </div>
            <div class="ms-panel-body">
                <div class="ms-auth-container row no-gutters">
                    <div class="col-12 p-3">
                     
                            <div class="ms-auth-container row">
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
										<label>Operation Code</label>
									
                                        <select id="operation_id" disabled name="operation_id" class="form-control dynamic" data-dependent="allData" data-show-subtext="true" data-live-search="true" id="exist">
											<option value="">Select ...</option>
											@foreach ($operations as $type)
											<option value='{{$type->id}}' {{ $type->id == $rowSelected->operation_id ? 'selected' : '' }}>
												{{$type->operation_code}}</option>
											@endforeach
										</select>
                                    </div>
                                </div>
                            </div>
                            <div id="main">

							<div class="ms-auth-container row">
    <div class="col-md-6 mb-3">
        <div class="form-group">
			<label class="exampleInputPassword1" for="exampleCheck1">Invoice Date</label>
			
			<?php $dateinvoice = date_create($rowSelected->invoice_date) ?>

            <input type="date" name="invoice_date" readonly value="{{ date_format($dateinvoice,'Y-m-d') }}" class="form-control" placeholder="Invoice Date">
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Client ( Shipper )</label>
            <input type="text" class="form-control" value="{{$selected->sale->client->client_name ?? 'Client ( Shipper )' }}" placeholder="Client ( Shipper )" readonly>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Client Address</label>
            <input type="text" class="form-control" value="{{$selected->sale->client->address ?? 'Client ( Shipper )' }}" placeholder="Client ( Shipper )" readonly>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Sale Person</label>
            <input type="text" class="form-control" value="{{$selected->sale->employee->employee_name ?? 'Sale person' }}" placeholder="Client ( Shipper )" readonly>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Operation Date</label>
            <?php $date = new dateTime;
            if (isset($selected)) {
                $date = date_create($selected->operation_date);
            }
            ?>

            <input type="date" name="operation_date" value="{{ date_format($date,'Y-m-d') }}" readonly class="form-control" placeholder="Operation Code">
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Import Export</label>
            <select class="form-control" name="import_export_flag" data-live-search="true" disabled>

                <option>Select ...</option>
                @isset($selected)
                <option value='1' {{ 1 ==$selected->import_export_flag ? 'selected' : '' }}>Import</option>
                <option value='2' {{ 2 == $selected->import_export_flag ? 'selected' : '' }}>Export</option>
                @endisset


            </select>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">POL</label>
            <input type="text" class="form-control" value="{{$selected->ocean->ocean->pol->port_name ?? 'Pol' }}" placeholder="Pol" readonly>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Pod</label>
            <input type="text" class="form-control" value="{{$selected->ocean->ocean->pod->port_name ?? 'Pol' }}" placeholder="Pol" readonly>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">AOL</label>
            <input type="text" class="form-control" value="{{$selected->air->air->aol->port_name ?? 'Aol' }}" placeholder="Aol" readonly>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Aod</label>
            <input type="text" class="form-control" value="{{$selected->air->air->aod->port_name ?? 'Aod' }}" placeholder="Aod" readonly>
        </div>
    </div>
</div>

<div style="border-bottom:solid #0094ff 2px;">
    <h2>Operations Data</h2>
</div><br />
<div class="ms-auth-container row">
    <div class="col-md-6 mb-3">
        <div class="ui-widget form-group">
            <label>Consignee</label>

            <input type="text" class="form-control" value="{{$selected->consignee->client_name ?? 'client_name' }}" placeholder="Client ( Shipper )" readonly>

        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Containers Counts</label>
            <input type="text" class="form-control" readonly value="{{$selected->container_counts ?? 'Containers Counts' }}" placeholder="Containers Counts">
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Container/s Names</label>
            <input type="text" class="form-control" readonly placeholder="Container/s Names" value="{{$selected->container_name ?? 'Container/s Names' }}">
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Loading Date</label>

            <?php $date2 = new dateTime;
            if (isset($selected)) {
                $date2 = date_create($selected->loading_date);
            }
            ?>

            <input type="date" name="loading_date" value="{{ date_format($date2,'Y-m-d') }}" readonly class="form-control" placeholder="Operation Code">
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
            <input type="text" class="form-control" readonly placeholder="PL No" value="{{$selected->pl_no ?? 'PL No' }}">
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Vassel Name</label>
            <input type="text" class="form-control" placeholder="Vassel Name" readonly placeholder="PL No" value="{{$selected->vassel_name ?? 'Vassel Name' }}">
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Booking No</label>
            <input type="text" class="form-control" placeholder="Booking No" readonly placeholder="PL No" value="{{$selected->booking_no ?? 'Booking No' }}">
        </div>
    </div>    <div class="col-md-6 mb-3">
</div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Invoice Note</label>
           <textarea name="invoice_note" readonly class="form-control" rows="3">{{$rowSelected->notes}}</textarea>
        </div>
    </div>
</div>



</div>
							
							<!--
                              table of expenses
						  -->
						  <div class="ms-auth-container row">
			<div class="col-md-12 mb-3">
				<div class="tabbable-panel">
					<div class="tabbable-line">
						<ul class="nav nav-tabs " role="tablist">
							
							<li class="btn btn-light test">
								<a href="#tab_default_2" class="active" data-toggle="tab" role="tab">
								Invoice Points
								</a>

							</li>
							<li class="btn btn-light test">
								<a href="#tab_default_1"  data-toggle="tab" role="tab">
								Statment Points
								</a>

							</li>
						</ul>
						<div class="tab-content test ">
							<div class="tab-pane " id="tab_default_1">
								<!-- Add Expenses -->
								<div class="row">
									<div class="col-md-12">

										<div class="ms-panel">
											<div class="ms-panel-header d-flex justify-content-between">
												<!-- <h6>Expenses Data</h6> -->
											</div>
											<div class="ms-panel-body">

												<div class="table-responsive">
													<table id="courseEval" class="dattable table table-striped thead-dark  w-100">
														<thead>
															<tr>
																<th>#</th>
																<th>Expense Type</th>
															
																<th>Sell</th>
																<th>Expense provider</th>
																<th>Currency</th>
															</tr>
														</thead>
														<tbody>

															@foreach($expensesStatment as $index => $expense)
															<tr>
																<td>{{$index+1}}</td>
																<td>@if($expense->type)
																	{{$expense->type->expense_name}}
																	@endif
																</td>
															
																<td>{{$expense->sell}}</td>
																<td>@if($expense->provider)
																	{{$expense->provider->expenses_name}}
																	@endif</td>
																<td>@if($expense->currency)
																	{{$expense->currency->currency_name}}
																	@endif</td>
															
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
							<div class="tab-pane active" id="tab_default_2">
								<!-- Add Expenses -->
								<div class="row">
									<div class="col-md-12">

										<div class="ms-panel">
											<div class="ms-panel-header d-flex justify-content-between">
												<!-- <h6>Expenses Data</h6> -->
											</div>
											<div class="ms-panel-body">

												<div class="table-responsive">
													<table id="courseEval" class="dattable table table-striped thead-dark  w-100">
														<thead>
															<tr>
																<th>#</th>
																<th>Expense Type</th>
															
																<th>Sell</th>
																<th>Expense provider</th>
																<th>Currency</th>
															</tr>
														</thead>
														<tbody>

															@foreach($expensesInvoice as $index => $expense)
															<tr>
																<td>{{$index+1}}</td>
																<td>@if($expense->type)
																	{{$expense->type->expense_name}}
																	@endif
																</td>
															
																<td>{{$expense->sell}}</td>
																<td>@if($expense->provider)
																	{{$expense->provider->expenses_name}}
																	@endif</td>
																<td>@if($expense->currency)
																	{{$expense->currency->currency_name}}
																	@endif</td>
																
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')



<script type="text/javascript">
   
</script>
@endsection