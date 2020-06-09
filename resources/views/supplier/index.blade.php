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
                  <h6>Supplier</h6>
                  <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#addSubCat"> add new </a>
                </div>
			  	<div class="ms-panel-body">
			  		<div class="table-responsive">
			  			<table id="courseEval" class="dattable table table-striped thead-dark  w-100">
			  				<thead>
			  					<tr>
			  						<th>#</th>
			  						<th>Supplier Name</th>
			  						<th>Contact Person</th>
			  						<th>Mobile</th>
			  						<th>Phone</th>
			  						<th>Address </th>
                    <th>Email</th>
                    <th>Type</th>
			  						<th>Country</th>
			  						<th>Documents</th>
			  						<th>Action</th>
			  					</tr>
			  				</thead>
			  				<tbody>

                              @foreach($rows as $index => $row)
                            <tr>
                                <td>{{$index+1}}</td>
			  						<td>{{$row->supplier_name}}</td>
			  						<td>{{$row->contact_person}}</td>
			  						<td>{{$row->mobile}}</td>
			  						<td>{{$row->phone}} </td>
			  						<td>{{$row->address}} </td>
                    <td>{{$row->email}}</td>
                    <td>
                                          @if($row->type)
                                          {{$row->type->supplier_type}} 
                                          @endif
                                        </td>
			  						<td>
                                          @if($row->country)
                                          {{$row->country->country_name}} 
                                          @endif
                                        </td>
			  						<td><a href="{{ asset('uploads/')}}/{{ $row->supplier_document }}"  target="_blank">{{$row->supplier_document}}</a> </td>
			  						<td>
			  						<a href="{{ route('supplier.edit',$row->id) }}" class="btn btn-info d-inline-block">edit</a>
                                    <a href="#" onclick="destroy('this Supplier','{{$row->id}}')" class="btn d-inline-block btn-danger">delete</a>
                                    <form id="delete_{{$row->id}}" action="{{ route('supplier.destroy', $row->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" value=""></button>
                                    </form>
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
        <!-- /.row -->


</div>
@endsection


@section('modal')

 <!-- Add new Modal -->
 <div class="modal fade" id="addSubCat" tabindex="-1" role="dialog" aria-labelledby="addSubCat">
        <div class="modal-dialog modal-lg " role="document">
          <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">X
             
            </button>
            <h3>Add Supplier</h3>
            <div class="modal-body">
    
             
              <div class="ms-auth-container row no-gutters">
                <div class="col-12 p-3">
                <form action="{{route('supplier.store')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
				  	<div class="ms-auth-container row">
				  		<div class="col-md-6 mb-3">
				  			<div class="form-group">
				  				<label class="exampleInputPassword1" for="exampleCheck1">*Supplier Name</label>
				  				<input type="text" class="form-control" name="supplier_name" placeholder="Client Name">
				  			</div>
				  		</div>
				  		<div class="col-md-6 mb-3">
				  			<div class="form-group">
				  				<label class="exampleInputPassword1" for="exampleCheck1">*Contact Person</label>
				  				<input type="text" class="form-control" name="contact_person" placeholder="Contact Person">
				  			</div>
				  		</div>
				  		<div class="col-md-6 mb-3">
				  			<div class="form-group">
				  				<label class="exampleInputPassword1" for="exampleCheck1">Email</label>
				  				<input type="email" class="form-control" name="email" placeholder="Email">
				  			</div>
				  		</div>
				  	
				  		<div class="col-md-6 mb-3">
				  			<div class="form-group">
				  				<label class="exampleInputPassword1" for="exampleCheck1">*Mobile</label>
				  				<input type="tel" class="form-control" name="mobile" placeholder="Mobile">
				  			</div>
              </div>
              <div class="col-md-6 mb-3">
				  			<div class="ui-widget form-group">
				  				<label>Supplier Type</label>
				  				<select name="supplier_type_id" class="form-control" data-live-search="true">
				  					<option value="">Select ...</option>
                                      @foreach ($types as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->supplier_type}}</option>
                                            @endforeach
				  				</select>
				  			</div>
				  		</div>
				  	
				  		<div class="col-md-6 mb-3">
				  			<div class="ui-widget form-group">
				  				<label>Country</label>
				  				<select name="country_id" class="form-control" data-live-search="true">
				  					<option value="">Select ...</option>
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
				  				<input type="tel" class="form-control" name="phone" placeholder="Phone">
				  			</div>
				  		</div>
				  		<div class="col-md-12 mb-3">
				  			<div class="form-group">
				  				<label class="exampleInputPassword1" for="exampleCheck1">Address</label>
				  				<textarea id="newClint" name="address" class="form-control"
									placeholder="Address"></textarea>
				  			</div>
              </div>
              <div class="col-md-6 mb-3">
				  			<label> Supplier Document</label>
				  			<div class="fileUpload">
				  				<div class="upload-icon">
				  					<img src="https://image.flaticon.com/icons/svg/136/136549.svg" class="icon">
				  					<input type="file" class="upload up" name="supplier_document" id="up" onchange="readURLFile(this);" />
				  					<span class="upl" id="upload">Upload document</span>
				  				</div>
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