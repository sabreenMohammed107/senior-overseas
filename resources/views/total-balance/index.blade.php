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
<div class="ms-panel-body">

<form action="{{ route('total-balance.store') }}" method="post">
					@csrf
<button type="submit" formtarget="_blank" class="btn btn-info d-inline-block">Show Report</button>
</form>
</div>
</div>

@endsection
@section('scripts')



<script type="text/javascript">

</script>
@endsection