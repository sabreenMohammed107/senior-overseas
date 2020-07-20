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
<div class="col-xl-12 col-md-12">
                  <div class="ms-panel ms-panel-fh" style="overflow:scroll; height:400px;">
                      <div class="ms-panel-header">
                          <h6>Overseas Timeline</h6>
                      </div>
                      <div class="ms-panel-body">
                          <ul class="ms-activity-log">
                              @foreach (Auth::user()->unreadNotifications as $Notification)
                                  <li>
                                  <div class="ms-btn-icon btn-pill icon btn-success">
                                      <a href="{{url('notifications/'.$Notification->id)}}"><i class="flaticon-tick-inside-circle"></i></a>
                                  </div>
                                  <h6>Submitting task</h6>
                                  <span> <i class="material-icons">event</i>{{ Carbon\Carbon::parse($Notification->created_at)->diffForHumans()}}</span>
                                  @if ($Notification->read_at == NULL)
                                  <div class="fs-14"> <a class="dropdown-item" href="{{url('notifications/'.$Notification->id)}}" style="background-color:#ddd;border:1px solid #ddd">
                                        <span>
                                       
                                        {{$Notification->data['title']}}
                                        <p style="font-size: 10px;">Code :{{ $Notification->data['operation_code'] }}</p>
                                        <p style="font-size: 10px;"><span><strong> Loading Date :</strong>{{ $Notification->data['loading_date'] }}</span>
                                        <span><strong> Arrival Date :</strong>{{ $Notification->data['arrival_date'] }}</span><span>
                                        <strong> Cut Off Date :</strong>{{ $Notification->data['cut_off_date'] }}
                                        </span></p>
                                    </a></div>
                                    @else  
                                    <div class="fs-14" style="background-color: #FFF;"> <a class="dropdown-item" href="{{url('notifications/'.$Notification->id)}}" style="background-color:#FFF;border:1px solid #ddd">
                                        <span>
                                       
                                        {{$Notification->data['title']}}
                                        <p style="font-size: 10px;">Code :{{ $Notification->data['operation_code'] }}</p>
                                        <p style="font-size: 10px;"><span><strong> Loading Date :</strong>{{ $Notification->data['loading_date'] }}</span>
                                        <span><strong> Arrival Date :</strong>{{ $Notification->data['arrival_date'] }}</span><span>
                                        <strong> Cut Off Date :</strong>{{ $Notification->data['cut_off_date'] }}
                                        </span></p>
                                    </a></div>
                                    @endif
                              </li>
                              @endforeach

                             
                           
                          </ul>
                      </div>
                  </div>
              </div>
        </div>
     


</div>
@endsection