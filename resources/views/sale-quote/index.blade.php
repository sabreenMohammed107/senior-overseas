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
				<h6>Sales Quote</h6>
				<a href="{{ route('sale-quote.create') }}" class="btn btn-dark"> add new </a>
			</div>
			<div class="ms-panel-body">
				<div class="table-responsive">
					<table id="courseEval" class="dattable table table-striped thead-dark  w-100">
						<thead>
							<tr>
								<th>#</th>
								<th> Quote Code</th>
								<th> Quote Date</th>
								<th> Quote Client</th>
								<th> Validity Date</th>

								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($rows as $index => $row)
							<tr>
								<td>{{$index+1}}</td>
								<td>{{$row->quote_code}}</td>
								<td> <?php $date = date_create($row->quote_date) ?>
									{{ date_format($date,'Y-m-d') }}</td>
								<td>@if($row->client)
									{{$row->client->client_name}}
									@endif</td>
									@if($row->air_validity_date !=null)
								<td> <?php $date = date_create($row->air_validity_date) ?>
									{{ date_format($date,'Y-m-d') }}</td>
									@else
									<td> <?php $date = date_create($row->ocean_validity_date) ?>
									{{ date_format($date,'Y-m-d') }}</td>
									@endif

								<td>
									<a href="{{ route('sale-quote.edit',$row->id) }}" class="btn btn-info d-inline-block">View</a>
									<a href="#" onclick="destroy('this sale-quote','{{$row->id}}')" class="btn d-inline-block btn-danger">delete</a>
									<form id="delete_{{$row->id}}" action="{{ route('sale-quote.destroy', $row->id) }}" method="POST" style="display: none;">
										@csrf
										@method('DELETE')
										<button type="submit" value=""></button>
									</form>
									<a href="{{ route('sale-quote.show',$row->id) }}" target="_blank" class="btn btn-info d-inline-block">Report</a> 

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
<!-- /.row -->


</div>
@endsection