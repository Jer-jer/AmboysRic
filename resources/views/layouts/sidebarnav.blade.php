<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <title>{{ __("Amboy's RIC") }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sidebarnav.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>

<body id="body-pd">
    @if(Auth::user()->status == 'SUSPENDED' || Auth::user()->status == 'FIRED')
    @include('modals.auth.status_error')
    <script>
        $(function() {
            $('#status_error').modal('show')
        });
    </script>
    @endif
    <link href="{{ asset('css/sidebarnav.css') }}" rel="stylesheet">
    <header class="header" id="header">
        <div class="header_toggle menu"> <i class='fas fa-bars' id="header-toggle"></i> </div>
        <div class="nav_credentials title"> {{ Auth::user()->position }} </div>
        <div class="nav_credentials"> {{ Auth::user()->name }} </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="{{ route('inventory') }}" class="nav_logo">
                    <img src="{{ asset('images/taco1nobg.png') }}" class="logo" width="30" height="30">
                    <span class="nav_logo-name">Amboy's RIC System</span>
                </a>
                <div class="nav_list">
                    <a href="{{ route('inventory') }}" class="nav_link {{ (request()->is('/')) ? 'active' : '' }}">
                        <i class="fas fa-hamburger nav_icon"></i>
                        <span class="nav_name">Inventory</span>
                    </a>
                    <a href="{{ route('shopping_cart') }}" class="nav_link {{ (request()->is('shopping_cart')) ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart nav_icon"></i>
                        <span class="nav_name">Orders</span>
                    </a>
                    @if ( Auth::user()->position == 'MANAGER')
                    <a href="{{ route('employees') }}" class="nav_link {{ (request()->is('employees')) ? 'active' : '' }}">
                        <i class="fas fa-users nav_icon"></i>
                        <span class="nav_name">Employees</span>
                    </a>
                    @else
                    <button class="nav_link button" data-toggle="modal" data-target="#checkAdmin">
                        <i class="fas fa-users nav_icon"></i>
                        <span class="nav_name">Employees</span>
                    </button>
                    @endif
                </div>
            </div>
            <div>
                <a class="nav_link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt nav_icon"></i>
                    <span class="nav_name">Sign Out</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="content height-100">
        @yield('content')
    </div>
    @include('modals.auth.admin_check')
    @include('modals.wrong_password_admin')
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
    <script>
        $(function() {
            $('#wrongPass').modal('show');
        });
    </script>
    @endif
    <!--Container Main end-->

    <!-- <script>
        $(document).ready(function() {
            $(".nav_link").click(function(event) {
                event.preventDefault();
                $('.content').load($(this).attr('href'));
            });
        });
    </script> -->
</body>

</html>