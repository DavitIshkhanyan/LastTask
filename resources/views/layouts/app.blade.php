<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Global stylesheets -->
{{--    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">--}}
{{--    <link href="/assets/global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">--}}
{{--    <link href="/assets/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">--}}
{{--    <link href="/assets/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">--}}
{{--    <link href="/assets/assets/css/layout.min.css" rel="stylesheet" type="text/css">--}}
{{--    <link href="/assets/assets/css/components.min.css" rel="stylesheet" type="text/css">--}}
{{--    <link href="/assets/assets/css/colors.min.css" rel="stylesheet" type="text/css">--}}
{{--    <!-- /global stylesheets -->--}}

{{--    <!-- Core JS files -->--}}
{{--    <script src="/assets/global_assets/js/main/jquery.min.js"></script>--}}
{{--    <script src="/assets/global_assets/js/main/bootstrap.bundle.min.js"></script>--}}
{{--    <script src="/assets/global_assets/js/plugins/loaders/blockui.min.js"></script>--}}
{{--    <script src="/assets/global_assets/js/plugins/ui/ripple.min.js"></script>--}}
{{--    <!-- /core JS files -->--}}

{{--    <!-- Theme JS files -->--}}
{{--    <script src="/assets/global_assets/js/plugins/visualization/d3/d3.min.js"></script>--}}
{{--    <script src="/assets/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>--}}
{{--    <script src="/assets/global_assets/js/plugins/forms/styling/switchery.min.js"></script>--}}
{{--    <script src="/assets/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>--}}
{{--    <script src="/assets/global_assets/js/plugins/ui/moment/moment.min.js"></script>--}}
{{--    <script src="/assets/global_assets/js/plugins/pickers/daterangepicker.js"></script>--}}

{{--    <script src="/assets/assets/js/app.js"></script>--}}
{{--    <script src="/assets/global_assets/js/demo_pages/dashboard.js"></script>--}}
{{--    <!-- /theme JS files -->--}}


</head>
<body>
@include('layouts.partials.navigation')

{{--    <div id="app">--}}
{{--        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
{{--            <div class="container">--}}
{{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                    {{ config('app.name', 'Laravel') }}--}}
{{--                </a>--}}
{{--                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}

{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                    <!-- Left Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav mr-auto">--}}

{{--                    </ul>--}}

{{--                    <!-- Right Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav ml-auto">--}}
{{--                        <!-- Authentication Links -->--}}
{{--                        @guest--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                            </li>--}}
{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                    {{ Auth::user()->name }}--}}
{{--                                </a>--}}

{{--                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                        {{ __('Logout') }}--}}
{{--                                    </a>--}}

{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endguest--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
