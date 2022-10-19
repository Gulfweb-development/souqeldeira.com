<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('meta_title','DEFAULT META TITLE')</title>
    <meta name="description" content=" @yield('meta_descrption','DEFAULT META DESCRIPTOR')">
    <meta property="og:url" content=" @yield('og_url','default og url')" />
    <meta property="og:type" content=" @yield('og_type','default og type')" />
    <meta property="og:title" content=" @yield('og_title','default og tile')" />
    <meta property="og:description" content=" @yield('og_description','default og description')" />
    <meta property="og:image" content=" @yield('og_image','default og image')" />
    <meta name="twitter:title" content=" @yield('twitter_title','default twitter title')">
    <meta name="twitter:description" content=" @yield('twitter_description','default twitter description')">
    <meta name="twitter:image" content=" @yield('twitter_image','default twitter image')">
    <meta name="twitter:card" content=" @yield('twitter_card','default twitter card')">
    <!-- Scripts -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    {{--  <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        .main-header-bg {
            background-color: #092970 !important;
        }

        .navbar-light .navbar-nav .nav-link,
        .navbar-brand {
            color: #fff !important;
        }

    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">

    @if (app()->isLocale('ar'))
    <!-- Custom style for RTL -->
        <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom_rtl_css.css') }}">
    @endif
</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm main-header-bg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                @lang('app.back_to_website')
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav {{ chkLocale('mr-auto','ml-auto') }}">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">@lang('app.login')</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">@lang('app.register')</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script>
    // TOASTER START
    var message;
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    // SHOW IF SESSION WITH REDIRECT
    @if (session()->has('success'))
        message = "{{ session()->get('success') }}";
    toastr.success(message)
    @endif
    // SHOW IF SESSION WITH REDIRECT
    @if (session()->has('info'))
        message = "{{ session()->get('info') }}";
    toastr.info(message)
    @endif
    <!-- Google tag (gtag.js) -->
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QDD5K0BPGB"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-QDD5K0BPGB');
</script>
</script>
</body>

</html>
