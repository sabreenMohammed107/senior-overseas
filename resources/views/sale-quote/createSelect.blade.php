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
	<style>
		.hide {
			display: none;
		}
	</style>

	<div class="col-md-12">
		<div class="ms-panel">
			<div class="ms-panel-header d-flex justify-content-between">
				<h6>Sale Quote</h6>
				<!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
			</div>
			<div class="ms-panel-body">
				<form action="{{ route('gotosave') }}" method="post">
					@csrf
				
					<div style="margin-bottom:25px">
						<div style="border-bottom:solid 2px #0094ff;width:160px">
							<input type="radio" name="tab" value="igotnone" onclick="show1();" checked /> Air
							<input type="radio" name="tab" value="igottwo" onclick="show2();" clicked="clicked" /> Ocean
						</div>

					</div>
					<div class="ms-auth-container row no-gutters">
						<div class="col-12 p-3">
							<div id="div2">
								<div class="ms-auth-container row">
								<div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
										<label>Range</label>
										<input type="text" name="slide_range" class=" form-control" placeholder="slide_range" >
                                       
                                    </div>
                                </div>
								<div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Carrier Name</label>
                                        <select name="air_carrier_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($airs as $type)
                                            <option value='{{$type->id}}'>
											
                                    {{$type->carrier_name}}
                                 
                                             </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

								<div class="col-md-6 mb-3">
									<div class="ui-widget form-group">
										<label>Aol</label>
										<select name="aol_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($aols as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->port_name}} - {{$type->country->country_name}}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="ui-widget form-group">
										<label>Aod</label>
                                        <select name="aod_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($aods as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->port_name}} - {{$type->country->country_name}}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>
								
							</div></div>
							<div id="div1" class="hide">
								<div class="ms-auth-container row">
								<div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Carrier Name Ocean</label>
                                        <select name="carrier_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($oceans as $type)
                                            <option value='{{$type->id}}'>
										
												{{ $type->carrier_name}}
											</option>
                                            @endforeach
                                        </select>
                                    </div>
								</div>
								<div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>containers</label>
                                        <select name="container_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
										@foreach ($containers as $type)
                                            <option value='{{$type->id}}'>
                                            {{$type->container_size}}-{{$type->container_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

								<div class="col-md-6 mb-3">
									<div class="ui-widget form-group">
										<label>Aol</label>
										<select name="pol_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($aols as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->port_name}} - {{$type->country->country_name}}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="ui-widget form-group">
										<label>Aod</label>
                                        <select name="pod_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($aods as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->port_name}} - {{$type->country->country_name}}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>


								
									
									
									</div>
								</div>
							</div>
					</div>
								<!-- Tracking Data -->
								<div style="border-bottom:solid 2px #0094ff;margin-bottom:20px"></div>
								<div class="ms-auth-container row">
								<div class="col-md-6 mb-3">
									<div class="ui-widget form-group">
										<label>Suppliers</label>
										<select name="supplier_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($suppliers as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->supplier_name}}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="ui-widget form-group">
										<label>Car Type</label>
										<select name="car_type_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($cars as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->car_type}}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="ui-widget form-group">
										<label>Pol</label>
										<select name="track_aol_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($aols as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->port_name}} - {{$type->country->country_name}}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="ui-widget form-group">
										<label>Pod</label>
                                        <select name="track_pod_id" class=" form-control" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($aods as $type)
                                            <option value='{{$type->id}}'>
                                                {{ $type->port_name}} - {{$type->country->country_name}}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>

								</div>
					

							<div class="input-group d-flex justify-content-end text-center">
								<a href="{{ route('sale-quote.index') }}" class="btn btn-dark mx-2"> Cancel</a>
								<!-- <input type="button" value="Cancel" class="btn btn-dark mx-2" data-dismiss="modal" aria-label="Close"> -->
								<input type="submit" value="Search" class="btn btn-success ">
							</div>

						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /.row -->


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



</script>
<!--/radio button-->


@endsection