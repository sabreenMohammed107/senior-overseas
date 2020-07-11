<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <!-- <title>{{ $title }}</title> -->
</head>
<style>
    .page-break {
        page-break-after: always;
    }
</style>
<h1>Page 1</h1>
<div class="page-break"></div>
<h1>Page 2</h1>

<body>
    <!-- <h1>{{ $heading}}</h1> -->
    <h1>Customer List</h1>

    <table width="100%" style="width:100%" border="0">
        <thead>
            <tr>
              
                <th>Expense Type</th>
                <th>Buy</th>
                <th>Sale</th>
                <th>Expense provider</th>
                <th>Currency</th>
            </tr>
        </thead>
        <tbody>

            @foreach($rows as $index => $row)
            <tr style="height:20px;background:#CCC">
              

                <td>{{$row->operation_code}}</td>
               

            </tr>
            <?php
            $expenses = App\Models\Operation_expense::where('operation_id', '=', $row->id)->orderBy("id", "Desc")->get();
            ?>

            </tr>
        
        <tbody border="1">

            @foreach($expenses as $index => $expense)
            <tr>
              
                <td>@if($expense->type)
                    {{$expense->type->expense_name}}
                    @endif
                </td>
                <td>{{$expense->buy}}</td>
                <td>{{$expense->sell}}</td>
                <td>@if($expense->provider)
                    {{$expense->provider->provider_type}}
                    @endif</td>
                <td>@if($expense->currency)
                    {{$expense->currency->currency_name}}
                    @endif</td>

                @endforeach
        </tbody>
        @endforeach

        </tbody>
    </table>

</body>

</html>