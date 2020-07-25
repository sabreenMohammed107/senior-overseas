<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Ignite UI for jQuery Layout Manager - border layout - initialize from HTML markup</title>
    <!-- Ignite UI for jQuery Required Combined CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


</head>
<style>
    body {
        background-color: #fff;
        font-family: 'segoe ui', 'arial', 'helvetica', 'sans-serif';
        font-size: 14px;
        /* overflow-x:hidden; */
    }

    .test {
        width: 100%;


    }

    .test-4 {
        display: inline-block;
        width: 40%;
        padding: 10px 0 0 0;
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
    .clearance{
        display: inline-block;
        padding: 10px 0 0 0; 
        width: 50%; 
    }
    .clearance input{
        width: 40%;
    }
</style>

<body>

    <div class="container">
        <div class="card-body" style="margin-top: 80px;">
            <div style="margin-bottom: 20px;border-bottom:1px solid #000;padding:10px 0px">
                <h2>
                    Sale Quote

                </h2>
            </div>

        </div>


        <div class="test">

            <div class="test-4 mb-3">

                <label>Client</label>
                <input type="text" name="client_id" value="@if($row->client){{$row->client->client_name}}@endif" placeholder="Quote code">



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
                <input type="text" name="client_id" value="@if($row->employee){{$row->employee->client_name}}@endif" placeholder="Quote code">


            </div>

        </div>
        @if($filtters !=null)  
        <!--datatable select data -->
        <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
     
        <thead class="thead-dark" style="font-size: 14px;">
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
                    <th>T.T.(Days</th>
                    <th> Notes</th>
                    @endif
                    <th>Price</th>

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


                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <div style="border-bottom:solid 2px #0094ff;margin-bottom:20px"></div>

        <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark" style="font-size: 14px;">
                <tr>
                    <th>#</th>
                    <th> supplier</th>

                    <th> Pol</th>
                    <th> Pod</th>
                    <th> Car</th>
                    <th>T.T(Days</th>
                    <th>Notes</th>
                    <th>Price</th>
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

                </tr>
                @endforeach

            </tbody>
        </table>
        <div style="border-bottom:solid 2px #0094ff;margin-bottom:20px"></div>
        <div class="test">

            <div class="clearance">

            <label>Clearance Suppliers</label>
                            <input type="text" name="supplier_id" value="@if($row->supplier){{$row->supplier->supplier_name_name}}@endif" >

            </div>

            <div class="clearance">

                <label >Clearance Currency</label>
               <input type="text" name="supplier_id" value="@if($row->clearance){{$row->clearance->currency_name}}@endif" >
            </div>
        </div>

        <div class="test">

            <div class="clearance">

            <label>Clearance Price</label>
                            <input type="text" disabled name="clearance_price" value="{{$row->clearance_price}}" placeholder="Clearance Price">
            </div>

            <div class="clearance">

               
            </div>
        </div>

        <div style="border-bottom:solid 2px #0094ff;margin-bottom:20px"></div>
        <div class="test">

            <div class="clearance">

            <label>Door Agent</label>
                            <input type="text" name="agent_id" value="@if($row->agent){{$row->agent->agent_name}}@endif" placeholder="Quote code">
            </div>

            <div class="clearance">

            <label >Door Currency</label>
                            <input type="text" name="door_door_currency_id" value="@if($row->door){{$row->door->currency_name}}@endif" placeholder="Quote code">

            </div>
        </div>

        <div class="test">

            <div class="clearance">

            <label >Door Price</label>
                                <input type="text" disabled name="door_door_price" value="{{$row->door_door_price}}" placeholder="Door to Door Price">
            </div>

            <div class="clearance">

               
            </div>
        </div>



        <!-- /.row -->



        <footer style="height: 100px;">

        </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
</body>

</html>