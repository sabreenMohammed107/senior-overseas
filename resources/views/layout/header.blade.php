    <!-- navar -->
    <nav class="navbar ms-navbar">
      <div class="ms-aside-toggler ms-toggler pl-0" data-target="#ms-side-nav" data-toggle="slideLeft">
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
      </div>
      <div class="logo-sn logo-sm ms-d-block-sm">
        <a class="pl-0 ml-0 text-center navbar-brand mr-0" href="">
          <img src="{{ asset('adminasset/img/logo.png')}}" alt="logo"> </a>
      </div>
      <ul class="ms-nav-list ms-inline mb-0" id="ms-nav-options">
        </li>
        <li class="ms-nav-item ms-nav-user dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            Notification ({{ count(Auth::user()->Notifications) }})<span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(count(Auth::user()->notifications) > 0)
                                    @foreach (Auth::user()->notifications as $row)

                                    @if ($row->read_at == NULL)
                                    <a class="dropdown-item" href="" style="background-color:#ddd">
                                        <span>
                                          
                                        {{$row->data['title']}}
                                        <p style="font-size: 10px;">Code :{{ $row->data['code'] }}</p>
                                        <p style="font-size: 10px;">Loading Date :{{ $row->data['loading_date'] }}</p>
                                    </a>
                                    @else
                                    <a class="dropdown-item" href="">
                                        <span>
                                      </span>
                                        {{$row->data['title']}}
                                       
                                        <p style="font-size: 10px;">Code :{{ $row->data['code'] }}</p>
                                        <p style="font-size: 10px;">Loading Date :{{ $row->data['loading_date'] }}</p>
                                    </a>
                                    @endif

                                    
                                    @endforeach
                                    
                                    @else
                                    <span>No Found Notifications</span>
                                    @endif

                                </div>

        </li>
        <li class="ms-nav-item ms-nav-user dropdown">
          <a href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="ms-user-img ms-img-round float-left" src="https://via.placeholder.com/270x270" alt="people">
            <span class="float-right">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="userDropdown">
            <li class="dropdown-menu-header">
              <h6 class="dropdown-header ms-inline m-0"><span class="text-disabled">Welcome, {{ Auth::user()->name }}</span></h6>
            </li>
            <li class="dropdown-divider"></li>
            @if (Auth::user()->role_id==1)
            <li class="ms-dropdown-list">

              <a class="media fs-14 p-2" href="{{ url('registerTest') }}"> <span><i class="flaticon-user mr-2"></i>Create New User</span>
                <a class="media fs-14 p-2" href="{{ route('usersList.index') }}"> <span><i class="flaticon-user mr-2"></i>Users-List</span>
                </a>

            </li>
            <li class="dropdown-divider"></li>
            @endif


            <li class="ms-dropdown-list">

              <a class="media fs-14 p-2" href="{{ url('resetPassword/'.Auth::user()->id) }}"> <span><i class="flaticon-alert
 mr-2"></i>Reset Password</span>
              </a>

            </li>


            <li class="dropdown-menu-footer">
              <a class="media fs-14 p-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <span><i class="flaticon-shut-down mr-2"></i> Logout</span>
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>

            </li>
          </ul>
        </li>




      </ul>
      <div class="ms-toggler ms-d-block-sm pr-0 ms-nav-toggler" data-toggle="slideDown" data-target="#ms-nav-options">
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
      </div>
    </nav>
    <!-- /navar -->