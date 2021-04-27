<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Ignite UI for jQuery Layout Manager - border layout - initialize from HTML markup</title>
    <!-- Ignite UI for jQuery Required Combined CSS Files -->
</head>

<body>

  <style>
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
        /* new */
       
        .col-md-push-10 {
                left: 83.33333333%
            }

            .col-md-push-9 {
                left: 75%
            }

            .col-md-push-8 {
                left: 66.66666667%
            }

            .col-md-push-7 {
                left: 58.33333333%
            }

            .col-md-push-6 {
                left: 50%
            }

            .col-md-push-5 {
                left: 41.66666667%
            }

            .col-md-push-4 {
                left: 33.33333333%
            }

            .col-md-push-3 {
                left: 25%
            }

            .col-md-push-2 {
                left: 16.66666667%
            }

            .col-md-push-1 {
                left: 8.33333333%
            }

            .col-md-push-0 {
                left: auto
            }

            .col-md-offset-12 {
                margin-left: 100%
            }

            .col-md-offset-11 {
                margin-left: 91.66666667%
            }

            .col-md-offset-10 {
                margin-left: 83.33333333%
            }

            .col-md-offset-9 {
                margin-left: 75%
            }

            .col-md-offset-8 {
                margin-left: 66.66666667%
            }

            .col-md-offset-7 {
                margin-left: 58.33333333%
            }

            .col-md-offset-6 {
                margin-left: 50%
            }

            .col-md-offset-5 {
                margin-left: 41.66666667%
            }

            .col-md-offset-4 {
                margin-left: 33.33333333%
            }

            .col-md-offset-3 {
                margin-left: 25%
            }

            .col-md-offset-2 {
                margin-left: 16.66666667%
            }

            .col-md-offset-1 {
                margin-left: 8.33333333%
            }

            .col-md-offset-0 {
                margin-left: 0
            }
        }

        @media (min-width:1200px) {

            .col-lg-1,
            .col-lg-10,
            .col-lg-11,
            .col-lg-12,
            .col-lg-2,
            .col-lg-3,
            .col-lg-4,
            .col-lg-5,
            .col-lg-6,
            .col-lg-7,
            .col-lg-8,
            .col-lg-9 {
                float: left
            }

            .col-lg-12 {
                width: 100%
            }

            .col-lg-11 {
                width: 91.66666667%
            }

            .col-lg-10 {
                width: 83.33333333%
            }

            .col-lg-9 {
                width: 75%
            }

            .col-lg-8 {
                width: 66.66666667%
            }

            .col-lg-7 {
                width: 58.33333333%
            }

            .col-lg-6 {
                width: 50%
            }

            .col-lg-5 {
                width: 41.66666667%
            }

            .col-lg-4 {
                width: 33.33333333%
            }

            .col-lg-3 {
                width: 25%
            }

            .col-lg-2 {
                width: 16.66666667%
            }

            .col-lg-1 {
                width: 8.33333333%
            }

            .col-lg-pull-12 {
                right: 100%
            }

            .col-lg-pull-11 {
                right: 91.66666667%
            }

            .col-lg-pull-10 {
                right: 83.33333333%
            }

            .col-lg-pull-9 {
                right: 75%
            }

            .col-lg-pull-8 {
                right: 66.66666667%
            }

            .col-lg-pull-7 {
                right: 58.33333333%
            }

            .col-lg-pull-6 {
                right: 50%
            }

            .col-lg-pull-5 {
                right: 41.66666667%
            }

            .col-lg-pull-4 {
                right: 33.33333333%
            }

            .col-lg-pull-3 {
                right: 25%
            }

            .col-lg-pull-2 {
                right: 16.66666667%
            }

            .col-lg-pull-1 {
                right: 8.33333333%
            }

            .col-lg-pull-0 {
                right: auto
            }

            .col-lg-push-12 {
                left: 100%
            }

            .col-lg-push-11 {
                left: 91.66666667%
            }

            .col-lg-push-10 {
                left: 83.33333333%
            }

            .col-lg-push-9 {
                left: 75%
            }

            .col-lg-push-8 {
                left: 66.66666667%
            }

            .col-lg-push-7 {
                left: 58.33333333%
            }

            .col-lg-push-6 {
                left: 50%
            }

            .col-lg-push-5 {
                left: 41.66666667%
            }

            .col-lg-push-4 {
                left: 33.33333333%
            }

            .col-lg-push-3 {
                left: 25%
            }

            .col-lg-push-2 {
                left: 16.66666667%
            }

            .col-lg-push-1 {
                left: 8.33333333%
            }

            .col-lg-push-0 {
                left: auto
            }

            .col-lg-offset-12 {
                margin-left: 100%
            }

            .col-lg-offset-11 {
                margin-left: 91.66666667%
            }

            .col-lg-offset-10 {
                margin-left: 83.33333333%
            }

            .col-lg-offset-9 {
                margin-left: 75%
            }

            .col-lg-offset-8 {
                margin-left: 66.66666667%
            }

            .col-lg-offset-7 {
                margin-left: 58.33333333%
            }

            .col-lg-offset-6 {
                margin-left: 50%
            }

            .col-lg-offset-5 {
                margin-left: 41.66666667%
            }

            .col-lg-offset-4 {
                margin-left: 33.33333333%
            }

            .col-lg-offset-3 {
                margin-left: 25%
            }

            .col-lg-offset-2 {
                margin-left: 16.66666667%
            }

            .col-lg-offset-1 {
                margin-left: 8.33333333%
            }

            .col-lg-offset-0 {
                margin-left: 0
            }
        }

        table {
            background-color: transparent
        }

        caption {
            padding-top: 8px;
            padding-bottom: 8px;
            color: #777;
            text-align: left
        }

        th {
            text-align: left
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px
        }

        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd
        }

        .table>thead>tr>th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd
        }

        .table>caption+thead>tr:first-child>td,
        .table>caption+thead>tr:first-child>th,
        .table>colgroup+thead>tr:first-child>td,
        .table>colgroup+thead>tr:first-child>th,
        .table>thead:first-child>tr:first-child>td,
        .table>thead:first-child>tr:first-child>th {
            border-top: 0
        }

        .table>tbody+tbody {
            border-top: 2px solid #ddd
        }

        .table .table {
            background-color: #fff
        }

        .table-condensed>tbody>tr>td,
        .table-condensed>tbody>tr>th,
        .table-condensed>tfoot>tr>td,
        .table-condensed>tfoot>tr>th,
        .table-condensed>thead>tr>td,
        .table-condensed>thead>tr>th {
            padding: 5px
        }

        .table-bordered {
            border: 1px solid #ddd
        }

        .table-bordered>tbody>tr>td,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>td,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>thead>tr>th {
            border: 1px solid #ddd
        }

        .table-bordered>thead>tr>td,
        .table-bordered>thead>tr>th {
            border-bottom-width: 2px
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #f9f9f9
        }

        .table-hover>tbody>tr:hover {
            background-color: #f5f5f5
        }

        table col[class*=col-] {
            position: static;
            display: table-column;
            float: none
        }

        table td[class*=col-],
        table th[class*=col-] {
            position: static;
            display: table-cell;
            float: none
        }

        .table>tbody>tr.active>td,
        .table>tbody>tr.active>th,
        .table>tbody>tr>td.active,
        .table>tbody>tr>th.active,
        .table>tfoot>tr.active>td,
        .table>tfoot>tr.active>th,
        .table>tfoot>tr>td.active,
        .table>tfoot>tr>th.active,
        .table>thead>tr.active>td,
        .table>thead>tr.active>th,
        .table>thead>tr>td.active,
        .table>thead>tr>th.active {
            background-color: #f5f5f5
        }

        .table-hover>tbody>tr.active:hover>td,
        .table-hover>tbody>tr.active:hover>th,
        .table-hover>tbody>tr:hover>.active,
        .table-hover>tbody>tr>td.active:hover,
        .table-hover>tbody>tr>th.active:hover {
            background-color: #e8e8e8
        }

        .table>tbody>tr.success>td,
        .table>tbody>tr.success>th,
        .table>tbody>tr>td.success,
        .table>tbody>tr>th.success,
        .table>tfoot>tr.success>td,
        .table>tfoot>tr.success>th,
        .table>tfoot>tr>td.success,
        .table>tfoot>tr>th.success,
        .table>thead>tr.success>td,
        .table>thead>tr.success>th,
        .table>thead>tr>td.success,
        .table>thead>tr>th.success {
            background-color: #dff0d8
        }

        .table-hover>tbody>tr.success:hover>td,
        .table-hover>tbody>tr.success:hover>th,
        .table-hover>tbody>tr:hover>.success,
        .table-hover>tbody>tr>td.success:hover,
        .table-hover>tbody>tr>th.success:hover {
            background-color: #d0e9c6
        }

        .table>tbody>tr.info>td,
        .table>tbody>tr.info>th,
        .table>tbody>tr>td.info,
        .table>tbody>tr>th.info,
        .table>tfoot>tr.info>td,
        .table>tfoot>tr.info>th,
        .table>tfoot>tr>td.info,
        .table>tfoot>tr>th.info,
        .table>thead>tr.info>td,
        .table>thead>tr.info>th,
        .table>thead>tr>td.info,
        .table>thead>tr>th.info {
            background-color: #d9edf7
        }

        .table-hover>tbody>tr.info:hover>td,
        .table-hover>tbody>tr.info:hover>th,
        .table-hover>tbody>tr:hover>.info,
        .table-hover>tbody>tr>td.info:hover,
        .table-hover>tbody>tr>th.info:hover {
            background-color: #c4e3f3
        }

        .table>tbody>tr.warning>td,
        .table>tbody>tr.warning>th,
        .table>tbody>tr>td.warning,
        .table>tbody>tr>th.warning,
        .table>tfoot>tr.warning>td,
        .table>tfoot>tr.warning>th,
        .table>tfoot>tr>td.warning,
        .table>tfoot>tr>th.warning,
        .table>thead>tr.warning>td,
        .table>thead>tr.warning>th,
        .table>thead>tr>td.warning,
        .table>thead>tr>th.warning {
            background-color: #fcf8e3
        }

        .table-hover>tbody>tr.warning:hover>td,
        .table-hover>tbody>tr.warning:hover>th,
        .table-hover>tbody>tr:hover>.warning,
        .table-hover>tbody>tr>td.warning:hover,
        .table-hover>tbody>tr>th.warning:hover {
            background-color: #faf2cc
        }

        .table>tbody>tr.danger>td,
        .table>tbody>tr.danger>th,
        .table>tbody>tr>td.danger,
        .table>tbody>tr>th.danger,
        .table>tfoot>tr.danger>td,
        .table>tfoot>tr.danger>th,
        .table>tfoot>tr>td.danger,
        .table>tfoot>tr>th.danger,
        .table>thead>tr.danger>td,
        .table>thead>tr.danger>th,
        .table>thead>tr>td.danger,
        .table>thead>tr>th.danger {
            background-color: #f2dede
        }

        .table-hover>tbody>tr.danger:hover>td,
        .table-hover>tbody>tr.danger:hover>th,
        .table-hover>tbody>tr:hover>.danger,
        .table-hover>tbody>tr>td.danger:hover,
        .table-hover>tbody>tr>th.danger:hover {
            background-color: #ebcccc
        }

        .table-responsive {
            min-height: .01%;
            overflow-x: auto
        }

        

        .table-hover>tbody>tr.active:hover>td,
        .table-hover>tbody>tr.active:hover>th,
        .table-hover>tbody>tr:hover>.active,
        .table-hover>tbody>tr>td.active:hover,
        .table-hover>tbody>tr>th.active:hover {
            background-color: #e8e8e8
        }

        .table>tbody>tr.success>td,
        .table>tbody>tr.success>th,
        .table>tbody>tr>td.success,
        .table>tbody>tr>th.success,
        .table>tfoot>tr.success>td,
        .table>tfoot>tr.success>th,
        .table>tfoot>tr>td.success,
        .table>tfoot>tr>th.success,
        .table>thead>tr.success>td,
        .table>thead>tr.success>th,
        .table>thead>tr>td.success,
        .table>thead>tr>th.success {
            background-color: #dff0d8
        }

        .table-hover>tbody>tr.success:hover>td,
        .table-hover>tbody>tr.success:hover>th,
        .table-hover>tbody>tr:hover>.success,
        .table-hover>tbody>tr>td.success:hover,
        .table-hover>tbody>tr>th.success:hover {
            background-color: #d0e9c6
        }

        .table>tbody>tr.info>td,
        .table>tbody>tr.info>th,
        .table>tbody>tr>td.info,
        .table>tbody>tr>th.info,
        .table>tfoot>tr.info>td,
        .table>tfoot>tr.info>th,
        .table>tfoot>tr>td.info,
        .table>tfoot>tr>th.info,
        .table>thead>tr.info>td,
        .table>thead>tr.info>th,
        .table>thead>tr>td.info,
        .table>thead>tr>th.info {
            background-color: #d9edf7
        }
        

      .w-100{
          width: 100%;
      }
      .container{
          width:80%;
          margin: auto;
      }
      .btn-info{
        background-color: #5bc0de;
        color: #fff;
      }
      table, tr, td {
  border: none;
  border-collapse:collapse;
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