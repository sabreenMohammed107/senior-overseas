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
                    Income List Report

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
        <table id="bankTable" class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Sales</th>
                    <th scope="col">EGP</th>
                    <th scope="col">USD</th>
                    <th scope="col">EURO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sellEgp = $sellExpensesEgp;
                $sellUse = $sellExpensesUse;
                $sellUre = $sellExpensesUre;
                ?>
                <tr>
                    <th scope="row">Total </th>
                    <td><?php echo $sellEgp ?></td>
                    <td><?php echo $sellUse ?></td>
                    <td><?php echo $sellUre ?></td>
                </tr>
            </tbody>
            <tfoot class="btn-outline-info">
                <tr>
                    <th>Net sales </th>
                    <th><?php echo $sellEgp ?></th>
                    <th><?php echo $sellUse ?></th>
                    <th><?php echo $sellUre ?></th>

                </tr>
            </tfoot>
        </table>
        <!--client-->
        <table class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Purchasing</th>
                    <th scope="col">EGP</th>
                    <th scope="col">USD</th>
                    <th scope="col">EURO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $buyEgp = $buyExpensesEgp;
                $buyUse = $buyExpensesUse;
                $buyUre = $buyExpensesUre;
                ?>
                <tr>
                    <th scope="row">Total </th>
                    <td><?php echo $buyEgp ?></td>
                    <td><?php echo $buyUse ?></td>
                    <td><?php echo $buyUre ?></td>
                </tr>
            </tbody>
            <tfoot class="btn-outline-danger">
                <tr>
                    <th>Net Purchasing</th>
                    <th><?php echo $buyEgp ?></th>
                    <th><?php echo $buyUse ?></th>
                    <th><?php echo $buyUre ?></th>

                </tr>
            </tfoot>
        </table>

        <table class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark" style="display: none;">
                <tr>
                    <th scope="col">Net Profit</th>
                    <th scope="col">EGP</th>
                    <th scope="col">USD</th>
                    <th scope="col">EURO</th>
                </tr>
            </thead>
            <?php

            $summingEgp = $sellEgp  - $buyEgp;
            $summingUse = $sellUse - $buyUse;
            $summingUre = $sellUre  - $buyUre;
            ?>
            <tbody>

            </tbody>

            <tfoot class="btn-info">
                <tr>
                    <th style="width: 25%;">Net Profit</th>
                    <th><?php echo $summingEgp ?></th>
                    <th><?php echo $summingUse ?></th>
                    <th><?php echo $summingUre ?></th>

                </tr>
            </tfoot>
        </table>
        <!--cashbox-->

        <table class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Expenses</th>
                    <th scope="col">EGP</th>
                    <th scope="col">USD</th>
                    <th scope="col">EURO</th>
                </tr>
            </thead>
            <?php
            $cashEgp = 0;
            $cashUse = 0;
            $cashUre = 0;
            ?>
            @foreach($extraExpense as $extra)
            <?php

            $gyp = App\Models\Financial_entry::where('trans_type_id', $extra->id)->where('currency_id', 2)->sum('credit');
            $use = App\Models\Financial_entry::where('trans_type_id', $extra->id)->where('currency_id', 1)->sum('credit');
            $ure = App\Models\Financial_entry::where('trans_type_id', $extra->id)->where('currency_id', 3)->sum('credit');
            $cashEgp = $cashEgp + $gyp;
            $cashUse = $cashUse + $use;
            $cashUre = $cashUre + $ure;
            ?>

            <tr>
                <th scope="row">{{$extra->expenses_name}}</th>
                <td>{{$gyp}}</td>
                <td>{{$use}}</td>
                <td>{{$ure}}</td>
            </tr>

            </tbody>
            @endforeach
            <tfoot class="btn-outline-danger">
                <tr>
                    <th>Total Expenses</th>
                    <th><?php echo $cashEgp ?></th>
                    <th><?php echo $cashUse ?></th>
                    <th><?php echo $cashUre ?></th>

                </tr>
            </tfoot>
        </table>

        <hr>

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


        $summingEgpF = $summingEgp - $cashEgp;
        $summingUseF = $summingUse - $cashUse;
        $summingUreF = $summingUre - $cashUre;
        ?>
        <tbody>

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
    <footer style="height: 100px;">

    </footer>
</body>

</html>