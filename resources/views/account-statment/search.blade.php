  <!--Extra Data-->
  <div class="ms-auth-container row">
      <div class="col-md-6 mb-3">
          <div class="form-group">
              <label class="exampleInputPassword1" for="exampleCheck1">Current Balance</label>
              <input  type="text" class="form-control" readonly value="{{$current_balance}}" placeholder="Current Balance">
          </div>
      </div>
  </div>
  <div class="table-responsive">
      <table id="ticketTable" class="dattable table table-striped thead-dark  w-100">
          <thead>
              <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Debit</th>
                  <th>Credit</th>
                  <th>Transaction Data</th>
                  <th>Operation Code</th>
                  <th>Notes</th>


              </tr>
          </thead>
          <tbody>

              @foreach($filtters as $index => $row)
              <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$row->id}}</td>
                  <td>{{$row->depit}}</td>
                  <td>{{$row->credit}}</td>
                  <td> <?php $date = date_create($row->entry_date) ?>
                      {{ date_format($date,'Y-m-d') }}</td>

                      <td>@if($row->operation)
                          {{$row->operation->operation_code}}
                          @endif
                      </td>
                      <td>{{$row->notes}}</td>
              </tr>
              @endforeach

          </tbody>
          <tfoot>
              <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
              </tr>
          </tfoot>

      </table>
  </div>