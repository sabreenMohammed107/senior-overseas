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
                         
                          
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>

                  @foreach($rows as $index => $row)
                            <tr>
                                <td>{{$index+1}}</td>
                         
                                <td>{{$row->invoice_no}}</td>
                          <td>  <?php
                            $date = date_create($row->invoice_date) ?>
                                    {{ date_format($date,'Y-m-d') }}</td>
                         
                              <td>@if($row->operation)
                                    {{$row->operation->shipper->client_name}}
                                    @endif</td>
                             <td>@if($row->operation)
                                    {{$row->operation->operation_code}}
                                    @endif</td>
                            
                          <td>
                        <a href="{{ route('invoice.show',$row->id) }}" class="btn btn-info d-inline-block">view</a>
                              <a href="{{ route('invoice.edit',$row->id) }}" class="btn btn-info d-inline-block">edit</a>
                              <a href="#" onclick="destroy('invoice','{{$row->id}}')" class="btn d-inline-block btn-danger">delete</a>
                                    <form id="delete_{{$row->id}}" action="{{ route('invoice.destroy', $row->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" value=""></button>
                                    </form>
                              <a href="{{ route('customer.printpdf',$row->id) }}" target="_blank" class="btn btn-info d-inline-block">InvoiceReport</a> 
                              <a href="{{ route('customer.printstatment',$row->id) }}" target="_blank" class="btn btn-info d-inline-block">StatmentReport</a>  
 
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
</div>
@endsection