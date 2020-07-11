@extends('layout.main')

@section('crumb')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href=""><i class="material-icons"></i> {{ __(' Home') }} </a></li>
    </ol>
</nav>

@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header d-flex justify-content-between">
                <h6>Acount Statment</h6>
                <!-- <a href="add_cource.html" class="btn btn-dark" > add Course </a> -->
            </div>
            <div class="ms-panel-body">
                <div class="ms-auth-container row no-gutters">
                    <div class="col-12 p-3">
                        <form id="target" action="javascript:void(0)" method="post">

                            <input type="hidden" value="{{csrf_token()}}" id="catToken" />

                            <div class="ms-auth-container row">
<style>
    .hides{
        display: none;
    }
</style>

                            <div class="col-md-12 mb-3">
                            <div style="margin-bottom:25px">
						<div style="border-bottom:solid 2px #0094ff;width:560px;margin: 0 20px;">
							<input type="radio" style="margin: 0 20px;" name="tab" value="bank_account_id_tab" onclick="show1();" checked /> Bank Statment
							<input type="radio" style="margin: 0 20px;" name="tab" value="cash_box_id_tab" onclick="show2();" clicked="clicked" /> Cash Box Statment
						</div>

                    </div>
                            </div>

                            <div  id="div2" class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Banks</label>
                                        <select id="bank_account_id"  name="bank_account_id" class=" form-control" data-show-subtext="true" data-live-search="true">

                                        <option value="">Select ...</option>
                                            @foreach ($banks as $type)
                                            <option value='{{$type->id}}'>
                                                {{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div  id="div1" class="col-md-6 mb-3 hides">
                                    <div class="ui-widget form-group">
                                        <label>Cash Box</label>
                                        <select id="cash_box_id"  name="cash_box_id" class=" form-control" data-show-subtext="true" data-live-search="true">
                                        <option value="">Select ...</option>
                                            @foreach ($cashs as $type)
                                            <option value='{{$type->id}}'>
                                                {{$type->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">From Date</label>
                                        <input name="from_date" id="from_date" type="date" class="form-control" placeholder="date">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="exampleInputPassword1" for="exampleCheck1">To Date</label>
                                        <input name="to_date" id="to_date" type="date" class="form-control" placeholder="date">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="ui-widget form-group">
                                        <label>Currency</label>
                                        <select name="currency_id" id="currency_id" required class=" form-control" >
                                            <option value="">Select ...</option>
                                            @foreach ($currencies as $type)
                                            <option value='{{$type->id}}'>
                                                {{$type->currency_name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    
                                <span id="currencyrror" style="color:red;background:#ccc;text-align:center;margin-top:40px;display:none">You Must Select Currency  </span>
                                </div>
                            </div>
                            <input type="submit" id="search_button" value="Search" class="btn btn-success ">
                        </form>

                        <div class="ms-panel-header d-flex justify-content-between"></div>

                        <br>

                        <div id="main">

                            @include('account-statment.bank-cash-search')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')



<script type="text/javascript">
function show1() {
	
    document.getElementById('div1').style.display = 'none';
    document.getElementById('div2').style.display = 'block';
}

function show2() {

    document.getElementById('div2').style.display = 'none';
    document.getElementById('div1').style.display = 'block';
}

   
    $(document).ready(function() {
        $("input[type=radio][name=tab]").change(function(){
           $('#cash_box_id').val('');
                $('#bank_account_id').val('');
                $('#currency_id').val('');
               $('#to_date').val('');
                $('#from_date').val('');
});
        $('#search_button').click(function() {
            event.preventDefault();
            var OR = document.getElementById("currency_id").value;
           
            if (OR == '' ) {
                $('#currencyrror').css('display', 'block');
            } else {
                $('#currencyrror').css('display', 'none');
                $("#target").submit();
                var token = $("#catToken").val();
               var cash_box_id=$('#cash_box_id').val();
                var bank_account_id=$('#bank_account_id').val();
                var currency_id=$('#currency_id').val();
                var to=$('#to_date').val();
                var from=$('#from_date').val();
              
                $.ajax({
                    type: 'POST',
                    url: "{{route('bank-cash-statment.store')}}",
                    data: {
                        _token: token,
                        cash_box_id: cash_box_id,
                        bank_account_id: bank_account_id,
                        currency_id: currency_id,
                        to: to,
                        from: from,
                    },
                    success: function(result) {

                        $('#main').html(result);
                        //datatable
                        $('#bankTable').DataTable({
                            "destroy": true,
                            paging: false,
                            "footerCallback": function(row, data, start, end, display) {
                                var api = this.api(),
                                    data;

                                // Remove the formatting to get integer data for summation
                                var intVal = function(i) {
                                    return typeof i === 'string' ?
                                        i.replace(/[\$,]/g, '') * 1 :
                                        typeof i === 'number' ?
                                        i : 0;
                                };

                                // Total over all pages
                                total = api
                                    .column(4)
                                    .data()
                                    .reduce(function(a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);

                                // Total over this page
                                pageTotal = api
                                    .column(3)
                                    .data()
                                    .reduce(function(a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);
                                // Update footer
                                $(api.column(0).footer()).html('Sum = ');
                                $(api.column(3).footer()).html(pageTotal);
                                $(api.column(4).footer()).html(total);
                                // Update footer

                            }
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert('error');

                    }
                });
            }

        });
 




    });
</script>
@endsection