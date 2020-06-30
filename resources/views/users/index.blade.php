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
               
              </div>
              <div class="ms-panel-body">
                <div class="table-responsive">
                  <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
          <thead>
            <th>#</th>
             <th>Name</th>
            <th>Email</th>
            <th>Action</th>
          </thead>
          <tbody>
              @foreach($users as $index => $user)
            <tr>
            <td>{{$index+1}}</td>
              <td>{{$user->name}}</td>
              
              <td>{{$user->email}}</td>
            
             <td>
                <a href="{{ route('usersList.edit', $user->id) }}" class="btn btn-info d-inline-block" 
                >Rest Pass</a>
              <a href="#" onclick="destroy('this User','{{$user->id}}')" class="btn d-inline-block btn-danger">delete</a>
              <form id="delete_{{$user->id}}" action="{{ route('usersList.destroy', $user->id) }}"  method="POST" style="display: none;">
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




@endsection
@section('scripts')

@endsection