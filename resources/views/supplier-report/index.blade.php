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
                <h6>Suppliers/Expenses Report</h6>

            </div>

            <div class="ms-panel-body">
                <!--Extra Data-->
                <div class="col-12 p-3">
                    <form id="target" action="{{route('fetch-supplier-report.fetch')}}" method="get">

                        <input type="hidden" value="{{csrf_token()}}" id="catToken" />
                        <div class="ms-auth-container row no-gutters">
                            <div class="col-md-6 mb-3">
                                <div class="ui-widget form-group">
                                    <label>Selection</label>
                                    <select name="selector_type" data-dependent="xxselector" class=" form-control selector_type" data-show-subtext="true" data-live-search="true" id="selector_type">
                                        <option>Select ...</option>
                                        @foreach ($cashExpenseOut as $data)
                                        <option value='{{$data->id}}'>
                                            {{$data->expenses_name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3"></div>

                            <div class="col-md-6 mb-3">
                                <div class="ui-widget form-group">
                                    <label>Selection</label>
                                    <select id="xxselector" name="xxselector" class=" form-control xxselector" data-show-subtext="true" data-live-search="true">


                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3"></div>
                            <div class="col-md-5 mb-3">
                                <div class="form-group">
                                    <label class="exampleInputPassword1" for="exampleCheck1">From Date</label>
                                    <input type="date" id="from_date" name="from_date" class="form-control" placeholder="From Date">
                                </div>
                            </div>
                            <div class="col-md-2 mb-3"></div>
                            <div class="col-md-5 mb-3">
                                <div class="form-group">
                                    <label class="exampleInputPassword1" for="exampleCheck1">To Date</label>
                                    <input type="date" id="to_date" name="to_date" class="form-control" placeholder="To Date">
                                </div>
                            </div>
                        </div>
                        <div class="input-group d-flex justify-content-end text-center">
                            <a href="{{ route('supplier-report.index') }}" class="btn btn-dark mx-2"> Cancel</a>

                            <input type="submit" id="search_button" value="Search" class="btn btn-success ">

                            <button type="submit" formtarget="_blank" class="btn btn-info d-inline-block">Show Report</button>

                        </div>
                    </form>

                </div>
                <div id="report">

                    @include('supplier-report.report')
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
            var token = $("#catToken").val();
          
                $.ajax({
                    type: 'POST',
                    url: "{{route('supplier-report.store')}}",
                    data: {
                        _token: token,
                        selector_type: $('#selector_type').val(),
                        xxselector: $('#xxselector').val(),
                        from_date: $('#from_date').val(),
                        to_date: $('#to_date').val(),

                    },
                    success: function(result) {

                        $('#report').html(result);
                    },
                });
            
        });


        /*--selector_type--*/
        $('.selector_type').change(function() {

            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();



                $.ajax({
                    url: "{{route('supplier_selector_report.fetch')}}",
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