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



        <table class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Operation Code</th>
                
                    <th scope="col">Buy EGP</th>
                    <th scope="col">Buy USD</th>
                    <th scope="col">Buy EURO</th>
                    <th scope="col">Operation Date</th>

                </tr>
            </thead>
            <?php
            $BuyEgp = 0;
            $BuyUse = 0;
            $BuyUre = 0;
            ?>
            @foreach($operations as $Buy)
            <?php

            $gypBuy = App\Models\Operation_expense::where('currency_id', 2)->whereNotNull('buy')->where('operation_id', $Buy)->sum('buy');
            $useBuy = App\Models\Operation_expense::where('currency_id', 1)->whereNotNull('buy')->where('operation_id', $Buy)->sum('buy');
            $ureBuy = App\Models\Operation_expense::where('currency_id', 3)->whereNotNull('buy')->where('operation_id', $Buy)->sum('buy');
            $BuyEgp = $BuyEgp + $gypBuy;
            $BuyUse = $BuyUse + $useBuy;
            $BuyUre = $BuyUre + $ureBuy;
            $operat = App\Models\Operation::where('id', '=', $Buy)->first();
            ?>

            <tr>

                <th scope="row">{{$operat->operation_code}}</th>
               
                <td>{{$gypBuy}}</td>
                <td>{{$useBuy}}</td>
                <td>{{$ureBuy}}</td>
                <td><?php $date = date_create($operat->operation_date) ?>
                    {{ date_format($date,'Y-m-d') }}</td>

            </tr>

            </tbody>
            @endforeach
            <tfoot class="btn-outline-danger">
                <tr>
                    <th>Total Buy</th>
                    <th><?php echo $BuyEgp ?></th>
                    <th><?php echo $BuyUse ?></th>
                    <th><?php echo $BuyUre ?></th>

                </tr>
            </tfoot>
        </table>

        <hr>
        <div class="page-break"></div>
        <table class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Operation Code</th>
                  
                    <th scope="col">Sell EGP</th>
                    <th scope="col">Sell USD</th>
                    <th scope="col">Sell EURO</th>
                    <th scope="col">Operation Date</th>
                </tr>
            </thead>
            <?php
            $cashEgp = 0;
            $cashUse = 0;
            $cashUre = 0;
            ?>
            @foreach($operations as $sell)
            <?php

            $gyp = App\Models\Operation_expense::where('currency_id', 2)->whereNotNull('sell')->where('operation_id', $sell)->sum('sell');
            $use = App\Models\Operation_expense::where('currency_id', 1)->whereNotNull('sell')->where('operation_id', $sell)->sum('sell');
            $ure = App\Models\Operation_expense::where('currency_id', 3)->whereNotNull('sell')->where('operation_id', $sell)->sum('sell');
            $cashEgp = $cashEgp + $gyp;
            $cashUse = $cashUse + $use;
            $cashUre = $cashUre + $ure;
            $operat = App\Models\Operation::where('id', '=', $sell)->first();
            ?>

            <tr>
                <th scope="row">{{$operat->operation_code}}</th>
               
                <td>{{$gyp}}</td>
                <td>{{$use}}</td>
                <td>{{$ure}}</td>
                <td><?php $date = date_create($operat->operation_date) ?>
                    {{ date_format($date,'Y-m-d') }}</td>
            </tr>

            </tbody>
            @endforeach
            <tfoot class="btn-outline-info">
                <tr>
                    <th>Total Sell</th>
                    <th><?php echo $cashEgp ?></th>
                    <th><?php echo $cashUse ?></th>
                    <th><?php echo $cashUre ?></th>

                </tr>
            </tfoot>
        </table>

    </div>
        <table class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark" style="display: none;">
                <tr>
                    <th scope="col">Net Income</th>
                    <th scope="col">EGP</th>
                    <th scope="col">USD</th>
                    <th scope="col">EURO</th>
                </tr>
            </thead>
            <?php


            $summingEgpF = $cashEgp - $BuyEgp;
            $summingUseF = $cashUse - $BuyUse;
            $summingUreF =  $cashUre - $BuyUre;
            ?>
            <tbody>

            </tbody>

            <tfoot class="btn-info">
                <tr>
                    <th style="width: 20%;">Net Income</th>
                    <th style="width: 20%;"><?php echo $summingEgpF ?></th>
                    <th style="width: 20%;"><?php echo $summingUseF ?></th>
                    <th style="width: 20%;"><?php echo $summingUreF ?></th>
                    <th style="width: 20%;"></th>

                </tr>
            </tfoot>
        </table>
    </div>
    <footer style="height: 100px;">

    </footer>
</body>

</html>