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
                <h6>Account Statment</h6>
                <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
            </div>
            <div class="ms-panel-body">
                <div class="ms-auth-container row no-gutters">
                    <div class="col-12 p-3">
                        <form id="target" action="javascript:void(0)" method="post">

                            <input type="hidden" value="{{csrf_token()}}" id="catToken" />

                            <div class="ms-auth-container row">



                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Selection</label>
                                        <select name="selector_type" data-dependent="xxselector" class=" form-control selector_type" data-show-subtext="true" data-live-search="true" id="selector_type">
                                            <option>Select ...</option>
                                            @foreach ($Finantypes as $type)
                                            <option value='{{$type->id}}'>
                                                {{$type->expenses_name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Selection</label>
                                        <select id="xxselector" name="xxselector" class=" form-control xxselector" data-show-subtext="true" data-live-search="true">


                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">From Date</label>
                                        <input name="from_date" id="from_date" type="date" class="form-control" placeholder="date">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">To Date</label>
                                        <input name="to_date" id="to_date" type="date" class="form-control" placeholder="date">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Currency</label>
                                        <select name="currency_id" id="currency_id" required class=" form-control" >
                                            <option value="">Select ...</option>
                                            @foreach ($currencies as $type)
                                            <option value='{{$type->id}}'>
                                                {{$type->currency_name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    
                                <span id="currencyrror" style="color:red;background:#ccc;text-align:center;margin-top:40px;display:none">You Must Select Currency And Selection </span>
                                </div>
                            </div>
                            <input type="submit" id="search_button" value="Search" class="btn btn-success ">
                        </form>

                        <div class="ms-panel-header d-flex justify-content-between"></div>

                        <br>

                        <div id="main">

                            @include('account-statment.search')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')



<script type="text/javascript">
  
    $(document).ready(function() {
        $('#search_button').click(function() {
            event.preventDefault();
            var OR = document.getElementById("currency_id").value;
            var SEL = document.getElementById("selector_type").value;

            if (OR == '' || SEL == '') {
                $('#currencyrror').css('display', 'block');
            } else {
                $('#currencyrror').css('display', 'none');
                $("#target").submit();
                var token = $("#catToken").val();
                var selector_type=$('#selector_type').val();
                var xxselector=$('#xxselector').val();
                var currency_id=$('#currency_id').val();
                var to=$('#to_date').val();
                var from=$('#from_date').val();
                $.ajax({
                    type: 'POST',
                    url: "{{route('account-statment.store')}}",
                    data: {
                        _token: token,
                        selector_type: selector_type,
                        xxselector: xxselector,
                        currency_id: currency_id,
                        to: to,
                        from: from,
                    },
                    success: function(result) {

                        $('#main').html(result);
                        //datatable
                        $('#ticketTable').DataTable({
                            "destroy": true,
                            paging: false,
                            "footerCallback": function(row, data, start, end, display) {
                                var api = this.api(),
                                    data;

                                // Remove the formatting to get integer data for summation
                                var intVal = function(i) {
                                    return typeof i === 'string' ?
                                        i.replace(/[\$,]/g, '') * 1 :
                                        typeof i === 'number' ?
                                        i : 0;
                                };

                                // Total over all pages
                                total = api
                                    .column(3)
                                    .data()
                                    .reduce(function(a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);

                                // Total over this page
                                pageTotal = api
                                    .column(2)
                                    .data()
                                    .reduce(function(a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);
                                // Update footer
                                $(api.column(0).footer()).html('Sum = ');
                                $(api.column(2).footer()).html(pageTotal);
                                $(api.column(3).footer()).html(total);
                                // Update footer

                            }
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert('error');

                    }
                });
            }

        });
        /*--selector_type--*/
        $('.selector_type').change(function() {

            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();



                $.ajax({
                    url: "{{route('selector_statment.fetch')}}",
                    method: "get",
                    data: {
                        select: select,
                        value: value,
                    },
                    success: function(result) {
                        $('#xxselector').html(result);

                    },
                    error: function() {}

                })
            }
        });
        /*--selector_type--*/




    });
</script>
@endsection