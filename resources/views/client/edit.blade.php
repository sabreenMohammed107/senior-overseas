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
    <h6>Client</h6>
    <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
  </div>
  <div class="ms-panel-body">
    <div class="ms-auth-container row no-gutters">
      <div class="col-12 p-3">
      <form action="{{route('client.update',$row->id)}}" method="POST" enctype="multipart/form-data">

{{ csrf_field() }}

@method('PUT')
        <div class="ms-auth-container row">
				  		<div class="col-md-6 mb-3">
				  			<div class="form-group">
				  				<label class="exampleInputPassword1" for="exampleCheck1">*Client Name</label>
				  				<input type="text" class="form-control" value="{{$row->client_name}}" name="client_name" placeholder="Client Name">
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
				  		<div class="col-md-12 mb-3">
				  			<div class="form-group">
				  				<label class="exampleInputPassword1" for="exampleCheck1">Address</label>
				  				<textarea id="newClint" name="address" class="form-control"
									placeholder="Address">{{$row->address}}</textarea>
				  			</div>
              </div>
              <div class="col-md-6 mb-3">
				  			<label> Client Document</label>
				  			<div class="fileUpload">
				  				<div class="upload-icon">
				  					<img src="https://image.flaticon.com/icons/svg/136/136549.svg" class="icon">
				  					<input type="file" class="upload up" name="client_document" id="up" onchange="readURLFile(this);" />
				  					<span class="upl" id="upload">{{$row->client_document}}</span>
				  				</div>
				  			</div>
				  		</div>
				  	</div>
                    <div class="input-group d-flex justify-content-end text-center">
                    <a href="{{ route('client.index') }}" class="btn btn-dark mx-2"> Cancel</a>
                   
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


</div>
@endsection