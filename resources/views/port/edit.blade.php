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
    <h6>Port</h6>
    <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
  </div>
  <div class="ms-panel-body">
    <div class="ms-auth-container row no-gutters">
        <div class="col-12 p-3">
        <form action="{{route('port.update',$row->id)}}" method="POST" >

{{ csrf_field() }}

@method('PUT')
      <div class="ms-auth-container row">
                            <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Port Name</label>
                                        <input type="text" class="form-control" value="{{$row->port_name}}" name="port_name" placeholder="Port Name">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Port Type</label>
                                        <select class=" form-control" name="port_type_id" data-live-search="true">
                                            <option value="">  @if($row->type)
                                         {{ $row->type->port_type}}
                                         @endif</option>
                                            @foreach ($types as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->port_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Country</label>
                                        <select class=" form-control" name="country_id" data-live-search="true">
                                        <option value=""> @if($row->country)
                                         {{ $row->country->country_name}}
                                         @endif</option>
                                      @foreach ($countries as $country)
                                            <option value='{{$country->id}}'>
                                                {{ $country->country_name}}</option>
                                            @endforeach
				  				</select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Door Port</label>
                                        <input type="text" class="form-control" value="{{$row->door_port}}" name="door_port" placeholder="Door Port">
                                    </div>
                                </div>
                            </div>
    <div class="input-group d-flex justify-content-end text-center">
    <a href="{{ route('port.index') }}" class="btn btn-dark mx-2"> Cancel</a>
                   
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