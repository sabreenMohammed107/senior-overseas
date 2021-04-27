<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Ignite UI for jQuery Layout Manager - border layout - initialize from HTML markup</title>
    <!-- Ignite UI for jQuery Required Combined CSS Files -->
</head>

<body>

  
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
        @if($sale)
        <div style="width: 100%;">
            <div style="display: inline-block; width:80%">
                <p> Sales Man :{{$sale->employee_name ?? ''}}</p>
            </div>

        </div>
        @endif
        <!--bank-->

        <?php
        $cashEgp = 0;
        $cashUse = 0;
        $cashUre = 0;
        $BuyEgp = 0;
        $BuyUse = 0;
        $BuyUre = 0;
        $allEgp = 0;
        $allUse = 0;
        $allUre =  0;
        ?>
        <!-- start Forloop-->
        @foreach($operations as $Buy)

        <hr>
        <?php
        $operat = App\Models\Operation::where('id', '=', $Buy)->first();

        $gypBuy = (App\Models\Operation_expense::where('currency_id', 2)->whereNotNull('buy')->where('operation_id', $Buy)->where('automatic', 1)->sum('buy') * (float)$operat->container_counts) + (App\Models\Operation_expense::where('currency_id', 2)->whereNotNull('buy')->where('operation_id', $Buy)->whereNull('automatic')->sum('buy'));
        $useBuy = (App\Models\Operation_expense::where('currency_id', 1)->whereNotNull('buy')->where('operation_id', $Buy)->where('automatic', 1)->sum('buy') * (float)$operat->container_counts) + (App\Models\Operation_expense::where('currency_id', 1)->whereNotNull('buy')->where('operation_id', $Buy)->whereNull('automatic')->sum('buy'));
        $ureBuy = (App\Models\Operation_expense::where('currency_id', 3)->whereNotNull('buy')->where('operation_id', $Buy)->where('automatic', 1)->sum('buy') * (float)$operat->container_counts) + (App\Models\Operation_expense::where('currency_id', 3)->whereNotNull('buy')->where('operation_id', $Buy)->whereNull('automatic')->sum('buy'));
        $BuyEgp = $BuyEgp + $gypBuy;
        $BuyUse = $BuyUse + $useBuy;
        $BuyUre = $BuyUre + $ureBuy;
        $gyp = (App\Models\Operation_expense::where('currency_id', 2)->whereNotNull('sell')->where('operation_id', $Buy)->where('automatic', 1)->sum('sell') * (float)$operat->container_counts) + (App\Models\Operation_expense::where('currency_id', 2)->whereNotNull('sell')->where('operation_id', $Buy)->whereNull('automatic')->sum('sell'));
        $use = (App\Models\Operation_expense::where('currency_id', 1)->whereNotNull('sell')->where('operation_id', $Buy)->where('automatic', 1)->sum('sell') * (float)$operat->container_counts) + (App\Models\Operation_expense::where('currency_id', 1)->whereNotNull('sell')->where('operation_id', $Buy)->whereNull('automatic')->sum('sell'));
        $ure = (App\Models\Operation_expense::where('currency_id', 3)->whereNotNull('sell')->where('operation_id', $Buy)->where('automatic', 1)->sum('sell') * (float)$operat->container_counts) + (App\Models\Operation_expense::where('currency_id', 3)->whereNotNull('sell')->where('operation_id', $Buy)->whereNull('automatic')->sum('sell'));
        $cashEgp = $cashEgp + $gyp;
        $cashUse = $cashUse + $use;
        $cashUre = $cashUre + $ure;
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
                    {{ date_format($date,'Y-m-d') }}
                </p>
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


            $summingEgpF = $gyp - $gypBuy;
            $summingUseF = $use - $useBuy;
            $summingUreF =  $ure - $ureBuy;

            $allEgp = $allEgp + $summingEgpF;
            $allUse = $allUse + $summingUseF;
            $allUre = $allUre + $summingUreF;
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