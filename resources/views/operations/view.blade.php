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
  						<h6>Operations</h6>
  						<!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
  					</div>
  					<div class="ms-panel-body">
  						<div class="ms-auth-container row no-gutters">
						  	<div class="col-12 p-3">
						  		<form action="">
						  			<div style="border-bottom:solid #0094ff 2px;"><h2>Read From Exiting Quote</h2></div><br />
						  			<div class="ms-auth-container row">
						  	<div class="col-md-6 mb-3">
						  		<div class="form-group">
						  			<label class="exampleInputPassword1" for="exampleCheck1">Operation Code</label>
						  			<input type="text" class="form-control" placeholder="Operation Code" disabled>
						  		</div>
						  	</div>
						  	<div class="col-md-6 mb-3">
						  		<div class="form-group">
						  			<label class="exampleInputPassword1" for="exampleCheck1">Operation Date</label>
						  			<input type="text" class="form-control" placeholder="Operation Date" disabled>
						  		</div>
						  	</div>
						  				<div class="col-md-6 mb-3">
						  					<div class="ui-widget form-group">
						  						<label>Quote Code</label>
						  						<select class=" form-control" data-live-search="true"disabled>
						  							<option>Select ...</option>
						  							<option>Quote Code 1</option>
						  							<option>Quote Code 2</option>
						  							<option>Quote Code 3</option>
						  						</select>
						  					</div>
						  				</div>
						  				<div class="col-md-6 mb-3">
						  					<div class="form-group">
						  						<label class="exampleInputPassword1" for="exampleCheck1">Client ( Shipper )</label>
						  						<input type="text" class="form-control" placeholder="Client ( Shipper )" disabled>
						  					</div>
						  				</div>
						  				<div class="col-md-6 mb-3">
						  					<div class="ms-panel ms-panel-fh">
						  						<div class="ms-panel-body">
						  							<div class="accordion has-gap ms-accordion-chevron" id="accordionExample2">
						  								<div class="card">
						  									<div class="card-header" data-toggle="collapse" role="button" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
						  										<span> Quote Data</span>
						  									</div>
						  									<div id="collapseSix" class="collapse" data-parent="#accordionExample2">
						  										<div class="card-body">
						  											Lorem Ipsum has been the industry standard dummy text
						  											Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.
						  											Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.
						  										</div>
						  									</div>
						  								</div>
						  							</div>
						  						</div>
						  					</div>
						  				</div>
						  			</div>
						  		</form>
				  	<form action="">
				  		<div style="border-bottom:solid #0094ff 2px;"><h2>Operations Data</h2></div><br />
				  		<div class="ms-auth-container row">
						  <div class="col-md-6 mb-3">
				  				<div class="ui-widget form-group">
				  					<label>Consignee</label>
				  					<select class="form-control" data-live-search="true" disabled>
				  						<option>Select ...</option>
				  						<option>Client 1</option>
				  						<option>Client 2</option>
				  						<option>Client 3</option>
				  					</select>
				  				</div>
							  </div>
							  <div class="col-md-6 mb-3">
				  				<div class="ui-widget form-group">
				  					<label>Notify</label>
				  					<select class="form-control" data-live-search="true" disabled>
				  						<option>Select ...</option>
				  						<option>Client 1</option>
				  						<option>Client 2</option>
				  						<option>Client 3</option>
				  					</select>
				  				</div>
				  			</div>
				  			<div class="col-md-6 mb-3">
				  				<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">Containers Counts</label>
				  					<input type="text" class="form-control" placeholder="Containers Counts"disabled>
				  				</div>
				  			</div>
				  			<div class="col-md-6 mb-3">
				  				<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">Container/s Names</label>
				  					<textarea id="newClint" class="form-control"
										placeholder="Container/s Names" rows="3"disabled></textarea>
				  				</div>
				  			</div>
				  			<div class="col-md-6 mb-3">
				  				<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
				  					<textarea id="newClint" class="form-control"
										placeholder="Notes" rows="3"disabled></textarea>
				  				</div>
				  			</div>
				  			<div class="col-md-6 mb-3">
				  				<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">Loading Date</label>
				  					<input type="date" class="form-control" placeholder="Loading Date"disabled>
				  				</div>
				  			</div>
				  		</div>
				  	</form>
				  	<form action="">
				  		<div style="border-bottom:solid #0094ff 2px;"><h2>Policy Data</h2></div><br />
				  		<div class="ms-auth-container row">
						  
				  			<div class="col-md-6 mb-3">
				  				<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">PL No</label>
				  					<input type="text" class="form-control" placeholder="PL No"disabled>
				  				</div>
				  			</div>
				  			<div class="col-md-6 mb-3">
				  				<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">Vassel Name</label>
				  					<input type="text" class="form-control" placeholder="Vassel Name"disabled>
				  				</div>
				  			</div>
				  	<div class="col-md-6 mb-3">
				  		<div class="form-group">
				  			<label class="exampleInputPassword1" for="exampleCheck1">Booking No</label>
				  			<input type="text" class="form-control" placeholder="Booking No"disabled>
				  		</div>
					  </div>
					  <div class="col-md-6 mb-3">
				  				<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">Commodity</label>
				  					<select class="form-control" disabled  data-live-search="true">
				  						<option>Select ...</option>
				  						<option>commodity 1</option>
				  						<option>commodity 2</option>
				  						<option>commodity 3</option>
				  					</select>
				  				</div>
							  </div>
							  <div class="col-md-6 mb-3">
				  				<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">cut-off date</label>
				  					<input type="date" class="form-control" placeholder="cut-off date"disabled>
				  				</div>
				  			</div>
				  		</div>
				  	</form>
						  		<div class="input-group d-flex justify-content-end text-center">
						  			<a href="{{ route('operations.index') }}" class="btn btn-dark mx-2"> Cancel</a>
						  			<!-- <input type="button" value="Cancel" class="btn btn-dark mx-2" data-dismiss="modal" aria-label="Close"> -->
						  			<input type="submit" value="Add" class="btn btn-success ">
						  		</div>
                  <form action="">
                 
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
                              <!-- <a href="#" class="btn btn-dark"> add new </a> -->
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
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
      
                                    <tr>
                                      <td>#</td>
                                      <td>Expense Type</td>
                                      <td>Buy</td>
                                      <td>Sale</td>
                                      <td>
                                        
                                        <!-- <a href="#" class="btn btn-info d-inline-block">edit</a> -->
                                        <!-- <a href="#" onclick="delette('ٌRound')" class="btn d-inline-block btn-danger">delete</a> -->
                                      </td>
                                    </tr>
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
                  </form>
						  	</div>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
        <!-- /.row -->


</div>
@endsection