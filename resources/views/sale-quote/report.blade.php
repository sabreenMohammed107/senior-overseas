<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Ignite UI for jQuery Layout Manager - border layout - initialize from HTML markup</title>
    <!-- Ignite UI for jQuery Required Combined CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


</head>
<style>
    .test {
        width: 100%;


    }

    .test-4 {
        display: inline-block;
        width: 40%;
        padding: 30px 0 0 0;
    }

    .test-3 {
        display: inline-block;
        width: 33%;
        font-size: 14px;
        padding: 30px 0 0 0;
    }

    .col-md-12 {

        width: 100%;
    }
</style>

<body>
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



                <div class="test">

                    <input type="hidden" name="savingType" value="{{$typeTesting}}">
                    <div class="test-4 mb-3">

                        <label>Client</label>
                        <select name="client_id" disabled data-live-search="true">
                            <option value="">Select ...</option>
                            @foreach ($clients as $type)
                            <option value='{{$type->id}}' {{ $type->id == $row->client_id ? 'selected' : '' }}>
                                {{ $type->client_name}}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="test-4">

                        <label>Quote Date </label>
                        <?php $date = date_create($row->quote_date) ?>

                        <input type="text" name="quote_date" value="{{ date_format($date,'Y-m-d') }}">
                    </div>
                </div>
                <div class="test ">

                    <div class="test-4 mb-3">

                        <label for="exampleCheck1">Code</label>
                        <input type="text" name="quote_code" readonly value="{{$row->quote_code}}" placeholder="Quote code">


                    </div>

                    <div class="test-4 mb-3" style="margin-left: 20px;">

                        <label>Employee</label>
                        <select name="sale_person_id" disabled data-live-search="true">
                            <option value="">Select ...</option>
                            @foreach ($employees as $type)
                            <option value='{{$type->id}}' {{ $type->id == $row->sale_person_id ? 'selected' : '' }}>
                                {{ $type->employee_name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="ms-auth-container row no-gutters">
                    <div class="col-12 p-3">
                        <!--datatable select data -->
                        <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    @if($typeTesting==0)
                                    <th> Carrier</th>

                                    <th> Rang</th>
                                    <th> Aol</th>
                                    <th> Aod</th>
                                    <th> Notes</th>

                                    @else
                                    <th> Carrier</th>

                                    <th> Pol</th>
                                    <th> Pod</th>
                                    <th>Transit Time (Days</th>
                                    <th> Notes</th>
                                    @endif
                                    <th>Price</th>

                                    <th>Ckecked box</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($filtters as $index => $filter)
                                <tr>
                                    <td>{{$index+1}}</td>


                                    @if($typeTesting==0)
                                    <td>@if($filter->air->carrier)
                                        {{$filter->air->carrier->carrier_name}}
                                        @endif</td>
                                    <td>{{$filter->air->slide_range}}</td>

                                    <td>@if($filter->air->aol)
                                        {{$filter->air->aol->port_name}} - {{$filter->air->aol->country->country_name}}
                                        @endif</td>
                                    <td>@if($filter->air->aod)
                                        {{$filter->air->aod->port_name}} - {{$filter->air->aod->country->country_name}}
                                        @endif</td>
                                    <td>{{$filter->air->notes}}</td>
                                    @else
                                    <td>@if($filter->ocean->carrier)
                                        {{$filter->ocean->carrier->carrier_name}}
                                        @endif</td>
                                    <td>@if($filter->ocean->pol)
                                        {{$filter->ocean->pol->port_name}} - {{$filter->ocean->pol->country->country_name}}
                                        @endif</td>
                                    <td>@if($filter->ocean->pod)
                                        {{$filter->ocean->pod->port_name}} - {{$filter->ocean->pod->country->country_name}}
                                        @endif</td>
                                    <td> {{$filter->ocean->transit_time}}</td>
                                    <td>{{$filter->ocean->notes}}</td>

                                    @endif

                                    <td>
                                        {{$filter->price}}
                                    </td>
                                    <td>

                                        <input disabled name='tableId[]' checked type="checkbox" id="checkItem" value="{{$filter->id}}">


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            <div style="border-bottom:solid 2px #0094ff;margin-bottom:20px"></div>
                            <div class="ms-auth-container row">
                                <!-- Tracking table -->
                                <div class="col-12 p-3">
                                    <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th> supplier</th>

                                                <th> Pol</th>
                                                <th> Pod</th>
                                                <th> Car</th>
                                                <th>Transit Time (Days</th>
                                                <th>Notes</th>
                                                <th>Price</th>
                                                <th>Ckecked box</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($trackings as $index => $track)
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td>@if($track->truck->supplier)
                                                    {{$track->truck->supplier->supplier_name}}
                                                    @endif</td>
                                                <td>@if($track->truck->pol)
                                                    {{$track->truck->pol->port_name}} - {{$track->truck->pol->country->country_name}}
                                                    @endif</td>
                                                <td>@if($track->truck->pod)
                                                    {{$track->truck->pod->port_name}} - {{$track->truck->pod->country->country_name}}
                                                    @endif</td>
                                                <td>@if($track->truck->car)
                                                    {{$track->truck->car->car_type}}
                                                    @endif</td>
                                                <td>{{$track->truck->transit_time}}</td>
                                                <td>{{$track->truck->notes}}</td>
                                                <td>
                                                    <?php echo $trackings[$index]->car_price; ?>
                                                </td>
                                                <td>
                                                    <input disabled name='idTracking[]' checked type="checkbox" id="checkItem" value="<?php echo $trackings[$index]->id; ?>">
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- End Table -->


                            </div>
                        </div>
                        <div>
                            <div style="border-bottom:solid 2px #0094ff;margin-bottom:20px"></div>
                            <div class="test">
                                <div class="test-3 mb-3">

                                    <label>Clearance Suppliers</label>
                                    <select name="supplier_id" disabled data-live-search="true">
                                        <option value="">Select ...</option>
                                        @foreach ($clearancesSuppliers as $type)
                                        <option value='{{$type->id}}' {{ $type->id == $row->supplier_id ? 'selected' : '' }}>
                                            {{ $type->supplier_name}}</option>
                                        @endforeach
                                    </select>
                                    <label style="margin-left: 10px;">Clearance Currency</label>
                                    <select name="clearance_currency_id" disabled data-live-search="true">
                                        <option value="">Select ...</option>
                                        @foreach ($clearances as $type)
                                        <option value='{{$type->id}}' {{ $type->id == $row->clearance_currency_id ? 'selected' : '' }}>
                                            {{ $type->currency_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="test">
                                <div class="test-3">

                                    <label style="margin-left: 10px;">Clearance Price</label>
                                    <input type="text" disabled name="clearance_price" value="{{$row->clearance_price}}" placeholder="Clearance Price">



                                </div>
                            </div>
                           
                                <div style="border-bottom:solid 2px #0094ff;margin-bottom:30px"></div>
                               
                                <div class="test">
                                    <div class="test-3 mb-3">

                                        <label>Door Agent</label>
                                        <select name="agent_id" data-live-search="true">
                                            <option value="">Select ...</option>
                                            @foreach ($agents as $type)
                                            <option value='{{$type->id}}' {{ $type->id == $row->agent_id ? 'selected' : '' }}>
                                                {{ $type->agent_name}}</option>
                                            @endforeach
                                        </select>
                                        <label style="margin-left: 10px;">Door Currency</label>
                                        <select name="door_door_currency_id" data-live-search="true">
                                            <option value="">Select ...</option>
                                            @foreach ($doors as $type)
                                            <option value='{{$type->id}}' {{ $type->id == $row->door_door_currency_id ? 'selected' : '' }}>
                                                {{ $type->currency_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="test">
                                        <div class="test-3">

                                            <label style="margin-left: 10px;">Door Price</label>
                                            <input type="text" disabled name="door_door_price" value="{{$row->door_door_price}}" placeholder="Door to Door Price">
                                        </div>
                                    </div>

                                   
                              
    </div>
    </div>
    <!-- /.row -->


    </div>
    <footer style="height: 100px;">

    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
</body>

</html>