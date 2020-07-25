<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Ignite UI for jQuery Layout Manager - border layout - initialize from HTML markup</title>
    <!-- Ignite UI for jQuery Required Combined CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>

<body>

    <style type="text/css">
        body {
            background-color: #fff;
            font-family: 'segoe ui', 'arial', 'helvetica', 'sans-serif';
            font-size: 14px;
            /* overflow-x:hidden; */
        }


        .page-break {
            page-break-after: always;
        }


        footer {
            position: fixed;
            width: 100%;
            bottom: 0;
            left: 0;
            right: 0;
        }
    </style>
    <div class="container">
        <div class="card-body" style="margin-top: 80px;">
            <div style="margin-bottom: 40px;border-bottom:1px solid #000;padding:10px 0px">
                <h2>
                    Operation Report

            </div>





        </div>
        <div style="width: 100%;">
            <div style="display: inline-block; width:50%">
                <p> From :{{$from}}</p>
            </div>
            <div style="display: inline-block; width:50%">
                <p> To :{{$to}}</p>
            </div>
        </div>
        <!--bank-->

        <?php
        $cashEgp = 0;
        $cashUse = 0;
        $cashUre = 0;
        $BuyEgp = 0;
        $BuyUse = 0;
        $BuyUre = 0;
        $allEgp = 0;
        $allUse =0;
        $allUre =  0;
        ?>
        <!-- start Forloop-->
        @foreach($operations as $Buy)

        <hr>
        <?php
        $gypBuy = App\Models\Operation_expense::where('currency_id', 2)->whereNotNull('buy')->where('operation_id', $Buy)->sum('buy');
        $useBuy = App\Models\Operation_expense::where('currency_id', 1)->whereNotNull('buy')->where('operation_id', $Buy)->sum('buy');
        $ureBuy = App\Models\Operation_expense::where('currency_id', 3)->whereNotNull('buy')->where('operation_id', $Buy)->sum('buy');
        $BuyEgp = $BuyEgp + $gypBuy;
        $BuyUse = $BuyUse + $useBuy;
        $BuyUre = $BuyUre + $ureBuy;
        $gyp = App\Models\Operation_expense::where('currency_id', 2)->whereNotNull('sell')->where('operation_id', $Buy)->sum('sell');
        $use = App\Models\Operation_expense::where('currency_id', 1)->whereNotNull('sell')->where('operation_id', $Buy)->sum('sell');
        $ure = App\Models\Operation_expense::where('currency_id', 3)->whereNotNull('sell')->where('operation_id', $Buy)->sum('sell');
        $cashEgp = $cashEgp + $gyp;
        $cashUse = $cashUse + $use;
        $cashUre = $cashUre + $ure;
        $operat = App\Models\Operation::where('id', '=', $Buy)->first();
        ?>
        <div style="width: 100%;">
            <div style="display: inline-block; width:30%">
                <p> <strong>Code:</strong>{{$operat->operation_code}}</p>
            </div>
            <div style="display: inline-block; width:30%">
                <p> <strong>Client :</strong> @if($operat->shipper){{$operat->shipper->client_name}}@endif</p>
            </div>



            <div style="display: inline-block; width:30%">
                <p> <strong>Date :</strong> <?php $date = date_create($operat->operation_date) ?>
                    {{ date_format($date,'Y-m-d') }}</p>
            </div>

        </div>

        <table class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">EGP</th>
                    <th scope="col">USD</th>
                    <th scope="col">EURO</th>
                </tr>
            </thead>
            <?php


            $summingEgpF = $gyp-$gypBuy;
            $summingUseF = $use-$useBuy;
            $summingUreF =  $ure-$ureBuy;

            $allEgp = $allEgp+$summingEgpF;
            $allUse =$allUse+$summingUseF;
            $allUre =$allUre+$summingUreF;
            ?>
            <tbody>
                <tr>
                    <td>Sell</td>
                    <td>{{$gyp}}</td>
                    <td>{{$use}}</td>
                    <td>{{$ure}}</td>

                </tr>
                <tr>
                    <td>Buy</td>
                    <td>{{$gypBuy}}</td>
                <td>{{$useBuy}}</td>
                <td>{{$ureBuy}}</td>

                </tr>
            </tbody>

            <tfoot class="btn-info">
                <tr>
                    <th>Net Income</th>
                    <th><?php echo $summingEgpF ?></th>
                    <th><?php echo $summingUseF ?></th>
                    <th><?php echo $summingUreF ?></th>


                </tr>
            </tfoot>
        </table>

        @endforeach



    </div>
    <hr>
    <table class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark" style="display: none;">
                <tr>
                    <th scope="col">Net Income</th>
                    <th scope="col">EGP</th>
                    <th scope="col">USD</th>
                    <th scope="col">EURO</th>
                </tr>
            </thead>
         
            <tbody>

            </tbody>

            <tfoot class="btn-info">
                <tr>
                    <th>Net Income For All</th>
                    <th><?php echo $allEgp ?></th>
                    <th><?php echo $allUse ?></th>
                    <th><?php echo $allUre ?></th>
                    <th></th>

                </tr>
            </tfoot>
        </table>
    <footer style="height: 100px;">

    </footer>
</body>

</html>