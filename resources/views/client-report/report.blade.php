
            <div class="table-responsive">
                <table id="courseEval" class="dattable table table-striped thead-dark  w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Depit</th>
                            <th>Credit</th>
                            <th>Transaction Data</th>
                            <th>Currency</th>
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
 
                        </tr>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
   