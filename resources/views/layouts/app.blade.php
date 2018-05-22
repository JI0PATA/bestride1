<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bestride') }}</title>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <link rel="stylesheet" href="{{ asset('js/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/jquery-ui/jquery-ui.structure.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/jquery-ui/jquery-ui.theme.min.css') }}">

    @stack('styles')
</head>
<body>
@if(session()->has('popup_msg'))
    {!! session()->get('popup_msg')!!}
@endif

<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('index') }}"><img src="{{ asset('img/BestRide_logo.png') }}" alt="BestRide Logo"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-left">
                <h2 class="h4">Find your ride</h2>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <select class="form-control">
                    <option>Registration date</option>
                    <option>Lower Price</option>
                    <option>Highest Price</option>
                </select>
                <button type="submit" class="btn btn-default">Search</button>
            </form>

            @guest
                <form class="navbar-right" action="{{ route('login') }}" method="POSt">
                    @csrf
                    <div class="heading-links">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="login" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Login
                                </a>

                                <ul class="dropdown-menu dropdown-login">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="E-mail" name="email">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                    <button type="submit" class="btn btn-default">OK</button>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('register') }}" class="btn">Register</a>
                            </li>
                        </ul>

                    </div>
                </form>
            @else
                <form class="navbar-right">
                    <div class="heading-links pull-left">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <img class="img-circle" src="{{ asset('img/avatars/'.Auth::user()->avatar) }}" style="width: 40px; height: 40px;" alt="Avatar" />
                                    {{ Auth::user()->name }} Age: {{ getAge(Auth::user()->birthdate) }}<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('profile.index') }}">Manage Rides</a></li>
                                    <li><a href="#" onclick="event.preventDefault(); $('#logout').submit();">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </form>
                <form action="{{ route('logout') }}" method="POST" id="logout" style="display: none;">
                    @csrf
                </form>
            @endguest
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

@yield('content')

<footer class="footer">
    <div class="container">© BestRide 2017</div>
</footer>

<script src="{{ asset('js/jquery-3.2.1.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/ClassValidation.js') }}"></script>

@stack('scripts')
</body>
</html>
