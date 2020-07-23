<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <title>Report</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        /* =============================================================
   GENERAL STYLES
 ============================================================ */
        .content {
            margin: 200px 100px;


        }

        .formData {
            margin-bottom: 100px;
        }

        .form_in {
            display: inline-block;
            width: 50%;
            height: 250px;
        }

        .in_style {
            margin: 20px;
        }
    </style>
</head>



<body>

    <section id="invoice" class="py-5 bg-light">
        <div class="container">
            <div class="card">

                <!-- <div class="card-header bg-primary text-white border-0" style="height: 110px;">
                    <h5 style="font-size: 30px;margin-left:50px">Over Seas Egypt
                        <img style="background-color: #FFF;float:right;margin:5px 20px" src="{{ asset('adminasset/img/logo.png')}}" alt="logo" width="150" height="100" />
                    </h5>
                    <p style="font-size: 20px;margin-left:50px">Professional frieght forwarder</p>
                </div> -->
                <div class="card-body">

                    <div class=" col-md-12 mb-4" style="margin-top:100px">
                        <h2 style="margin-bottom: 40px;">
                            Statment No: <a>{{$invoice->invoice_no}}</a></h2>
                        <div class="form_in">

                            <div class="in_style">Date: <a>
                                    <?php $dateinvoice = date_create($invoice->invoice_date)
                                    ?>
                                    {{ date_format($dateinvoice,'Y-m-d') ?? '' }}

                                </a></div>

                            <div class="in_style">Cur: <a>@foreach($curs as $cur){{$cur}} @endforeach</a></div>
                            <div class="in_style">Ref#: <a>{{$invoice->operation->operation_code}}</a></div>
                            <div class="in_style">Tracking start point: <a>{{$invoice->operation->tracking->truck->pol->port_name ?? '' }}</a></div>
                            <div class="in_style">Tracking end point: <a>{{$invoice->operation->tracking->truck->pod->port_name ?? '' }}</a></div>
                            <div class="in_style">truck container type: <a>{{$invoice->operation->tracking->truck->car->car_type ?? '' }}</a></div>
                            <div class="in_style">to: <a>{{$invoice->operation->sale->client->client_name ?? '' }} <br> {{$invoice->operation->sale->client->address ?? '' }}</a></div>


                        </div>

                        <div class="form_in">

                            <div class="in_style">BL NO: <a>{{$invoice->operation->pl_no}}</a></div>
                            <div class="in_style">Volume: <a>{{$invoice->operation->container_counts }} @if($invoice->operation->ocean) <span>X</span>  @endif {{$invoice->operation->ocean->ocean->container->container_size ?? ''}} {{ $invoice->operation->ocean->ocean->container->container_type ?? ''}}</a></div>
                            <div class="in_style">
                            @if($invoice->operation->ocean)
                                <span>Pol </span>
                                @elseif($invoice->operation->air)
                                <span>Aol:</span>
                                @else
                                <span></span>
                                @endif
                                <a>{{$invoice->operation->ocean->ocean->pol->port_name ?? '' }}{{$invoice->operation->air->air->aol->port_name ?? '' }}</a></div>
                            <div class="in_style">
                            @if($invoice->operation->ocean)
                                <span>Pod </span>
                                @elseif($invoice->operation->air)
                                <span>Aod:</span>
                                @else
                                <span></span>
                                @endif
                                <a>{{$invoice->operation->ocean->ocean->pod->port_name ?? '' }}{{$invoice->operation->air->air->aod->port_name ?? '' }}</a></div>
                            <div class="in_style">Loading Date: <a>
                                    <?php $dateinvoice = date_create($invoice->operation->loading_date)
                                    ?>
                                    {{ date_format($dateinvoice,'Y-m-d') ?? '' }}
                                </a></div>

                                <div class="in_style">Arrival Date: <a>
                                    <?php $dateinvoice2 = date_create($invoice->operation->arrival_date)
                                    ?>
                                    {{ date_format($dateinvoice2,'Y-m-d') ?? '' }}
                                </a></div>


                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead class="bg-blue-200 text-white">
                                <tr>
                                    <th class="center">Item</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th class="right">Rate</th>
                                    <th class="center">Cur </th>
                                    <th class="right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rows as $index => $row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td class="left strong">{{$row->provider->expenses_name ?? ''}}</td>
                                    <td class="left">{{ $row->operation->container_counts}} @if($row->operation->ocean) <span>X</span>  @endif {{$row->operation->ocean->ocean->container->container_size ?? ''}} {{ $row->operation->ocean->ocean->container->container_type ?? ''}}</td>
                                    <td class="right">{{$row->sell}}</td>
                                    <td class="center"><i class="fas fa-rupee-sign"></i>{{$row->currency->currency_name}}</td>
                                    <td class="right"><i class="fas fa-rupee-sign"></i>
                                     @if($row->automatic==1)
                                        {{$row->sell *$row->operation->container_counts}}
                                        @else
                                        {{$row->sell *1}}
                                        @endif</td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    @foreach($curs as $cur)

                                    <tr>
                                        <td class="left">
                                            <strong>total - {{$cur}}</strong>
                                        </td>
                                        @foreach($totals as $total)
                                        @if($total->cur===$cur)
                                        <td class="right"><i class="fas fa-rupee-sign"></i> {{" " . number_format($total->num, 2, '.', ',')  }}  <br> {{$total->total}}</td>
                                        @endif
                                        @endforeach
                                    </tr>


                                    @endforeach
                                
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- <footer class="bg-primary" style="width:100%;height:100px; position: absolute;
  bottom: 10px;color:#fff;font-size:20px">
            <div style="margin-top: 30px;text-align:center">
                <strong>No 2 Fatma El Nabouia St., </strong><span> Mob:01208787456</span><br>
                <strong>Email:info@os-eg.com</strong></div>
        </footer> -->
    </section>


</body>

</html>