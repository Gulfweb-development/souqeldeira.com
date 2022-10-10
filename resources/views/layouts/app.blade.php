  <!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="{{ $meta_descrption ?? 'default meta description' }}">
        <meta name="keywords" content="{{ $meta_keywords ?? \App\Http\Controllers\Frontend\FrontendLangController::keyWords()  }}">
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
        <title>{{ $meta_title ?? 'default meta title' }}</title>
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


        <style>
            .listing-compact-title{
                background: #00000082;
                color: white !important;
            }
        </style>

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
                                data-sticky-logo="{{ asset('images/logo-red.svg') }}" alt="@lang('app.app_name')"
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
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('schools') }}">@lang('app.schools')</a>--}}
{{--                                </li>--}}
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
                                <li class="nav-item d-block d-md-none">
                                    <a class="nav-link" href="{{ route('login') }}">@lang('app.login')</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav {{ chkLocale('mr-auto', 'ml-auto') }} nav-flex-icons">

                                {{-- <li class="nav-item">
                                    <a class="nav-link border-div" href="#">@lang('app.car_marketing')</a>
                                </li> --}}

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
                                            <span><img src="{{ toProfileDefaultImage(user()->getFile()) }}" alt="{{user()->name }}"
                                                    ></span>
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
{{-- @livewire('frontend.layouts.header') --}}
{{ $slot }}

@livewire('frontend.layouts.footer')
<!-- Modal -->
<div class="modal show" id="myModal2xxxxxx" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color:#fff;">Please Select Your Categories</h4>
            </div>
            <div class="modal-body">

                <div class="row d-flex justify-content-center">
                    <div class="column">
                        <h2>
                            <img src="{{ asset('images/home.png') }}" style="width:150px;">

                        </h2>
                        <p class="text-center"> <button type="button" class="btn btn-info btn-lg" style="color:white"
                                data-toggle="modal" data-target="#myModal0" data-dismiss="modal">Real Estates</button>
                        </p>
                    </div>
                    <div class="column">
                        <h2> <img src="{{ asset('images/car.png') }}" style="width:150px; margin-left:22px;">
                        </h2>
                        <p class="text-center"> <button type="button" class="btn btn-info btn-lg" style="color:white"
                                data-toggle="modal" data-target="#myModal0" data-dismiss="modal">Car Market</button>
                        </p>
                    </div>


                </div>
                <div class="modal-footer">

                </div>
            </div>

        </div>
    </div>

</div>
<!-- End real estate --->

<!--- other popup للغات --->
<!-- Modal -->
<div class="modal show" id="myModal0xx" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color:#fff;">Please Your Select Language</h4>
            </div>
            <div class="modal-body">

                <div class="row d-flex justify-content-center">
                    <div class="column">
                        <h2>
                            <img src="{{ asset('images/english.jpg') }}" style="width:150px;">

                        </h2>
                        <p class="text-center"> <button type="button" class="btn btn-default" style="color:white;"
                                data-dismiss="modal">En</button>
                        </p>
                    </div>
                    <div class="column">
                        <h2> <img src="{{ asset('images/arabic.jpg') }}" style="width:150px;">
                        </h2>
                        <p class="text-center"> <button type="button" class="btn btn-default" style="color:white;"
                                data-dismiss="modal">AR</button>


                        </p>
                    </div>





                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default mx-auto" style="color:white;" data-dismiss="modal">Go
                        to Marketing</button>
                </div>
            </div>

        </div>
    </div>

    <!--- End --->

</div>
<!-- Wrapper / End -->

<!--register form -->
<div class="login-and-register-form modal">
    <div class="main-overlay"></div>
    <div class="main-register-holder">
        <div class="main-register fl-wrap">
            <div class="close-reg"><i class="fa fa-times"></i></div>
            <h3>@lang('app.welcome_to_aldeira_market')</h3>
            <div class="soc-log fl-wrap">
                <p>@lang('app.login')</p>
                {{-- <a href="#" class="facebook-log"><i class="fa fa-facebook-official"></i>Log in with Facebook</a>
                <a href="#" class="google-log"><i class="fa fa-google"></i> Log in with Google</a> --}}
            </div>
            {{-- <div class="log-separator fl-wrap"><span>Or</span></div> --}}
            <div id="tabs-container">
                <ul class="tabs-menu">
                    <li class="current"><a href="#tab-1">@lang('app.login')</a></li>
                    <li><a href="#tab-2">@lang('app.register')</a></li>
                </ul>
                <div class="tab">
                    <div id="tab-1" class="tab-contents">
                        <div class="custom-form">
                            <form method="post" name="registerfossrm" action="{{ route('login') }}">
                                @csrf
                                <label>@lang('app.email')</label>
                                <input name="email" type="text" class="@error('email') is-invalid @enderror"
                                    onClick="this.select()" value="">
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror
                                <label>@lang('app.password')</label>
                                <input name="password" class=" @error('password') is-invalid @enderror" type="password"
                                    onClick="this.select()" value="">
                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror
                                <button type="submit" class="log-submit-btn"><span>@lang('app.login')</span></button>
                                <div class="clearfix"></div>
                                <div class="filter-tags">
                                    <input id="check-a" type="checkbox" name="check">
                                    <label for="check-a">@lang('app.remember_me')</label>
                                </div>
                            </form>
                            <div class="lost_password">
                                <a href="#">@lang('app.lost_your_password')</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab">
                        <div id="tab-2" class="tab-contents">
                            <div class="custom-form">
                                <form method="post" action="{{ route('register') }}" name="regissssssterform"
                                    class="main-regisssster-form" id="main-register-fosssrm2"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>@lang('app.account_type') </label>
                                        <select
                                            class="form-control form-control-lg w-100 @error('type') is-invalid @enderror"
                                            name="type">
                                            {{-- <option value="" @lang('app.choose')></option> --}}
                                            <option value="USER">@lang('app.personal')</option>
                                            <option value="COMPANY">@lang('app.company')</option>
                                        </select>
                                        @error('type')
                                            <span class="text-danger" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                        @enderror
                                        {{-- <label>@lang('app.account_type') </label>
                                        <select name="type" class="form-control @error('type') is-invalid @enderror">
                                            <option value="USER">@lang('app.personal')</option>
                                            <option value="COMPANY">@lang('app.company')</option>
                                        </select>
                                        @error('type')
                                            <span class="text-danger" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                        @enderror --}}
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('app.name') </label>
                                        <input name="name" type="text" onClick="this.select()"
                                            class="@error('name') is-invalid @enderror" value="">
                                        @error('name')
                                            <span class="text-danger" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('app.email')</label>
                                        <input name="email" class="@error('email') is-invalid @enderror" type="text"
                                            onClick="this.select()" value="">
                                        @error('email')
                                            <span class="text-danger" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('app.phone')</label>
                                        <input name="phone" class="@error('phone') is-invalid @enderror" type="text"
                                            onClick="this.select()" value="">
                                        @error('phone')
                                            <span class="text-danger" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('app.password')</label>
                                        <input name="password" class="@error('password') is-invalid @enderror"
                                            type="password" onClick="this.select()" value="">
                                        @error('password')
                                            <span class="text-danger" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('app.password_confirmation')</label>
                                        <input name="password_confirmation" type="password" onClick="this.select()"
                                            value="">
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <label>@lang('app.image')</label>
                                        <input name="image" type="file" onClick="this.select()" value=""
                                            class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <span class="text-danger" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="exampleFormControlFile1">Example file input</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                    </div> --}}
                                    <br>
                                    <button type="submit"
                                        class="log-submit-btn"><span>@lang('app.register')</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--register form end -->

</div>


</div>
<!-- End real estate --->
@livewireScripts

<!-- ARCHIVES JS -->


<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/tether.min.js') }}"></script>
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/mmenu.min.js') }}"></script>
<script src="{{ asset('js/mmenu.js') }}"></script>
<script src="{{ asset('js/swiper.min.js') }}"></script>
<script src="{{ asset('js/swiper.js') }}"></script>
<script src="{{ asset('js/rangeSlider.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/aos2.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/slick2.js') }}"></script>
<script src="{{ asset('js/fitvids.js') }}"></script>
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('js/smooth-scroll.min.js') }}"></script>
<script src="{{ asset('js/lightcase.js') }}"></script>
<script src="{{ asset('js/search.js') }}"></script>
<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/ajaxchimp.min.js') }}"></script>
<script src="{{ asset('js/newsletter.js') }}"></script>
<script src="{{ asset('js/jquery.form.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/typed.min.js') }}"></script>
<script src="{{ asset('js/popup.js') }}"></script>
<script src="{{ asset('js/searched.js') }}"></script>
<script src="{{ asset('js/forms-2.js') }}"></script>
<script src="{{ asset('js/dashbord-mobile-menu.js') }}"></script>
<script src="{{ asset('js/leaflet.js') }}"></script>
<script src="{{ asset('js/leaflet-gesture-handling.min.js') }}"></script>
<script src="{{ asset('js/color-switcher.js') }}"></script>
<script src="{{ asset('js/leaflet-providers.js') }}"></script>
<script src="{{ asset('js/leaflet.markercluster.js') }}"></script>
<script src="{{ asset('js/map-style2.js') }}"></script>
<script src="{{ asset('js/range.js') }}"></script>
<script src="{{ asset('js/inner.js') }}"></script>
<script>
    $(window).on('scroll load', function() {
        $("#header.cloned #logo img").attr("src", $('#header #logo img').attr('data-sticky-logo'));
    });
</script>

<!-- Slider Revolution scripts -->
<script src="{{ asset('revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2@10.js') }}"></script>
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
    // SHOW IF USED DISPATCH BROWSER EVENT
    window.addEventListener('success', event => {
        toastr.success(event.detail.message)
    });
    window.addEventListener('info', event => {
        toastr.info(event.detail.message)
    });
    // TOASTER END

    // SWEAT ALERT START
    function deleteConfirmation(id) {
        Swal.fire({
            title: "{!! __('app.confirm_title') !!}",
            text: "{!! __('app.confirm_message') !!}",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: "{!! __('app.cancle') !!}",
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#d33',
            confirmButtonText: "{!! __('app.delete') !!}"
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('delete', id);
            }
        })
    }
    // var typed = new Typed('.typed', {
    //     strings: ["House ^2000", "Apartment ^2000", "Plaza ^4000"],
    //     smartBackspace: false,
    //     loop: true,
    //     showCursor: true,
    //     cursorChar: "|",
    //     typeSpeed: 50,
    //     backSpeed: 30,
    //     startDelay: 800
    // });
</script>

<script>
    $('.slick-lancers').slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        adaptiveHeight: true,
        responsive: [{
            breakpoint: 1292,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: true,
                arrows: false
            }
        }, {
            breakpoint: 993,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: true,
                arrows: false
            }
        }, {
            breakpoint: 769,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: false
            }
        }]
    });
</script>

<script>
    $(".dropdown-filter").on('click', function() {

        $(".explore__form-checkbox-list").toggleClass("filter-block");

    });
</script>

<!-- ARCHIVES JS -->

<script>
    $(document).ready(function() {
        $("#myModal2").modal('show');
    });
</script>
<!-- MAIN JS -->
@stack('js')
<script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
