
            <div class="row">
                        <div class="col-lg-12 col-sm-12 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    @foreach($curs as $cur)

                                    <tr>
                                        <td class="left">
                                            <strong>total - {{$cur}}</strong>
                                        </td>
                                        @foreach($totals as $total)
                                        @if($total->cur===$cur)
                                        <td class="right"> {{" " . number_format($total->num, 2, '.', ',')  }} <br> {{$total->total}}</td>
                                        @endif
                                        @endforeach
                                    </tr>


                                    @endforeach

                                </tbody>
                            </table>

                        </div>

                    </div>
           
           <div class="table-responsive">
                <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Transaction Date</th>
                            <th>Currency</th>
                            <th>Transaction Type</th>
                            <th>Operation code</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($filtters as $index => $Report)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$Report->depit}}</td>
                            <td>{{$Report->credit}}</td>
                            <td> <?php $date = date_create($Report->entry_date) ?>
                                {{ date_format($date,'Y-m-d') }}</td>

                                <td>@if($Report->currency){{$Report->currency->currency_name}}@endif</td>
                                <td>@if($Report->type){{$Report->type->trans_type}}@endif</td>
                                <td>@if($Report->operation){{$Report->operation->operation_code}}@endif</td>
                        </tr>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
   