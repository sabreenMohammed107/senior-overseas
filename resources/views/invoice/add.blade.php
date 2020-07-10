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
                <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
            </div>
            <div class="ms-panel-body">
                <div class="ms-auth-container row no-gutters">
                    <div class="col-12 p-3">
                        <form action="{{ route('invoice.store') }}" method="post">
                        {{ csrf_field() }}
                            <div class="ms-auth-container row">
                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Operation Code</label>
                                        <select id="operation_id" name="operation_id" class="form-control dynamic" data-dependent="allData" data-show-subtext="true" data-live-search="true" id="exist">
											<option value="">Select ...</option>
											@foreach ($operations as $type)
											<option value='{{$type->id}}'>
												{{$type->operation_code}}</option>
											@endforeach
										</select>
                                    </div>
                                </div>
                            </div>
                            <div id="main">

                                @include('invoice.search')
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

        $('select[name="operation_id"]').on('change', function() {
            var xx = $(this).val();

            if (xx) {

                $.ajax({
                    url: "{{route('dynamicoperation.fetch')}}",
                    method: "get",
                    data: {
                        buildings_id: xx,

                    },
                    success: function(result) {
                        $('#main').html(result);
                    }
                });
            } else {

            }
        });


    });
</script>
@endsection