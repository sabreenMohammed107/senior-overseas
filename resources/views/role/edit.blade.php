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
        <h6>Role</h6>
        <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
      </div>
      <div class="ms-panel-body">
        <div class="ms-auth-container row no-gutters">
          <div class="col-12 p-3">
            <form action="{{route('role.update',$row->id)}}" method="POST">

              {{ csrf_field() }}

              @method('PUT')
              <div class="ms-auth-container row">
                <div class="col-md-6 mb-3">
                  <div class="form-group">
                    <label class="exampleInputPassword1" for="exampleCheck1">role Name</label>
                    <input type="text" class="form-control" name="name" value="{{$row->name}}" placeholder="role Name">
                  </div>
                </div>
              </div>
              <div class="input-group d-flex justify-content-end text-center">
                <a href="{{ route('role.index') }}" class="btn btn-dark mx-2"> Cancel</a>
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