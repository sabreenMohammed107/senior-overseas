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
                <h6>Earn Report</h6>

            </div>

            <div class="ms-panel-body">
                <!--Extra Data-->
                <div class="col-12 p-3">

                    <form action="{{ route('earn-balance.store') }}" method="post">
                        @csrf

                        <div class="ms-auth-container row no-gutters">
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
                        <button type="submit" formtarget="_blank" class="btn btn-info d-inline-block">Show Report</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')



<script type="text/javascript">

</script>
@endsection