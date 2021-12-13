<meta id="_token" value="{{csrf_token()}}">
<style>
    .padding {
        padding: 0px 70px;
        color: #ffffff;
    }
</style>
<script href="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="css/style.css" rel="stylesheet" id="bootstrap-css">
<script href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<!------ Include the above in your HEAD tag ---------->

<div class="container-fluid" id='app'>
    <div class="row">
        <div class="col-lg-12 mail-box">
            <aside class="sm-side">
                <div class="user-head">
                    <a class="inbox-avatar" href="javascript:;">
                        <img width="64" hieght="60"
                            src="http://bootsnipp.com/img/avatars/ebeb306fd7ec11ab68cbcaa34282158bd80361a7.jpg">
                    </a>
                    <div class="user-name">
                        @if(Auth::check())
                        <h5><a href="#">{{ Auth::user()->name }}</a></h5>
                        <span><a href="#">{{ Auth::user()->email }}</a></span>
                        @endif
                        </br>
                        <span><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}

                            </a>
                            <i class="fas fa-sign-out-alt"></i>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </span>
                    </div>
                    <a class="mail-dropdown pull-right" href="javascript:;">
                        <i class="fa fa-chevron-down"></i>
                    </a>
                </div>

                <ul class="inbox-nav inbox-divider">


                    <li class="active">

                    </li>
                    <li class="active">

                    </li>
                    <li class="active">

                    </li>


                </ul>
                <!-- <router-view></router-view> -->




            </aside>
            <aside class="lg-side">
                <div class="inbox-head">
                    <h1 class="justify-content-center">Real Time chat App</h1>
                    <router-link to="/addroom" class="padding">
                        <i class="fa fa-plus"></i> Add Room
                    </router-link>
                    <router-link to="/myrooms" class="padding">
                        <i class="fa fa-user"></i> My Rooms
                    </router-link>
                    <router-link to="/allrooms" class="padding">
                        <i class="fa fa-users"></i> All Rooms
                        <!--<span class="label label-danger pull-right">2</span>-->
                    </router-link>
                </div>
                <div class="inbox-body">

                    @yield('content')
                </div>
            </aside>
        </div>
    </div>
</div>
<script src="{{asset('js/index.js')}}"></script>