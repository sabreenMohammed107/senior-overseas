<div class="ms-auth-container row">
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Invoice Date</label>
            <input type="date" name="invoice_date" class="form-control" placeholder="Invoice Date">
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Client ( Shipper )</label>
            <input type="text" class="form-control" value="{{$selected->sale->client->client_name ?? 'Client ( Shipper )' }}" placeholder="Client ( Shipper )" readonly>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Client Address</label>
            <input type="text" class="form-control" value="{{$selected->sale->client->address ?? 'Client ( Shipper )' }}" placeholder="Client ( Shipper )" readonly>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Sale Person</label>
            <input type="text" class="form-control" value="{{$selected->sale->employee->employee_name ?? 'Sale person' }}" placeholder="Client ( Shipper )" readonly>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Operation Date</label>
            <?php $date = new dateTime;
            if (isset($selected)) {
                $date = date_create($selected->operation_date);
            }
            ?>

            <input type="date" name="operation_date" value="{{ date_format($date,'Y-m-d') }}" readonly class="form-control" placeholder="Operation Code">
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Import Export</label>
            <select class="form-control" name="import_export_flag" data-live-search="true" disabled>

                <option>Select ...</option>
                @isset($selected)
                <option value='1' {{ 1 ==$selected->import_export_flag ? 'selected' : '' }}>Import</option>
                <option value='2' {{ 2 == $selected->import_export_flag ? 'selected' : '' }}>Export</option>
                @endisset


            </select>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">POL</label>
            <input type="text" class="form-control" value="{{$selected->ocean->ocean->pol->port_name ?? 'Pol' }}" placeholder="Pol" readonly>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Pod</label>
            <input type="text" class="form-control" value="{{$selected->ocean->ocean->pod->port_name ?? 'Pol' }}" placeholder="Pol" readonly>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">AOL</label>
            <input type="text" class="form-control" value="{{$selected->air->air->aol->port_name ?? 'Aol' }}" placeholder="Aol" readonly>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Aod</label>
            <input type="text" class="form-control" value="{{$selected->air->air->aod->port_name ?? 'Aod' }}" placeholder="Aod" readonly>
        </div>
    </div>
</div>

<div style="border-bottom:solid #0094ff 2px;">
    <h2>Operations Data</h2>
</div><br />
<div class="ms-auth-container row">
    <div class="col-md-6 mb-3">
        <div class="ui-widget form-group">
            <label>Consignee</label>

            <input type="text" class="form-control" value="{{$selected->consignee->client_name ?? 'client_name' }}" placeholder="Client ( Shipper )" readonly>

        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Containers Counts</label>
            <input type="text" class="form-control" readonly value="{{$selected->container_counts ?? 'Containers Counts' }}" placeholder="Containers Counts">
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Container/s Names</label>
            <input type="text" class="form-control" readonly placeholder="Container/s Names" value="{{$selected->container_name ?? 'Container/s Names' }}">
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Loading Date</label>

            <?php $date2 = new dateTime;
            if (isset($selected)) {
                $date2 = date_create($selected->loading_date);
            }
            ?>

            <input type="date" name="loading_date" value="{{ date_format($date2,'Y-m-d') }}" readonly class="form-control" placeholder="Operation Code">
        </div>
    </div>
</div>

<div style="border-bottom:solid #0094ff 2px;">
    <h2>Policy Data</h2>
</div><br />
<div class="ms-auth-container row">
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">PL No</label>
            <input type="text" class="form-control" readonly placeholder="PL No" value="{{$selected->pl_no ?? 'PL No' }}">
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Vassel Name</label>
            <input type="text" class="form-control" placeholder="Vassel Name" readonly placeholder="PL No" value="{{$selected->vassel_name ?? 'Vassel Name' }}">
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Booking No</label>
            <input type="text" class="form-control" placeholder="Booking No" readonly placeholder="PL No" value="{{$selected->booking_no ?? 'Booking No' }}">
        </div>
    </div>    <div class="col-md-6 mb-3">
</div>
    <div class="col-md-6 mb-3">
        <div class="form-group">
            <label class="exampleInputPassword1" for="exampleCheck1">Invoice Note</label>
           <textarea name="invoice_note" class="form-control" rows="3"></textarea>
        </div>
    </div>
</div>
<!--
                              table of expenses
                          -->
<div class="ms-panel">
    <div class="ms-panel-header d-flex justify-content-between">
        <h6>Expenses Data</h6>
        <!-- <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#addSubCat"> add new </a> -->
    </div>
    <div class="ms-panel-body">

        <div class="table-responsive">
            <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Expense Type</th>
                        
                        <th>Sell</th>
                        <th>Expense provider</th>
                        <th>Currency</th>
                      
                    </tr>
                </thead>
                <tbody>


                    @foreach($expenses as $index => $expense)
                    <tr>
                        <td>{{$index+1}}</td>

                        
                        <td>@if($expense->type)
                            {{$expense->type->expense_name}}
                            @endif
                        </td>
                       
                        <td>{{$expense->sell}}</td>
                        <td>@if($expense->provider)
                            {{$expense->provider->provider_type}}
                            @endif</td>
                        <td>@if($expense->currency)
                            {{$expense->currency->currency_name}}
                            @endif</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="input-group d-flex justify-content-end text-center">
    <a href="{{ route('invoice.index') }}" class="btn btn-dark mx-2"> Cancel</a>
    <!-- <input type="button" value="Cancel" class="btn btn-dark mx-2" data-dismiss="modal" aria-label="Close"> -->
    <input type="submit" value="Add" class="btn btn-success ">
</div>
</form>
</div>