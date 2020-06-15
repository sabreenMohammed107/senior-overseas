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
						  					<div class="ui-widget form-group">
						  						<label>Quote Code</label>
						  						<select class=" form-control" data-live-search="true">
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
													  					<h6>Ocean Freight</h6>
													  					<!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
													  				</div>
													  				<div class="ms-panel-body">
													  					<form>
													  						<input type="radio" name="tab" value="igotnone" onclick="show1();" checked /> Air
													  						<input type="radio" name="tab" value="igottwo" onclick="show2();" clicked="clicked" /> Ocean
													  					</form>
													  					<div class="ms-auth-container row no-gutters">
													  						<div class="col-12 p-3">
													  							<form action="" id="div2">
													  								<div class="ms-auth-container row">
													  									<div class="col-md-6 mb-3">
													  										<div class="ui-widget form-group">
													  											<label>Air Carrier</label>
													  											<select class=" form-control" data-live-search="true" disabled>
													  												<option>Select ...</option>
													  												<option>Air Carrier 1</option>
													  												<option>Air Carrier 2</option>
													  												<option>Air Carrier 3</option>
													  											</select>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="ui-widget form-group">
													  											<label>Currency</label>
													  											<select class=" form-control" data-live-search="true" disabled>
													  												<option>Select ...</option>
													  												<option>Currency 1</option>
													  												<option>Currency 2</option>
													  												<option>Currency 3</option>
													  											</select>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Price</label>
													  											<input type="text" class="form-control" placeholder="Price" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Validitiy Date</label>
													  											<input type="date" class="form-control" placeholder="Validitiy Date" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Aol</label>
													  											<input type="text" class="form-control" placeholder="Aol" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Aod</label>
													  											<input type="text" class="form-control" placeholder="Aod" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Slide Range</label>
													  											<input type="text" class="form-control" placeholder="Slide Range" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
													  											<textarea id="newClint" class="form-control"
																				  placeholder="Notes" rows="3" disabled></textarea>
													  										</div>
													  									</div>
													  								</div>
													  							</form>
													  							<form action="" id="div1" class="hide">
													  								<div class="ms-auth-container row">
													  									<div class="col-md-6 mb-3">
													  										<div class="ui-widget form-group">
													  											<label>Ocean Freigt Carrier</label>
													  											<select class=" form-control" data-live-search="true" disabled>
													  												<option>Select ...</option>
													  												<option>Ocean Freigt Carrier 1</option>
													  												<option>Ocean Freigt Carrier 2</option>
													  												<option>Ocean Freigt Carrier 3</option>
													  											</select>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="ui-widget form-group">
													  											<label>Currency</label>
													  											<select class=" form-control" data-live-search="true" disabled>
													  												<option>Select ...</option>
													  												<option>Currency 1</option>
													  												<option>Currency 2</option>
													  												<option>Currency 3</option>
													  											</select>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Price</label>
													  											<input type="text" class="form-control" placeholder="Price" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Validitiy Date</label>
													  											<input type="date" class="form-control" placeholder="Validitiy Date" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Pol</label>
													  											<input type="text" class="form-control" placeholder="Pol" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Pod</label>
													  											<input type="text" class="form-control" placeholder="Pod" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Container</label>
													  											<input type="text" class="form-control" placeholder="Container" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Transit Time</label>
													  											<input type="number" class="form-control" placeholder="Transit Time" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
													  											<textarea id="newClint" class="form-control"
																				  placeholder="Notes" rows="3" disabled></textarea>
													  										</div>
													  									</div>
													  								</div>
													  							</form>
													  							<form action="">
													  								<div style="border-bottom:solid #0094ff 2px;margin-bottom:15px"></div>
													  								<div class="ms-auth-container row">
													  									<div class="col-md-6 mb-3">
													  										<div class="ui-widget form-group">
													  											<label>Trucking Rate</label>
													  											<select class=" form-control" data-live-search="true" disabled>
													  												<option>Select ...</option>
													  												<option>Trucking Rate 1</option>
													  												<option>Trucking Rate 2</option>
													  												<option>Trucking Rate 3</option>
													  											</select>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3"></div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Trucking Company</label>
													  											<input type="text" class="form-control" placeholder="Trucking Company" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Validitiy Date</label>
													  											<input type="date" class="form-control" placeholder="Validitiy Date" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Pol</label>
													  											<input type="text" class="form-control" placeholder="Pol" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Pod</label>
													  											<input type="text" class="form-control" placeholder="Pod" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
													  											<textarea id="newClint" class="form-control"
																				  placeholder="Notes" rows="3" disabled></textarea>
													  										</div>
													  									</div><div class="col-md-6 mb-3"></div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">*Faradany Price</label>
													  											<input type="number" class="form-control" placeholder="Faradany Price" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">*Trailer Price</label>
													  											<input type="number" class="form-control" placeholder="Trailer Price" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="ui-widget form-group">
													  											<label>Faradany Currency</label>
													  											<select class=" form-control" data-live-search="true" disabled>
													  												<option>Select ...</option>
													  												<option>Faradany Currency 1</option>
													  												<option>Faradany Currency 2</option>
													  												<option>Faradany Currency 3</option>
													  											</select>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="ui-widget form-group">
													  											<label>Trailer Currency</label>
													  											<select class=" form-control" data-live-search="true" disabled>
													  												<option>Select ...</option>
													  												<option>Trailer Currency 1</option>
													  												<option>Trailer Currency 2</option>
													  												<option>Trailer Currency 3</option>
													  											</select>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">*Grar Price</label>
													  											<input type="number" class="form-control" placeholder="Grar Price" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">*HRF Price</label>
													  											<input type="number" class="form-control" placeholder="HRF Price" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="ui-widget form-group">
													  											<label>Grar Currency</label>
													  											<select class=" form-control" data-live-search="true" disabled>
													  												<option>Select ...</option>
													  												<option>Grar Currency 1</option>
													  												<option>Grar Currency 2</option>
													  												<option>Grar Currency 3</option>
													  											</select>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="ui-widget form-group">
													  											<label>HRF Currency</label>
													  											<select class=" form-control" data-live-search="true" disabled>
													  												<option>Select ...</option>
													  												<option>HRF Currency 1</option>
													  												<option>HRF Currency 2</option>
													  												<option>HRF Currency 3</option>
													  											</select>
													  										</div>
													  									</div>

													  								</div>
													  							</form>
													  							<form>
													  								<div style="border-bottom:solid #0094ff 2px;margin-bottom:15px"></div>
													  								<div class="ms-auth-container row">
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">*Clearance Price</label>
													  											<input type="number" class="form-control" placeholder="Clearance Price" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="ui-widget form-group">
													  											<label>Currency</label>
													  											<select class=" form-control" data-live-search="true" disabled>
													  												<option>Select ...</option>
													  												<option>Currency 1</option>
													  												<option>Currency 2</option>
													  												<option>Currency 3</option>
													  											</select>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Clearance Notes</label>
													  											<textarea id="newClint" class="form-control"
																				  placeholder="Notes" rows="3" disabled></textarea>
													  										</div>
													  									</div>
													  								</div>

													  							</form>
													  							<form>
													  								<div style="border-bottom:solid #0094ff 2px;margin-bottom:15px"></div>
													  								<div class="ms-auth-container row">
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">*Door to Door Price</label>
													  											<input type="number" class="form-control" placeholder="Door to Door Price" disabled>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="ui-widget form-group">
													  											<label>Currency</label>
													  											<select class=" form-control" data-live-search="true" disabled>
													  												<option>Select ...</option>
													  												<option>Currency 1</option>
													  												<option>Currency 2</option>
													  												<option>Currency 3</option>
													  											</select>
													  										</div>
													  									</div>
													  									<div class="col-md-6 mb-3">
													  										<div class="form-group">
													  											<label class="exampleInputPassword1" for="exampleCheck1">Door to Door notes</label>
													  											<textarea id="newClint" class="form-control"
																				  placeholder="Notes" rows="3" disabled></textarea>
													  										</div>
													  									</div>
													  								</div>

													  							</form>
													  							<div class="input-group d-flex justify-content-end text-center">
													  								<a href="_operation.html" class="btn btn-dark mx-2"> Cancel</a>
													  								<!-- <input type="button" value="Cancel" class="btn btn-dark mx-2" data-dismiss="modal" aria-label="Close"> -->
													  								<input type="submit" value="Add" class="btn btn-success ">
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
						  		</form>
				  	<form action="">
				  		<div style="border-bottom:solid #0094ff 2px;"><h2>Operations Data</h2></div><br />
				  		<div class="ms-auth-container row">
				  			<div class="col-md-6 mb-3">
				  				<div class="ui-widget form-group">
				  					<label>Consignee</label>
				  					<select class="form-control" data-live-search="true">
				  						<option>Select ...</option>
				  						<option>Consignee 1</option>
				  						<option>Consignee 2</option>
				  						<option>Consignee 3</option>
				  					</select>
				  				</div>
				  			</div>
				  			<div class="col-md-6 mb-3">
				  				<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">Containers Counts</label>
				  					<input type="text" class="form-control" placeholder="Containers Counts">
				  				</div>
				  			</div>
				  			<div class="col-md-6 mb-3">
				  				<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">Container/s Names</label>
				  					<textarea id="newClint" class="form-control"
										placeholder="Container/s Names" rows="3"></textarea>
				  				</div>
				  			</div>
				  			<div class="col-md-6 mb-3">
				  				<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
				  					<textarea id="newClint" class="form-control"
										placeholder="Notes" rows="3"></textarea>
				  				</div>
				  			</div>
				  			<div class="col-md-6 mb-3">
				  				<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">Loading Date</label>
				  					<input type="date" class="form-control" placeholder="Loading Date">
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
				  					<input type="text" class="form-control" placeholder="PL No">
				  				</div>
				  			</div>
				  			<div class="col-md-6 mb-3">
				  				<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">Vassel Name</label>
				  					<input type="text" class="form-control" placeholder="Vassel Name">
				  				</div>
				  			</div>
				  	<div class="col-md-6 mb-3">
				  		<div class="form-group">
				  			<label class="exampleInputPassword1" for="exampleCheck1">Booking No</label>
				  			<input type="text" class="form-control" placeholder="Booking No">
				  		</div>
				  	</div>
				  		</div>
				  	</form>
						  		<div class="input-group d-flex justify-content-end text-center">
						  			<a href="{{ route('operations.index') }}" class="btn btn-dark mx-2"> Cancel</a>
						  			<!-- <input type="button" value="Cancel" class="btn btn-dark mx-2" data-dismiss="modal" aria-label="Close"> -->
						  			<input type="submit" value="Add" class="btn btn-success ">
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
@endsection