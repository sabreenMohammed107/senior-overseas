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
    <h6>Expenses</h6>
    <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
  </div>
  <div class="ms-panel-body">
    <div class="ms-auth-container row no-gutters">
        <div class="col-12 p-3">
        <form action="{{route('expenses.update',$row->id)}}" method="POST" >

{{ csrf_field() }}

@method('PUT')
<div class="ms-auth-container row">
								
								<div class="col-md-12 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Expenses Name</label>
										<input type="text" class="form-control" value="{{$row->expense_name}}" name="expense_name" placeholder="Expenses Name">
									</div>
								</div>
								<div class="col-md-12 mb-3">
									<div class="form-group">
										<label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
										<textarea id="newClint" class="form-control" name="expense_note" placeholder="Notes"rows="5">{{$row->expense_note}}</textarea>
									</div>
								</div>
							</div>
          <div class="input-group d-flex justify-content-end text-center">
          <a href="{{ route('expenses.index') }}" class="btn btn-dark mx-2"> Cancel</a>
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