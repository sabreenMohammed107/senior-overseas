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
																<th>Buy</th>
																<th>Sale</th>
																<th>Expense provider</th>
																<th>Currency</th>
																<th>Action</th>
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
																<td>{{$expense->buy}}</td>
																<td>{{$expense->sell}}</td>
																<td>@if($expense->provider)
																	{{$expense->provider->provider_type}}
																	@endif</td>
																<td>@if($expense->currency)
																	{{$expense->currency->currency_name}}
																	@endif</td>
																<td>
                                                                <input type="hidden" name="invoiceid" id="invoiceid" value="{{$expense->id}}" >

                                                                    <button onclick="sendInvoice()" class="btn btn-info d-inline-block" >Send To Invoice</button>
	
																
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
							<div class="tab-pane active" id="tab_default_2">
								<!-- Add Expenses -->
								<div class="row">
									<div class="col-md-12">

										<div class="ms-panel">
											<div class="ms-panel-header d-flex justify-content-between">
												<!-- <h6>Expenses Data</h6> -->
											</div>
											<div class="ms-panel-body">

												<div class="table-responsive" >
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

															@foreach($expensesInvoice as $index => $expense)
															<tr>
																<td>{{$index+1}}</td>
																<td>@if($expense->type)
																	{{$expense->type->expense_name}}
																	@endif
																</td>
																<td>{{$expense->buy}}</td>
																<td>{{$expense->sell}}</td>
																<td>@if($expense->provider)
																	{{$expense->provider->provider_type}}
																	@endif</td>
																<td>@if($expense->currency)
																	{{$expense->currency->currency_name}}
																	@endif</td>
																<td>
																	<input type="hidden" name="statmentid" id="statmentid" value="{{$expense->id}}" >
																	<button onclick="sendStatment()" class="btn btn-info d-inline-block" >Send To Statment</button>
																	
																
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