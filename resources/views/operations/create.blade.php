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
				<h6>Operations</h6>
				<!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
			</div>
			<div class="ms-panel-body">
				<div class="ms-auth-container row no-gutters">
					<div class="col-12 p-3">
						<form action="{{ route('operations.store') }}" method="post">
							@csrf
							<!-- <div style="border-bottom:solid #0094ff 2px;"
									  >
									  <h2>Read From Exiting Quote</h2>
									</div><br /> -->
									<style>
									.fake {
										display: none;
									}
								</style>
						
								<input type="radio" name="tab" value="igotnone" onclick="existing();" checked /> Exiting
								<input type="radio" name="tab" value="igottwo" onclick="fake();" clicked="clicked" /> Fake
							<hr>
							<div class="ms-auth-container row">
								<div class="col-md-6 mb-3 " id="exist">
									<div class="ui-widget form-group">
										<label>Read From Exiting Quote</label>
										<select id="existselect" name="sales_quote_id_exist" class="form-control dynamic" data-dependent="allData" data-show-subtext="true" data-live-search="true" id="exist">
											<option value="">Select ...</option>
											@foreach ($qouts as $type)
											<option value='{{$type->id}}'>
												{{$type->quote_code}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="ui-widget form-group fake" id="fake">
										<label>Read From Fake Quote</label>
										<select id="fakeselect" name="sales_quote_id_fake" class=" form-control" data-live-search="true">
											<option value="">Select ...</option>
											@foreach ($qoutsFake as $type)
											<option value='{{$type->id}}'>
												{{$type->quote_code}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div id="main">

								@include('operations.search')
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- /.row -->


</div>
@endsection

@section('scripts')



<script type="text/javascript">
function existing() {
	
	document.getElementById('exist').style.display = 'block';
	document.getElementById('fake').style.display = 'none';
	 $('#fakeselect').val('');
	
}

function fake() {

	document.getElementById('exist').style.display = 'none';
	document.getElementById('fake').style.display = 'block';
	$('#existselect').val('');
}
	$(document).ready(function() {

		$('select[name="sales_quote_id_fake"]').on('change', function() {
			var xx = $(this).val();

			if (xx) {
			
				$.ajax({
					url: "{{route('dynamicdependentexist.fetch')}}",
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

		$('select[name="sales_quote_id_exist"]').on('change', function() {
			var buildings_id = $(this).val();

			if (buildings_id) {
			
				$.ajax({
					url: "{{route('dynamicdependentexist.fetch')}}",
					method: "get",
					data: {
						buildings_id: buildings_id,

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