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
            width: 30%;
            height: 120px;
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
                <div class="card-body" style="margin-top: 80px;">
                    <h2 style="margin-bottom: 40px;border-bottom:1px solid #000;padding:20px 0px">
                        Client Report</h2>
                    <div class="form_in">
                        <div class="in_style">Client Name: <a>{{$client_name}}</a></div>  </div>
                        <div class="form_in"><div class="in_style">From Date: <a>{{$from_date }}</a></div></div>
                        <div class="form_in"> <div class="in_style">To Date: <a>{{$to_date}}</a></div></div>
                    </div>
                    <div class="table-responsive-sm">
                        <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Transaction Date</th>
                                    <th>Currency</th>
                                    <th>Transaction Type</th>
                            <th>Operation code</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($filtters as $index => $Report)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$Report->depit}}</td>
                                    <td>{{$Report->credit}}</td>
                                    <td> <?php $date = date_create($Report->entry_date) ?>
                                        {{ date_format($date,'Y-m-d') }}</td>

                                    <td>@if($Report->currency){{$Report->currency->currency_name}}@endif</td>
                                    <td>@if($Report->type){{$Report->type->trans_type}}@endif</td>
                                <td>@if($Report->operation){{$Report->operation->operation_code}}@endif</td>
                                </tr>
                                @endforeach
                                </tr>
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
                                        <td class="right"><i class="fas fa-rupee-sign"></i> {{" " . number_format($total->num, 2, '.', ',')  }} <br> {{$total->total}}</td>
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

    </section>


</body>

</html>