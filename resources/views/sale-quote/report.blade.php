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
        margin-top: 20px;
        width: 100%;


    }
    th {
  height: 5px;
}
    .test-4 {
        display: inline-block;
        width: 40%;
        padding: 5px 0 0 0;
    }



    .col-md-12 {

        width: 100%;
    }

    .clearance {
        display: inline-block;
        padding: 10px 0 0 0;
        width: 50%;
    }

    .clearance input {
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

        <!--datatable select data -->
        <table id="courseEval" class="dattable table table-striped thead-dark  w-100" style="font-size: 12px;">

            @if($filtters->isEmpty())
            <thead class="thead-dark" style="font-size: 12px; display:none">
                @else
                <thead class="thead-dark" style="font-size: 12px;">

                    @endif <tr>
                        <th>#</th>
                        @if($typeTesting==0)
                        <th> Carrier</th>

                        <th> Rang</th>
                        <th> Aol</th>
                        <th> Aod</th>
                        <th> Date</th>

                        @else
                        <th> Carrier</th>
                        <th> Container</th>
                        <th> Pol</th>
                        <th> Pod</th>
                        <th>T.T.(Days</th>
                        <th> Date</th>
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
                  

                    <td>
                        @if($filter->air)
                        <?php $date1 = date_create($filter->air_validity_date) ?>
                        {{ date_format($date1,'Y-m-d') }}
                        @endif
                    </td>



                    @else
                    <td>@if($filter->ocean->carrier)
                        {{$filter->ocean->carrier->carrier_name}}
                        @endif</td>
                        <td>@if($$filter->ocean->container)
                                {{$filter->ocean->container->container_size}}-{{$filter->ocean->container->container_type}} 
                                    @endif</td>
                    <td>@if($filter->ocean->pol)
                        {{$filter->ocean->pol->port_name}} - {{$filter->ocean->pol->country->country_name}}
                        @endif</td>
                    <td>@if($filter->ocean->pod)
                        {{$filter->ocean->pod->port_name}} - {{$filter->ocean->pod->country->country_name}}
                        @endif</td>
                    <td> {{$filter->ocean->transit_time}}</td>
                    <td>
                        @if($filter->ocean)
                        <?php $date2 = date_create($filter->ocean_validity_date) ?>
                        {{ date_format($date2,'Y-m-d') }}
                        @endif
                    </td>
                    @endif

                    <td>
                        {{$filter->price}}
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="border-bottom:solid 2px #0094ff;margin-bottom:20px"></div>

        <table id="courseEval" class="dattable table table-striped thead-dark  w-100" style="font-size: 12px;">
            <thead class="thead-dark" style="font-size: 12px;">
                <tr>
                    <th>#</th>
                  
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
                    <td>
                    @if($track->truck)
                        <?php $date3 = date_create($track->validity_date) ?>
                        {{ date_format($date3,'Y-m-d') }}
                        @endif
                        </td>
                    <td>
                        <?php echo $trackings[$index]->car_price; ?>
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
        <table  class="dattable table table-striped thead-dark  w-100" style="font-size: 14px;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Clearance</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  
                </tr>
            </thead>
           
            <tbody>
<tr>
    <td style="width: 90%;">Currency : @if($row->clearance){{$row->clearance->currency_name}}@endif</td>
    <td> </td>
    <td></td>
</tr>
<tr>
    <td style="width: 90%;">Price : {{$row->clearance_price}}</td>
    <td> </td>
    <td></td>
</tr>
<tr>
    <td style="width: 90%;">Notes :{{$row->clearance_notes}}</td>
    <td> </td>
    <td></td>
</tr>
            </tbody>

            <tfoot class="btn-outline-info">
                
            </tfoot>
        </table>
        <div style="border-bottom:solid 2px #0094ff;margin-bottom:20px"></div>
        <div class="test" style="border: 1px solid #000;">

            <h5>Terms & Conditions</h5>
            <ul style="font-size: 12px;">
                <li>Rates are excluding any official receipts.</li>
                <li>Bosla first container EGP 50 there after EGP 15/Container same declaration.</li>
                <li>Rates are subject to modification upon any sovereign changes.</li>
                <li>Invoices will be sent to your premises within 5 working days.</li>
            </ul>
            <span>Please find truck detention charges below:</span>
            <ul style="font-size: 12px;">
                <li>First 8 hours for free.</li>
                <li>From hour 8 to hour 12 from truck arrival :EGP 700.</li>
                <li>From hour 12 to hour 24 from truck arrival :1/2freight.</li>
                <li>After 24 hours from truck arrival :Full freight will be added per day.</li>
            </ul>
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