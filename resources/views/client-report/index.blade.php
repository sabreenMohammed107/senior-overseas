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
                <h6>Client Report</h6>

            </div>

            <div class="ms-panel-body">
                <!--Extra Data-->
                <div class="col-12 p-3">
                    <form id="target" action="{{route('fetch-client-report.fetch')}}" method="get">

                        <input type="hidden" value="{{csrf_token()}}" id="catToken" />
                        <div class="ms-auth-container row no-gutters">
                            <div class="col-md-5 mb-3">
                                <select class="form-control" data-live-search="true" required name="client_id" id="client_id">
                                    <option value="">Select ...</option>
                                    @foreach ($rows as $type)
                                    <option value='{{$type->id}}'>
                                        {{ $type->client_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3"></div>
                            <div class="col-md-6 mb-3">
                                <span id="clientrror" style="color:red;background:#ccc;text-align:center;margin-top:40px;display:none">You Must Select Client </span>

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
                            <a href="{{ route('client-report.index') }}" class="btn btn-dark mx-2"> Cancel</a>

                            <input type="submit" id="search_button" value="Search" class="btn btn-success ">

                            <button type="submit" formtarget="_blank" class="btn btn-info d-inline-block">Client Report</button>

                        </div>
                    </form>

                </div>
                <div id="report">
                    
                    @include('client-report.report')
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
            var OR = document.getElementById("client_id").value;

            if (OR == '') {
                $('#clientrror').css('display', 'block');
            } else {
                $('#clientrror').css('display', 'none');
                $.ajax({
                    type: 'POST',
                    url: "{{route('client-report.store')}}",
                    data: {
                        _token: token,
                        client_id: $('#client_id').val(),
                        from_date: $('#from_date').val(),
                        to_date: $('#to_date').val(),

                    },
                    success: function(result) {

                        $('#report').html(result);
                    },
                });
            }
        });
    });
</script>
@endsection