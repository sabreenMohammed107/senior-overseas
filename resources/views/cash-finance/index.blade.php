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
                <h6>Cash Box Transaction</h6>
                <!-- <a href="select_transation.html" class="btn btn-dark" > add new </a> -->
            </div>
            <div class="ms-panel-body">
                <div class="table-responsive">
                    <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cash Box Name</th>

                                <th>open Balance</th>
                                <th>Currency</th>
                                <th>Current Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($rows as $index => $row)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->open_balance}}
                                </td>
                                <td>@if($row->currency)
                                    {{$row->currency->currency_name}}
                                    @endif
                                </td>
                                <?php

                                $currentBalance = App\Models\Financial_entry::where('cash_box_id', $row->id)->sum('depit') - App\Models\Financial_entry::where('cash_box_id', $row->id)->sum('credit');

                                ?>
                                <td>{{$currentBalance}}</td>
                                <td>
                                    <a href="{{ route('cash-finance.show',$row->id) }}" class="btn btn-info d-inline-block">Select</a>

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