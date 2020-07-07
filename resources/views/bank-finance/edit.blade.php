@extends('layout.main')

@section('crumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href=""><i class="material-icons"></i> {{ __(' Home') }} </a></li>
        <li class="breadcrumb-item active" aria-current="page">Add-Data_box</li>

    </ol>
</nav>

@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header d-flex justify-content-between">
                <h6>Data</h6>
                <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
            </div>
            <div class="ms-panel-body">
                <form action="{{route('bank-finance.update',$editrow->id)}}" method="POST">

                    {{ csrf_field() }}

                    @method('PUT')
                    <div class="row">


                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="exampleInputPassword1" for="exampleCheck1">Bank Name</label>
                                <input type="text" value="{{$Selectrow->name}}" class="form-control" placeholder="Cash Name" disabled>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="exampleInputPassword1" for="exampleCheck1">Current Balance</label>
                                <input type="text" class="form-control" value="{{$currentBalance}}" placeholder="Current Balance" disabled>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="exampleInputPassword1" for="exampleCheck1">Currency</label>
                                <input type="text" class="form-control" value="{{ $Selectrow->currency->currency_name ?? '' }}" placeholder="Currency" disabled>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="exampleInputPassword1" for="exampleCheck1">Entry Date</label>
                                <?php
                                $date = date_create($editrow->entry_date);
                                ?>
                                <input name="entry_date" value="{{ date_format($date,'Y-m-d') }}" type="date" class="form-control" placeholder="date">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="bank_account_id" value="{{$Selectrow->id}}">
                    <input type="hidden" name="currency_id" value="{{$Selectrow->currency_id}}">
                    <div style="margin-bottom:25px">
                        <div style="border-bottom:solid 2px #0094ff;width:160px">
                            @if($editrow->credit)
                            <style>
                                .hide {
                                    display: none;
                                }
                            </style>
                            <input type="radio" name="tab" value="igotnone" onclick="show1();" checked /> Out
                            <input type="radio" name="tab" value="igottwo" onclick="show2();" disabled /> In
                            @else
                            <style>
                                .hide2 {
                                    display: none;
                                }
                            </style>
                            <input type="radio" name="tab" value="igotnone" onclick="show1();" disabled /> Out
                            <input type="radio" name="tab" value="igottwo" onclick="show2();" checked /> In
                            @endif
                        </div>


                    </div>
                    <div class="ms-auth-container row no-gutters">
                        <div class="col-12 p-3">
                            <div id="div2" class="hide2">
                                <div class="ms-auth-container row">
                                    <div class="col-md-6 mb-3">
                                        <div class="ui-widget form-group">
                                            <label>Selection</label>
                                            <select name="selector_type" disabled data-dependent="xxselector" class=" form-control selector_type" data-show-subtext="true" data-live-search="true" id="selector_type">

                                                <option value="{{$Selectrow->trans_type_id}}">@if($cashExpenseOut){{$cashExpenseOut->expenses_name}}@endif </option>



                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3"></div>

                                    <div class="col-md-6 mb-3">
                                        <div class="ui-widget form-group">
                                            <label>Selection</label>
                                            <select id="xxselector" name="xxselector" disabled class=" form-control xxselector" data-show-subtext="true" data-live-search="true">

                                                <option value="{{  $editrow->ocean_carrier_id}}" {{  $editrow->ocean_carrier_id !=null ? 'selected' : '' }}> {{$editrow->carrierocean->carrier_name ?? '' }}</option>
                                                <option value="{{$editrow->air_carrier_id}}" {{$editrow->air_carrier_id !=null ? 'selected' : '' }}>{{$editrow->carrierair->carrier_name ?? '' }} </option>
                                                <option value="{{$editrow->clearance_id}}" {{$editrow->clearance_id !=null? 'selected' : '' }}>{{$editrow->supplierclearance->supplier_name ?? '' }} </option>
                                                <option value="{{ $editrow->trucking_id}}" {{ $editrow->trucking_id !=null? 'selected' : '' }}>{{$editrow->suppliertracking->supplier_name ?? '' }} </option>
                                                <option value="{{ $editrow->agent_id}}" {{ $editrow->agent_id !=null? 'selected' : '' }}>{{$editrow->agent->agent_name ?? '' }} </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">Current Amount
                                                Money</label>
                                            <input id="selection_current_amount" value="{{$dataOther}}" readonly type="number" class="form-control" placeholder="Amount">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1"> Currency</label>
                                            <input id="selection_currancy" value="{{$editrow->currency->currency_name ?? ''}}" readonly type="text" class="form-control" placeholder="Amount">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">Amount
                                                Money</label>
                                            <input type="number" name="credit" value="{{$editrow->credit}}" class="form-control" placeholder="Amount">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">Currency</label>
                                            <input type="text" class="form-control" placeholder="LE">
                                        </div>
                                    </div> -->
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
                                            <textarea name="notes" id="newClint" class="form-control" placeholder="Notes" rows="3">{{$editrow->notes}}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="div1" class="hide">
                                <div class="ms-auth-container row">
                                    <div class="col-md-6 mb-3">
                                        <div class="ui-widget form-group">
                                            <label>Client</label>
                                            <select class=" form-control" disabled data-live-search="true">
                                                <option value="">Client</option>
                                                <option value="{{$Selectrow->trans_type_id}}">@if($cashExpenseIn){{$cashExpenseIn->expenses_name}}@endif </option>

                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" id="cash" name="cash" value="{{$Selectrow->currency_id}}">
                                    <div class="col-md-6 mb-3"></div>
                                    <div class="col-md-6 mb-3">
                                        <div class="ui-widget form-group">
                                            <label>Selection</label>
                                            <select name="client_id" disabled class=" form-control clientSelect" data-show-subtext="true" data-live-search="true" id="clientSelect">
                                                <option value=" ">Select ...</option>
                                                @foreach ($clients as $type)
                                                <option value='{{$type->id}}' {{ $type->id == $editrow->client_id ? 'selected' : '' }}>
                                                    {{ $type->client_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">Current Amount
                                                Money</label>
                                            <input id="client_current_amount" value="{{$dataClient}}" readonly type="number" class="form-control" placeholder="Amount">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">Client Currency</label>
                                            <input id="client_currancy" value="{{$editrow->currency->currency_name ?? ''}}" readonly type="text" class="form-control" placeholder="Amount">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">Amount
                                                Money</label>
                                            <input type="number" name="depit" value="{{$editrow->depit}}" class="form-control" placeholder="Amount">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">Currency</label>
                                        <input type="text" class="form-control" placeholder="LE">
                                    </div>
                                </div> -->
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="exampleInputPassword1" for="exampleCheck1">Notes</label>
                                            <textarea name="notes" id="newClint" class="form-control" placeholder="Notes" rows="3">{{$editrow->notes}}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="input-group d-flex justify-content-end text-center">
                                <a href="{{ route('bank-finance.show',$Selectrow->id) }}" class="btn btn-dark mx-2"> Cancel</a>
                                <!-- <input type="button" value="Cancel" class="btn btn-dark mx-2" data-dismiss="modal" aria-label="Close"> -->
                                <input type="submit" value="Add" class="btn btn-success ">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('scripts')
<!--radio button-->
<script>
    function show1() {
        document.getElementById('div1').style.display = 'none';
        document.getElementById('div2').style.display = 'block';
    }

    function show2() {
        document.getElementById('div2').style.display = 'none';
        document.getElementById('div1').style.display = 'block';
    }
    /*--radio button--*/
    $(document).ready(function() {
        /*--clientSelect--*/
        $('.clientSelect').change(function() {

            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();



                $.ajax({
                    url: "{{route('bankClientSelect.fetch')}}",
                    method: "get",
                    data: {
                        select: select,
                        value: value,
                        cash: $('#cash').val(),
                    },
                    success: function(result) {
                        // alert(result[0]);
                        $('#client_current_amount').val(result[0]);
                        $('#client_currancy').val(result[1]);

                    },
                    error: function() {
                        $('#client_current_amount').val(0);
                    }

                })
            }
        });
        /*--End clientSelect--*/
        /*--selector_type--*/
        $('.selector_type').change(function() {

            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();



                $.ajax({
                    url: "{{route('bank_selector_type.fetch')}}",
                    method: "get",
                    data: {
                        select: select,
                        value: value,
                        cash: $('#cash').val(),
                    },
                    success: function(result) {
                        $('#xxselector').html(result);

                    },
                    error: function() {}

                })
            }
        });
        /*--selector_type--*/
        /*--xxselector--*/
        $('.xxselector').change(function() {

            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();



                $.ajax({
                    url: "{{route('bank_selectionSelect.fetch')}}",
                    method: "get",
                    data: {
                        select: select,
                        value: value,
                        cash: $('#cash').val(),
                        fristSelect: $('#selector_type').val(),
                    },
                    success: function(result) {
                        alert(">>" + result[0]);
                        $('#selection_current_amount').val(result[0]);
                        $('#selection_currancy').val(result[1]);

                    },
                    error: function() {
                        alert(">>error" + result[0]);
                        $('#selection_current_amount').val(0);
                    }

                })
            }
        });
        /*--End clientSelect--*/
    });
</script>


@endsection