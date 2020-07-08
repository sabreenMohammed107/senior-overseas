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
  						<!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
  					</div>
  					<div class="ms-panel-body">
  						<div class="ms-auth-container row no-gutters">
						  	<div class="col-12 p-3">
						  		<form action="">
                                    <div class="ms-auth-container row">
                                        <div class="col-md-6 mb-3">
                                            <div class="ui-widget form-group">
                                                <label>Operation Code</label>
                                                <select class=" form-control" data-live-search="true">
                                                    <option>Select ...</option>
                                                    <option>100</option>
                                                    <option>101</option>
                                                    <option>102</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
						  			<div class="ms-auth-container row">
						  				
						  				<div class="col-md-6 mb-3">
						  					<div class="form-group">
						  						<label class="exampleInputPassword1" for="exampleCheck1">Client ( Shipper )</label>
						  						<input type="text" class="form-control" placeholder="Client ( Shipper )" disabled>
						  					</div>
                                          </div>
                                          <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="exampleInputPassword1" for="exampleCheck1">Client Address</label>
                                                <input type="text" class="form-control" placeholder="Client Address" disabled>
                                            </div>
                                        </div>
						  				<div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="exampleInputPassword1" for="exampleCheck1">Sale Person</label>
                                                <input type="text" class="form-control"  placeholder="Sale Person" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="exampleInputPassword1" for="exampleCheck1">Operation Date</label>
                                                <input type="date" name="operation_date" class="form-control"  placeholder="Operation Date">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="exampleInputPassword1" for="exampleCheck1">Import Export</label>
                                                <select class="form-control" required name="import_export_flag" data-live-search="true">
                                                    <option>Select ...</option>
                                                    <option value="1">Import</option>
                                                    <option value="2">Export</option>
                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="exampleInputPassword1" for="exampleCheck1">POL</label>
                                                <input type="text" class="form-control"  placeholder="POL" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="exampleInputPassword1" for="exampleCheck1">Pod</label>
                                                <input type="text" class="form-control"  placeholder="Pod" readonly>
                                            </div>
                                        </div>
						  			</div>
				
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
				  					<input type="text" class="form-control"
										placeholder="Container/s Names" >
				  				</div>
				  			</div>
				  			
				  			<div class="col-md-6 mb-3">
				  				<div class="form-group">
				  					<label class="exampleInputPassword1" for="exampleCheck1">Loading Date</label>
				  					<input type="date" class="form-control" placeholder="Loading Date">
				  				</div>
				  			</div>
				  		</div>
				  
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
                          <!--
                              table of expenses
                          -->
                          <div class="ms-panel">
                            <div class="ms-panel-header d-flex justify-content-between">
                                <h6>Expenses Data</h6>
                                <!-- <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#addSubCat"> add new </a> -->
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

                                          
                                            <tr>
                                                <td>#</td>
                                                <td>xxx
                                                </td>
                                                <td>xxxx</td>
                                                <td>xxxx</td>
                                                <td>xxxx</td>
                                                <td>xxxx</td>
                                                <td>

                                                </td>
                                            </tr>
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
				 
						  		<div class="input-group d-flex justify-content-end text-center">
						  			<a href="_operation.html" class="btn btn-dark mx-2"> Cancel</a>
						  			<!-- <input type="button" value="Cancel" class="btn btn-dark mx-2" data-dismiss="modal" aria-label="Close"> -->
						  			<input type="submit" value="Add" class="btn btn-success ">
						  		</div>
                            </form>
						  	</div>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>

@endsection