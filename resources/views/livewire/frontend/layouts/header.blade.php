<div>
    <!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="{{ $meta_descrption ?? $setting->translate('description') }}">
        <meta name="author" content="aldeira_market">
        {{-- FACEBOOK METAS START --}}
        <meta property="og:url" content="{{ $og_url ?? 'default og url'}}" />
        <meta property="og:type" content="{{ $og_type ?? 'default og type'}}" />
        <meta property="og:title" content="{{ $og_title ?? 'default og tile'}}" />
        <meta property="og:description" content="{{ $og_description ?? 'default og description'}}" />
        <meta property="og:image" content="{{ $og_image ?? 'default og image'}}" />
        <meta name="twitter:title" content="{{ $twitter_title ?? 'default twitter title'}}">
        <meta name="twitter:description" content="{{ $twitter_description ?? 'default twitter description'}}">
        <meta name="twitter:image" content="{{ $twitter_image ?? 'default twitter image'}}">
        <meta name="twitter:card" content="{{ $twitter_card ?? 'default twitter card'}}">
        {{-- FACEBOOK METAS END --}}
        <title>{{ $meta_title ?? $setting->translate('title') }}</title>
        <!-- FAVICON -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800"
            rel="stylesheet">
        <!-- FONT AWESOME -->
        <link href="{{ asset('fonts/css/all.css') }}" rel="stylesheet">
        <link href="{{ asset('fonts/css/fontawesome.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('css/lightcase.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('css/default.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('css/colors/pink.css') }}">
        <!-- LEAFLET MAP ################################-->
        <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}">
        <link rel="stylesheet" href="{{ asset('css/leaflet-gesture-handling.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/leaflet.markercluster.css') }}">
        <link rel="stylesheet" href="{{ asset('css/leaflet.markercluster.default.css') }}">
        <!-- Slider Revolution CSS Files -->
        <!-- ARCHIVES CSS -->

        <link rel="stylesheet" href="{{ asset('css/search.css') }}">
        <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
        <link rel="stylesheet" href="{{ asset('css/aos2.css') }}">

        <link rel="stylesheet" href="{{ asset('css/maps.css') }}">
        <link rel="stylesheet" id="color" href="{{ asset('css/colors/pink.css') }}">
        <!-- CUSTOM CSS -->
        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom_css.css') }}">
        <link rel="stylesheet" href="{{ asset('css/override.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
        @if (app()->isLocale('ar'))
            <!-- Custom style for RTL -->
            <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
            <link rel="stylesheet" href="{{ asset('css/custom_rtl_css.css') }}">

        @endif
        @livewireStyles
        @stack('css')

    </head>

    <body
        class="
 @if (Route::is('abouts'))
        inner-pages hd-white about
    @elseif (Route::is('contacts'))
        inner-pages hd-white contact
    @elseif (Route::is('ads.search'))
       inner-pages homepage-4 agents hp-6 full hd-white
      @elseif (Route::is('schools'))
       inner-pages homepage-4 agents hp-6 full hd-white
    @elseif (Route::is('agencies'))
       inner-pages homepage-4 agents hp-6 full hd-white
    @elseif (Route::is('blogs'))
       inner-pages homepage-4 agents hp-6 full hd-white
    @elseif (Route::is('ad.search'))
       inner-pages sin-1 hd-white
    @elseif (Route::is('school'))
       inner-pages sin-1 hd-white
    @elseif (Route::is('agency'))
       inner-pages sin-1 hd-white
    @elseif (Route::is('blog'))
       inner-pages sin-1 hd-white
      @elseif (Route::is('policy'))
       inner-pages sin-1 hd-white
    @else
        homepage-6 homepage-9 homepage-4 hp-6
        @endif
        {{ Route::is('abouts') ? '' : '' }}">
        @if (authApprovedUser())
            <div class="fab-actions">
                <a class="btn btn-outline-light" href="{{ route('profile.ad.create') }}">
                    @lang('app.add_new_add')
                </a>
            </div>
            <!-- Wrapper -->
        @endif
        <div id="wrapper">
            <header id="header-container" class="header head-tr">
                <!-- Header -->
                <div id="header" class="head-tr bottom">
                    <nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color fixed-top">
                        <a class="navbar-brand" href="{{ url('/') }}"><img
                                src="{{ asset('images/logo-red.svg') }}"
                                data-sticky-logo="{{ asset('images/logo-red.svg') }}" alt=""
                                class="img-responsive"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
                            <ul class="navbar-nav mr-auto nav-flex-icons">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ url('/') }}">@lang('app.home')
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('agencies') }}">@lang('app.agencies')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('ads.search') }}">@lang('app.real_estates')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('schools') }}">@lang('app.schools')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('contacts') }}">@lang('app.contacts')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('abouts') }}">@lang('app.about')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('blogs') }}">@lang('app.blogs')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('policy') }}">@lang('app.policy')</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav {{ chkLocale('mr-auto', 'ml-auto') }} nav-flex-icons">

                                <li class="nav-item">
                                    <a class="nav-link border-div" href="#">@lang('app.car_marketing')</a>
                                </li>

                                @if (Auth::check())
                                    @if (!user()->hasVerifiedEmail())
                                        <li class="nav-item">
                                            <a class="nav-link border-div"
                                                href="{{ url('/email/verify') }}">@lang('app.verifiy_your_account')</a>
                                        </li>
                                    @endif
                                @endif

                                @if (Auth::guard('web')->check())
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">{{ user()->name }}
                                            <span><img src="{{ toProfileDefaultImage(user()->getFile()) }}"
                                                    alt="@lang('app.alt_img')"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-default"
                                            aria-labelledby="navbarDropdownMenuLink-333">
                                            @if (user()->hasVerifiedEmail())
                                                <a class="dropdown-item"
                                                    href="{{ route('profile.profile') }}">@lang('app.profile')</a>
                                            @else
                                                <a class="dropdown-item"
                                                    href="{{ url('/email/verify') }}">@lang('app.verifiy_your_account')</a>
                                            @endif
                                            {{-- <a class="dropdown-item" href="add-property.html">Add Property</a> --}}
                                            <a class="dropdown-item"
                                                href="{{ route('profile.change.password') }}">@lang('app.change_password')</a>
                                            <a class="dropdown-item"
                                                href="{{ route('auth.logout') }}">@lang('app.logout')</a>
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        {{-- <a
                                            class="nav-link waves-effect waves-light border-div show-reg-form modal-open">
                                            @lang('app.sign_in')
                                        </a> --}}
                                        <a href="{{ route('login') }}"
                                            class="nav-link waves-effect waves-light border-div show-reg-form ">
                                            @lang('app.sign_in')
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item dropdown">
                                    @if (App::isLocale('ar'))
                                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-globe-americas"></i> @lang('app.arabic')
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-default"
                                            aria-labelledby="navbarDropdownMenuLink-333">
                                            <a class="dropdown-item"
                                                href="{{ route('lang', ['en']) }}">@lang('app.english')</a>
                                        </div>
                                    @else
                                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-globe-americas"></i> @lang('app.english')
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-default"
                                            aria-labelledby="navbarDropdownMenuLink-333">
                                            <a class="dropdown-item"
                                                href="{{ route('lang', ['ar']) }}">@lang('app.arabic')</a>
                                        </div>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- Header / End -->
            </header>
            <div class="clearfix"></div>

            {{-- </div> --}}
