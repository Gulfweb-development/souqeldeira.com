<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="html 5 template">
    <meta name="author" content="">
    <title>{{ $meta_title ?? 'DEFAULT TITLE FROM PROFILE' }}</title>
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link href="{{ asset('fonts/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/css/fontawesome.min.css') }}" rel="stylesheet">
    <!-- Slider Revolution CSS Files -->
    <link rel="stylesheet" href="{{ asset('revolution/css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('revolution/css/layers.css') }}">
    <link rel="stylesheet" href="{{ asset('revolution/css/navigation.css') }}">
    <!-- ARCHIVES CSS -->
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashbord-mobile-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" id="color" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <!-- CUSTOM CSS -->
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

<body class="maxw1600 m0a dashboard-bd">
    <!-- Wrapper -->
    <div id="wrapper" class="int_main_wraapper">
        <!-- START SECTION HEADINGS -->
        <!-- Header Container
        ================================================== -->
        <div class="dash-content-wrap">
            <header id="header-container" class="db-top-header">
                <!-- Header -->
                <div id="header">
                    <div class="container-fluid">
                        <!-- Left Side Content -->
                        <div class="left-side">
                            <!-- Logo -->
                            <div id="logo">
                                <a href="{{ url('/') }}"><img src="{{ asset('images/logo-red22.svg') }}" alt="@lang('app.alt_img')"></a>
                            </div>
                            <!-- Mobile Navigation -->
                            <div class="mmenu-trigger">
                                <button class="hamburger hamburger--collapse" type="button">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                            <!-- Main Navigation -->
                            <nav id="navigation" class="style-1">
                                <ul id="responsive">
                                    <li><a href="{{ url('/') }}">@lang('app.home')</a></li>
                                    <li><a href="{{ route('agencies') }}">@lang('app.agencies')</a></li>
                                    <li><a href="{{ route('ads.search') }}">@lang('app.real_estates')</a></li>
                                    <li><a class="nav-link"
                                            href="{{ route('contacts') }}">@lang('app.contacts')</a></li>
                                    <li><a class="nav-link" href="{{ route('abouts') }}">@lang('app.about')</a>
                                    </li>
                                    <li><a class="nav-link" href="{{ route('blogs') }}">@lang('app.blogs')</a>
                                    </li>
                                    <li><a class="nav-link"
                                            href="{{ route('policy') }}">@lang('app.policy')</a></li>
                                </ul>
                            </nav>
                            <div class="clearfix"></div>
                            <!-- Main Navigation / End -->
                        </div>
                        <!-- Left Side Content / End -->
                        <!-- Right Side Content / -->
                        <div class="right-side">
                            <div class="header-user-menu user-menu">
                                <div class="header-user-name">
                                    <span><img src="{{ toProfileDefaultImage(user()->getFile()) }}"
                                            alt="@lang('app.alt_img')"></span>{{ user()->name }}
                                </div>
                                <ul>
                                    <li><a href="{{ route('profile.profile') }}">@lang('app.edit_profile')</a></li>
                                    {{-- <li><a href="add-property.html"> Add Property</a></li> --}}
                                    <li><a
                                            href="{{ route('profile.change.password') }}">@lang('app.change_password')</a>
                                    </li>
                                    <li><a href="{{ route('auth.logout') }}">@lang('app.logout')</a></li>
                                </ul>
                            </div>
                            <!-- Main Navigation -->
                            <nav id="navigation" class="style-1">
                                <ul id="responsive">
                                    {{-- <li><a href="#">Car Marketing</a></li> --}}
                                    @if (authApprovedUser())
                                        @if (user()->unReadNotifications()->count() == 0)
                                            <li><a href="javascript:void(0);">@lang('app.notification') <span
                                                        class="notification-number bg-secondary">0</span></a></li>
                                        @else
                                            <li><a href="javascript:void(0);"
                                                    class="text-secondary">@lang('app.notifications') <span
                                                        class="notification-number">{{ user()->unReadNotifications()->count() }}</span></a>
                                                <ul>

                                                    @forelse (user()->unReadNotifications as $notification)
                                                        {{-- REVIEW TYPE CUZ ROUTE GOT ROUTE EN & AR --}}
                                                        @if ($notification->data['type'] == 'REVIEW')
                                                            <li><a
                                                                    href="{{ $notification->data[toLocale('route')] }}">{{ $notification->data[toLocale('title')] }}</a>
                                                            </li>
                                                        @else
                                                            <li><a
                                                                    href="{{ $notification->data['route'] }}">{{ $notification->data[toLocale('title')] }}</a>
                                                            </li>
                                                        @endif
                                                    @empty

                                                    @endforelse
                                                </ul>
                                            </li>
                                        @endif
                                    @endif
                                    <hr class="line-vertical" />
                                    @if (App::isLocale('ar'))
                                        <li><a href="{{ route('lang', ['ar']) }}">@lang('app.arabic')</a>
                                            <ul>
                                                <li><a href="{{ route('lang', ['en']) }}">@lang('app.english')</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @else
                                        <li><a href="{{ route('lang', ['en']) }}">@lang('app.english')</a>
                                            <ul>
                                                <li><a href="{{ route('lang', ['ar']) }}">@lang('app.arabic')</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                            <!-- Main Navigation / End -->
                        </div>
                        <!-- Right Side Content / End -->
                    </div>
                </div>
                <!-- Header / End -->
            </header>
        </div>
        <div class="clearfix"></div>
        <!-- Header Container / End -->

        <!-- START SECTION USER PROFILE -->
        <section class="user-page section-padding pt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
                        <div class="user-profile-box mb-0">
                            <div class="sidebar-header"><img src="{{ asset('images/logo-red.svg') }}"
                                    alt="header-logo2.png"> </div>
                            <div class="header clearfix">
                                <img src="{{ toProfileDefaultImage(user()->getFile()) }}" alt="@lang('app.alt_img')"
                                    class="img-fluid profile-img">
                            </div>
                            <div class="active-user">
                                <h2>{{ user()->name }}</h2>
                            </div>
                            <div class="detail clearfix">
                                <ul class="mb-0">
                                    {{-- SIDEBAR START --}}
                                    <li>
                                        <a class="{{ request()->segment(2) == 'dashboard' ? 'active' : '' }}"
                                            href="{{ route('profile.dashboard') }}">
                                            <i class="fa fa-map-marker"></i> @lang('app.dashboard')
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->segment(2) == 'profile' ? 'active' : '' }}"
                                            href="{{ route('profile.profile') }}">
                                            <i class="fa fa-user"></i>@lang('app.profile')
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->segment(2) == 'ads' ? 'active' : '' }}"
                                            href="{{ route('profile.subscriptions.index') }}">
                                            <i class="fa fa-list" aria-hidden="true"></i>@lang('app.subscriptions')
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->segment(2) == 'ads' ? 'active' : '' }}"
                                            href="{{ route('profile.ad.index') }}">
                                            <i class="fa fa-list" aria-hidden="true"></i>@lang('app.my_ads')
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="favorited-listings.html">
                                            <i class="fa fa-heart" aria-hidden="true"></i>Favorited Properties
                                        </a>
                                    </li> --}}
                                    <li>
                                        <a href="{{ route('profile.ad.create') }}">
                                            <i class="fa fa-list" aria-hidden="true"></i>@lang('app.add_ads')
                                        </a>
                                    </li>
                                    @if (authApprovedUserCompany())
                                        <li>
                                            <a class="{{ request()->segment(2) == 'agencies' ? 'active' : '' }}"
                                                href="{{ route('profile.agency.index') }}">
                                                <i class="fa fa-list"
                                                    aria-hidden="true"></i>@lang('app.my_agencies')
                                            </a>
                                        </li>
                                    @endif
                                    @if (authApprovedUserCompany())
                                        <li>
                                            <a href="{{ route('profile.agency.create') }}">
                                                <i class="fa fa-list" aria-hidden="true"></i>@lang('app.add_agency')
                                            </a>
                                        </li>
                                    @endif

                                    <li>
                                        <a class="{{ request()->segment(2) == 'change-password' ? 'active' : '' }}"
                                            href="{{ route('profile.change.password') }}">
                                            <i class="fa fa-lock"></i>@lang('app.change_password')
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->segment(2) == 'contact-user' ? 'active' : '' }}"
                                            href="{{ route('profile.contact-user.index') }}">
                                            <i class="fa fa-lock"></i>@lang('app.contact_messages')
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->segment(2) == 'user-message' ? 'active' : '' }}"
                                            href="{{ route('profile.user-message.index') }}">
                                            <i class="fa fa-lock"></i>@lang('app.managemant_messages')
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->segment(2) == 'favorite' ? 'active' : '' }}"
                                            href="{{ route('profile.favorites') }}">
                                            <i class="fa fa-lock"></i>@lang('app.favorites')
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('auth.logout') }}">
                                            <i class="fas fa-sign-out-alt"></i>@lang('app.logout')
                                        </a>
                                    </li>
                                    <br>
                                    <br>
                                    <br>
                                    {{-- SIDEBAR END --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                        <div class="col-lg-12 mobile-dashbord dashbord">
                            <div class="dashboard_navigationbar dashxl">
                                <div class="dropdown">
                                    <button onclick="myFunction()" class="dropbtn"><i
                                            class="fa fa-bars pr10 mr-2"></i> @lang('app.dashboard_menu')</button>
                                    <ul id="myDropdown" class="dropdown-content">
                                        <li>
                                            <a href="{{ route('profile.dashboard') }}">
                                                <i class="fa fa-map-marker mr-3"></i> @lang('app.dashboard')
                                            </a>
                                        </li>
                                        <li>
                                            <a class="active" href="{{ route('profile.profile') }}">
                                                <i class="fa fa-user mr-3"></i>@lang('app.profile')
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('profile.ad.index') }}">
                                                <i class="fa fa-list mr-3" aria-hidden="true"></i>@lang('app.my_ads')
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('profile.ad.create') }}">
                                                <i class="fa fa-heart mr-3" aria-hidden="true"></i>@lang('app.add_ads')
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('profile.agency.index') }}">
                                                <i class="fa fa-list mr-3" aria-hidden="true"></i>@lang('app.my_agencies')
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('profile.agency.create') }}">
                                                <i class="fas fa-credit-card mr-3"></i>@lang('app.add_agency')
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('profile.change.password') }}">
                                                <i class="fas fa-paste mr-3"></i>@lang('app.change_password')
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('profile.contact-user.index') }}">
                                                <i class="fa fa-lock mr-3"></i>@lang('app.contact_messages')
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('profile.user-message.index') }}">
                                                <i class="fa fa-lock mr-3"></i>@lang('app.managemant_messages')
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('profile.favorites') }}">
                                                <i class="fa fa-lock mr-3"></i>@lang('app.favorites')
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('auth.logout') }}">
                                                <i class="fas fa-sign-out-alt mr-3"></i>@lang('app.logout')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="dashborad-box">
                            {{ $slot }}
                        </div>
                        @livewire('profile.layouts.footer')
                    </div>
                </div>
            </div>
        </section>
        <!-- END SECTION USER PROFILE -->
        <a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up"
                aria-hidden="true"></i></a>
        <!-- END FOOTER -->
        <!-- START PRELOADER -->
        <div id="preloader">
            <div id="status">
                <div class="status-mes"></div>
            </div>
        </div>
        <!-- END PRELOADER -->

        <!-- ARCHIVES JS -->
        @livewireScripts
        <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.js') }}"></script>
        <script src="{{ asset('js/tether.min.js') }}"></script>
        <script src="{{ asset('js/moment.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/mmenu.min.js') }}"></script>
        <script src="{{ asset('js/mmenu.js') }}"></script>
        <script src="{{ asset('js/swiper.min.js') }}"></script>
        <script src="{{ asset('js/swiper.js') }}"></script>
        <script src="{{ asset('js/slick.min.js') }}"></script>
        <script src="{{ asset('js/slick2.js') }}"></script>
        <script src="{{ asset('js/fitvids.js') }}"></script>
        <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('js/smooth-scroll.min.js') }}"></script>
        <script src="{{ asset('js/lightcase.js') }}"></script>
        {{-- <script src="{{ asset('js/search.js') }}"></script> --}}
        <script src="{{ asset('js/owl.carousel.js') }}"></script>
        <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('js/ajaxchimp.min.js') }}"></script>
        <script src="{{ asset('js/newsletter.js') }}"></script>
        <script src="{{ asset('js/jquery.form.js') }}"></script>
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('js/searched.js') }}"></script>
        <script src="{{ asset('js/dashbord-mobile-menu.js') }}"></script>
        <script src="{{ asset('js/forms-2.js') }}"></script>
        <script src="{{ asset('js/color-switcher.js') }}"></script>

        <!-- Slider Revolution scripts -->
        <script src="{{ asset('revolution/js/jquery.themepunch.tools.min.js') }}"></script>
        <script src="{{ asset('revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert2@10.js') }}"></script>
        <script src="{{ asset('js/toastr.min.js') }}"></script>
        <!-- MAIN JS -->
        <script src="{{ asset('js/script.js') }}"></script>

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
            // SHOW IF USED DISPATCH BROWSER EVENT
            window.addEventListener('success', event => {
                toastr.success(event.detail.message)
            })
            window.addEventListener('info', event => {
                toastr.info(event.detail.message)
            })
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
            $(".header-user-name").on("click", function() {
                $(".header-user-menu ul").toggleClass("hu-menu-vis");
                $(this).toggleClass("hu-menu-visdec");
            });
        </script>
        @stack('js')
    </div>
    <!-- Wrapper / End -->
</body>

</html>
