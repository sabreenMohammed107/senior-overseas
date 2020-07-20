@extends('layout.main')

@section('crumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href=""><i class="material-icons"></i> {{ __(' Home') }} </a></li>
        <li class="breadcrumb-item active" aria-current="page">Transaction Data</li>

    </ol>
</nav>

@endsection

@section('content')

<div class="row">

    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header d-flex justify-content-between">
                <h6>Transaction Data</h6>
                <a href="{{ route('add-bank-finance',$Selectrow->id) }}" class="btn btn-dark"> add new </a>
            </div>

            <div class="ms-panel-body">
                <!--Extra Data-->
                <div class="ms-auth-container row no-gutters">

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="exampleInputPassword1" for="exampleCheck1">Bank Name</label>
                            <input type="text" name="name" value="{{$Selectrow->name}}" class="form-control" placeholder="Name" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3"></div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="exampleInputPassword1" for="exampleCheck1">Current Balance</label>
                            <input type="text" class="form-control" value="{{$currentBalance}}" placeholder="Current Balance" readonly>
                        </div>
                    </div>
                </div>
                <!--Extra Data-->
                <div class="table-responsive">
                    <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Transaction Data</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($rows as $index => $row)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->depit}}</td>
                                <td>{{$row->credit}}</td>
                                <td> <?php $date = date_create($row->entry_date) ?>
                                    {{ date_format($date,'Y-m-d') }}</td>

                                <td>
                                    <a href="{{ route('bank-finance.edit',$row->id) }}" class="btn btn-info d-inline-block">edit</a>
                                    <a href="#" onclick="destroy('this bank-finance','{{$row->id}}')" class="btn d-inline-block btn-danger">delete</a>
                                    <form id="delete_{{$row->id}}" action="{{ route('bank-finance.destroy', $row->id) }}" method="POST" style="display: none;">
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
</div>


@endsection