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
                <h6>Bank Accounts</h6>
                <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
            </div>
            <div class="ms-panel-body">
                <div class="ms-auth-container row no-gutters">
                    <div class="col-12 p-3">
                        <form action="{{route('bank-account.update',$row->id)}}" method="POST">

                            {{ csrf_field() }}

                            @method('PUT')
                            <div class="ms-auth-container row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Account Number</label>
                                        <input type="number" class="form-control" value="{{$row->account_number}}" name="account_number" placeholder="Account Number">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Beneficiary</label>
                                        <input type="text" class="form-control" value="{{$row->beneficiary}}" name="beneficiary" placeholder="Beneficiary">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name"  value="{{$row->bank_name}}" placeholder="Bank Name">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">*Company Name</label>
                                        <input type="text" class="form-control" name="company_name" value="{{$row->company_name}}" placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Currency Type</label>
                                        <select name="currency_id" class=" form-control" data-live-search="true">
                                            <option value="">
                                                @if($row->currency)
                                            {{$row->currency->currency_name}}
                                            @endif
                                            </option>
                                            @foreach ($currancies as $currancy)
                                            <option value='{{$currancy->id}}'>
                                                {{ $currancy->currency_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Address</label>
                                        <textarea id="newClint" class="form-control" name="address" placeholder="Address" rows="3">{{$row->address}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group d-flex justify-content-end text-center">
                            <a href="{{ route('bank-account.index') }}" class="btn btn-dark mx-2"> Cancel</a>
                          
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