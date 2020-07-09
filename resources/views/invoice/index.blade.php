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
      <div>
          <a href="{{ route('invoice.create') }}" class="btn btn-dark" > add new </a>
      </div>
    </div>
      <div class="ms-panel-body">
          <div class="table-responsive">
              <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Invoice Code</th>
                          <th>Invoice Date</th>
                              <th>Client</th>
                             <th>Operation Code</th>
                             <th>Pol</th>
                             <th>Pod</th>
                          
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>

                      <tr>
                          <td>#</td>
                          <th>100</th>
                          <th>20-7-2020</th>
                              <th>Client</th>
                             <th>102</th>
                             <th>Pol</th>
                             <th>Pod</th>
                          <td>
                        <a href="{{ route('invoice.show',1) }}" class="btn btn-info d-inline-block">view</a>
                              <a href="{{ route('invoice.edit',1) }}" class="btn btn-info d-inline-block">edit</a>
                              <a href="#" onclick="delette('ٌRound')" class="btn d-inline-block btn-danger">delete</a>
                              <a href="#" class="btn btn-info d-inline-block">Report</a>  
                        </td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>

</div>
</div>
@endsection