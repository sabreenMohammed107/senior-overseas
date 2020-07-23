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
            <h2 >
                Total Balance Report
                <p><?php 
                $date = date_create(now());
                echo date_format($date,'Y-m-d')?></p>
                </h2>
                </div>

        </div>
        <!--bank-->
        <table id="bankTable" class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Banks</th>
                    <th scope="col">EGP</th>
                    <th scope="col">USD</th>
                    <th scope="col">EURO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sumEgp = 0;
                $sumUse = 0;
                $sumUre = 0;
                ?>
                @foreach($banksReport as $bank)
                <?php
                $sumEgp = $sumEgp + $bank->bankEgp;
                $sumUse = $sumUse + $bank->bankUsa;
                $sumUre = $sumUre + $bank->bankUre;
                ?>
                <tr>
                    <th scope="row">{{$bank->bank->name}}</th>
                    <td>{{$bank->bankEgp}}</td>
                    <td>{{$bank->bankUsa}}</td>
                    <td>{{$bank->bankUre}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="btn-outline-info">
                <tr>
                    <th>Total</th>
                    <th><?php echo $sumEgp ?></th>
                    <th><?php echo $sumUse ?></th>
                    <th><?php echo $sumUre ?></th>

                </tr>
            </tfoot>
        </table>
        <!--client-->
        <table  class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Clients</th>
                    <th scope="col">EGP</th>
                    <th scope="col">USD</th>
                    <th scope="col">EURO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $clientEgp = 0;
                $clientUse = 0;
                $clientUre = 0;
                ?>
                @foreach($clientsReport as $client)
                <?php
                $clientEgp = $clientEgp + $client->clientEgp;
                $clientUse = $clientUse + $client->clientUsa;
                $clientUre = $clientUre + $client->clientUre;
                ?>
                <tr>
                    <th scope="row">{{$client->client->client_name}}</th>
                    <td>{{$client->clientEgp}}</td>
                    <td>{{$client->clientUsa}}</td>
                    <td>{{$client->clientUre}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="btn-outline-info">
                <tr>
                    <th>Total</th>
                    <th><?php echo $clientEgp ?></th>
                    <th><?php echo $clientUse ?></th>
                    <th><?php echo $clientUre ?></th>

                </tr>
            </tfoot>
        </table>
        <!--cashbox-->
        <table  class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Cash Boxes</th>
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
            @foreach($cashsReport as $cash)
            <?php
            $cashEgp = $cashEgp + $cash->cashEgp;
            $cashUse = $cashUse + $cash->cashUsa;
            $cashUre = $cashUre + $cash->cashUre;
            ?>
            <tr>
                <th scope="row">{{$cash->cash->name}}</th>
                <td>{{$cash->cashEgp}}</td>
                <td>{{$cash->cashUsa}}</td>
                <td>{{$cash->cashUre}}</td>
            </tr>
            @endforeach
            </tbody>
            <tfoot class="btn-outline-info">
                <tr>
                    <th>Total</th>
                    <th><?php echo $cashEgp ?></th>
                    <th><?php echo $cashUse ?></th>
                    <th><?php echo $cashUre ?></th>

                </tr>
            </tfoot>
        </table>
        <!--supplier-->
        <table  class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Suppliers</th>
                    <th scope="col">EGP</th>
                    <th scope="col">USD</th>
                    <th scope="col">EURO</th>
                </tr>
            </thead>
            <?php
            $supplierEgp = $sumSuppliersEgp;
            $supplierUse = $sumSuppliersUse;
            $supplierUre = $sumSuppliersUre;
            ?>
            <tbody>

            </tbody>

            <tfoot class="btn-outline-info">
                <tr>
                    <th>Total</th>
                    <th><?php echo $supplierEgp ?></th>
                    <th><?php echo $supplierUse ?></th>
                    <th><?php echo $supplierUre ?></th>

                </tr>
            </tfoot>
        </table>
<hr>
        
    </div>
    <table  class="dattable table table-striped thead-dark  w-100">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Totals</th>
                    <th scope="col">EGP</th>
                    <th scope="col">USD</th>
                    <th scope="col">EURO</th>
                </tr>
            </thead>
            <?php
            $summingEgp = ($cashEgp + $sumEgp + $clientEgp) - $sumSuppliersEgp;
            $summingUse = ($cashUse + $sumUse + $clientUse) - $sumSuppliersUse;
            $summingUre = ($cashUre + $sumUre + $clientUre) - $sumSuppliersUre;
            ?>
            <tbody>

            </tbody>

            <tfoot class="btn-outline-info">
                <tr>
                    <th>Totals</th>
                    <th><?php echo $summingEgp ?></th>
                    <th><?php echo $summingUse ?></th>
                    <th><?php echo $summingUre ?></th>

                </tr>
            </tfoot>
        </table>
<footer style="height: 100px;">

</footer>
</body>

</html>