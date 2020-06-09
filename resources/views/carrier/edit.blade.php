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
        <form action="{{route('carrier.update',$row->id)}}" method="POST" >

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
				  				<textarea id="newClint" name="address" class="form-control"
									placeholder="Address">{{$row->address}}</textarea>
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
        <!-- /.row -->


</div>
@endsection