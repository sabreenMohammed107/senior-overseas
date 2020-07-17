<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Report</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        body,
        html {
            font-family: "Helvetica", "Arial";
            font-size: 12px;
            padding: 0;
            margin: 0;
            width: 100%;
            height: 100%;
        }

        .body {
            width: 100%;
            background-color: blue;
            margin: 50px 0 50px 0;
        }

        .header,
        .footer {
            width: 100%;
            height: 50px;
            position: fixed;
        }

        .header {
            top: 0;
            background-color: #ccc;
        }

        .content {
            margin: 200px 100px;


        }

        .footer {
            bottom: 0;
            background-color: green;
        }

        .header img {
            float: right;
        }

        .header h2 {

            display: inline;
            margin: 20px;
            color: #4682B4;
        }

        .formData {
            margin-bottom: 100px;
        }
        .form_in{
            display: inline-block;
            width: 50%;
        }
    </style>
</head>



<body>

    <header id="pageHeader" class="header">
        <h2>Over Seas Egypt</h2>
        <img src="{{ asset('adminasset/img/logo.png')}}" alt="logo" width="150" height="100" />
    </header>
    <br />

    <div class="content">
        <div class="formData">
            <div style="width: 100%;">
            <div class="form_in">
                <span>Date :</span>
                <span>{{$invoice->invoice_date}}</span>
            </div>
            <div class="form_in">
                <span>BL NO :</span>
                <span>{{$invoice->operation->pl_no}}</span>
            </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Postal Code</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>CustomerName</td>
                        <td>Address</td>
                        <td>City</td>
                        <td>PostalCode</td>
                        <td>Country </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</body>

</html>