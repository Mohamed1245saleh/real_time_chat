<meta id="_token" value="{{csrf_token()}}">
<meta name="authenticatedUser" content="{{ Auth::user() }}">
<style>
    .padding {
        padding: 0px 70px;
        color: #ffffff;
    }
</style>
<script href="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

<link href="css/style.css" rel="stylesheet" id="bootstrap-css">
<script href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<!------ Include the above in your HEAD tag ---------->

<div class="container-fluid" id='app'>
    <div class="mail-box">

        <aside class="lg-side">
            <div class="row inbox-head">
                <div class="col-lg-2 user-head user-Background-color">
                    <!-- <div class="sm-side"> -->
                    <div style="display:inline-block;">
                        <a class="inbox-avatar" href="javascript:;">
                            <router-link to="/profile"> <img width="64" hieght="60"
                                    src="http://bootsnipp.com/img/avatars/ebeb306fd7ec11ab68cbcaa34282158bd80361a7.jpg">
                            </router-link>
                        </a>
                        <div class="user-name pull-right">
                            @if(Auth::check())
                            <h5>
                                {{ Auth::user()->name }}
                            </h5>
                            <span><a href="#">{{ Auth::user()->email }}</a></span>
                            @endif
                            </br>
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

                    </div>
                    <!-- </div> -->

                </div>
                <div class="col-lg-10">
                    <div>
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
                </div>
            </div>


            <div class="inbox-body">

                @yield('content')
            </div>
        </aside>
    </div>
</div>
<script src="{{asset('js/index.js')}}"></script>