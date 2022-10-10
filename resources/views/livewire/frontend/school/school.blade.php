<div>
    <x-slot name="meta_title">@lang('app.school') - {{ $school->translate('title') }}</x-slot>
    <x-slot name="meta_descrption">{{ Str::limit(strip_tags($school->translate('text')), 155)  }}</x-slot>
    <x-slot name="og_title">@lang('app.school') - {{ $school->translate('title') }}</x-slot>
    <x-slot name="og_description">{{ Str::limit(strip_tags($school->translate('text')), 155)  }}</x-slot>
    <x-slot name="og_url">{{ Request::url() }}</x-slot>
    <x-slot name="og_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_title">@lang('app.school') - {{ $school->translate('title') }}</x-slot>
    <x-slot name="twitter_description">{{ Str::limit(strip_tags($school->translate('text')), 155)  }}</x-slot>
    <x-slot name="twitter_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_card">@lang('app.school') - {{ $school->translate('title') }}</x-slot>
    <!-- Header Container / End -->
    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>@lang('app.details')</h1>
                <h2>
                    <a href="{{ url('/') }}">@lang('app.home') </a>&nbsp;/&nbsp;
                    <a href="{{ route('schools') }}">@lang('app.schools') </a>
                    &nbsp;/&nbsp;{{ $school->translate('title') }}
                </h2>
            </div>
        </div>
    </section>
    <!-- START SECTION PROPERTIES LISTING -->
    <section class="single-proper blog details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 blog-pots">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="headings-2 pt-0">
                                <div class="pro-wrapper">
                                    <div class="detail-wrapper-body">
                                        <div class="listing-title-bar">
                                            <h3>{{ $school->translate('title') }} </h3>
                                            <div class="mt-0">
                                                <a href="javascript:void(0);" class="listing-address text-secondary">
                                                    <i
                                                        class="fa fa-map-marker pr-2 ti-location-pin mrg-r-5"></i>{{ $school->governorate->translate('name') }}
                                                    - {{ $school->region->translate('name') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single detail-wrapper mr-2">
                                        <div class="detail-wrapper-body">
                                            <div class="listing-title-bar">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- main slider carousel items -->
                            {{-- <div id="listingDetailsSlider" class="carousel listing-details-sliders slide mb-30">
                                    <h5 class="mb-4">Gallery</h5>
                                    <div class="carousel-inner">
                                        <div class="active item carousel-item" data-slide-number="0">
                                            <img src="{{ asset('images/single-property/s-1.jpg') }}" class="img-fluid" alt="slider-listing">
                                        </div>
                                        <div class="item carousel-item" data-slide-number="1">
                                            <img src="{{ asset('images/single-property/s-2.jpg') }}" class="img-fluid" alt="slider-listing">
                                        </div>
                                        <div class="item carousel-item" data-slide-number="2">
                                            <img src="{{ asset('images/single-property/s-3.jpg') }}" class="img-fluid" alt="slider-listing">
                                        </div>
                                        <div class="item carousel-item" data-slide-number="4">
                                            <img src="{{ asset('images/single-property/s-4.jpg') }}" class="img-fluid" alt="slider-listing">
                                        </div>
                                        <div class="item carousel-item" data-slide-number="5">
                                            <img src="{{ asset('images/single-property/s-5.jpg') }}" class="img-fluid" alt="slider-listing">
                                        </div>

                                        <a class="carousel-control left" href="#listingDetailsSlider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                        <a class="carousel-control right" href="#listingDetailsSlider" data-slide="next"><i class="fa fa-angle-right"></i></a>

                                    </div>
                                    <!-- main slider carousel nav controls -->
                                    <ul class="carousel-indicators smail-listing list-inline">
                                        <li class="list-inline-item active">
                                            <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#listingDetailsSlider">
                                                <img src="{{ asset('images/single-property/s-1.jpg') }}" class="img-fluid" alt="listing-small">
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a id="carousel-selector-1" data-slide-to="1" data-target="#listingDetailsSlider">
                                                <img src="{{ asset('images/single-property/s-2.jpg') }}" class="img-fluid" alt="listing-small">
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a id="carousel-selector-2" data-slide-to="2" data-target="#listingDetailsSlider">
                                                <img src="{{ asset('images/single-property/s-3.jpg') }}" class="img-fluid" alt="listing-small">
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a id="carousel-selector-3" data-slide-to="3" data-target="#listingDetailsSlider">
                                                <img src="{{ asset('images/single-property/s-4.jpg') }}" class="img-fluid" alt="listing-small">
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a id="carousel-selector-4" data-slide-to="4" data-target="#listingDetailsSlider">
                                                <img src="{{ asset('images/single-property/s-5.jpg') }}" class="img-fluid" alt="listing-small">
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- main slider carousel items -->
                                </div> --}}
                            <div class="floor-plan property wprt-image-video w50 pro">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>@lang('app.image')</h5>

                                </div>
                                <img alt="image" src="{{ $school->getFile() }}">
                            </div>
                            <div class="blog-info details mb-30">
                                <h5 class="mb-4">@lang('app.description')</h5>
                                {{ $school->translate('text') }}
                            </div>
                        </div>
                    </div>



                    {{-- <div class="floor-plan property wprt-image-video w50 pro">
                            <h5>What's Nearby</h5>
                            <div class="property-nearby">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="nearby-info mb-4">
                                            <span class="nearby-title mb-3 d-block text-info">
                                               <i class="fas fa-graduation-cap mr-2"></i><b class="title">Education</b>
                                            </span>
                                            <div class="nearby-list">
                                                <ul class="property-list list-unstyled mb-0">
                                                    <li class="d-flex">
                                                        <h6 class="mb-3 mr-2">Education Mandarin</h6>
                                                        <span>(15.61 miles)</span>
                                                        <ul class="list-unstyled list-inline ml-auto">
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star-half fa-xs"></i></li>
                                                        </ul>
                                                    </li>
                                                    <li class="d-flex">
                                                        <h6 class="mb-3 mr-2">Marry's Education</h6>
                                                        <span>(15.23 miles)</span>
                                                        <ul class="list-unstyled list-inline ml-auto">
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star-half fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="far fa-star fa-xs"></i></li>
                                                        </ul>
                                                    </li>
                                                    <li class="d-flex">
                                                        <h6 class="mb-3 mr-2">The Kaplan</h6>
                                                        <span>(15.16 miles)</span>
                                                        <ul class="list-unstyled list-inline ml-auto">
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star-half fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="far fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="far fa-star fa-xs"></i></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="nearby-info mb-4">
                                            <span class="nearby-title mb-3 d-block text-success">
                                              <i class="fas fa-user-md mr-2"></i><b class="title">Health & Medical</b>
                                            </span>
                                            <div class="nearby-list">
                                                <ul class="property-list list-unstyled mb-0">
                                                    <li class="d-flex">
                                                        <h6 class="mb-3 mr-2">Natural Market</h6>
                                                        <span>(13.20 miles)</span>
                                                        <ul class="list-unstyled list-inline ml-auto">
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star-half fa-xs"></i></li>
                                                        </ul>
                                                    </li>
                                                    <li class="d-flex">
                                                        <h6 class="mb-3 mr-2">Food For Health</h6>
                                                        <span>(13.22 miles)</span>
                                                        <ul class="list-unstyled list-inline ml-auto">
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star-half fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="far fa-star fa-xs"></i></li>
                                                        </ul>
                                                    </li>
                                                    <li class="d-flex">
                                                        <h6 class="mb-3 mr-2">A Matter of Health</h6>
                                                        <span>(13.34 miles)</span>
                                                        <ul class="list-unstyled list-inline ml-auto">
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star-half fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="far fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="far fa-star fa-xs"></i></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="nearby-info">
                                            <span class="nearby-title mb-3 d-block text-danger">
                                                <i class="fas fa-car mr-2"></i><b class="title">Transportation</b>
                                            </span>
                                            <div class="nearby-list">
                                                <ul class="property-list list-unstyled mb-0">
                                                    <li class="d-flex">
                                                        <h6 class="mb-3 mr-2">Airport Transportation</h6>
                                                        <span>(11.36 miles)</span>
                                                        <ul class="list-unstyled list-inline ml-auto">
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star-half fa-xs"></i></li>
                                                        </ul>
                                                    </li>
                                                    <li class="d-flex">
                                                        <h6 class="mb-3 mr-2">NYC Executive Limo</h6>
                                                        <span>(11.87 miles)</span>
                                                        <ul class="list-unstyled list-inline ml-auto">
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star-half fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="far fa-star fa-xs"></i></li>
                                                        </ul>
                                                    </li>
                                                    <li class="d-flex">
                                                        <h6 class="mb-3 mr-2">Empire Limousine</h6>
                                                        <span>(11.52 miles)</span>
                                                        <ul class="list-unstyled list-inline ml-auto">
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="fas fa-star-half fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="far fa-star fa-xs"></i></li>
                                                            <li class="list-inline-item m-0 text-warning"><i class="far fa-star fa-xs"></i></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    <div class="property-location map">
                        <h5>@lang('app.location')</h5>
                        <div class="divider-fade"></div>
                        <div>
                            {!! $school->map_link !!}
                        </div>
                    </div>

                </div>
                <aside class="col-lg-4 col-md-12 car">
                    <div class="single widget">
                        <!-- end author-verified-badge -->
                        <div class="sidebar">
                            <div class="widget-boxed mt-33 mt-5">
                                <div class="widget-boxed-header">
                                    <h4>@lang('app.information')</h4>
                                </div>
                                <div class="widget-boxed-body">
                                    <div class="sidebar-widget author-widget2">
                                        <div class="author-box clearfix">
                                            <a target="_blank"
                                                href="http://api.whatsapp.com/send?phone={{ $school->phone }}"> <i
                                                    class="fab fa-whatsapp-square"></i></a>
                                            <h4 class="author__title">{{ $school->translate('title') }}</h4>
                                            <p class="author__meta">@lang('app.agent_of_property')</p>
                                        </div>
                                        <div class="author-box clearfix">
                                            <a href="tel:{{ $school->phone }}"> <i class="fas fa-phone-alt"></i></a>
                                            <h4 class="author__title">@lang('app.call_now')</h4>
                                            <p class="author__meta">@lang('app.better_from_mobile')</p>
                                        </div>
                                        <div class="author-box clearfix">
                                            <a href="mailto::{{ $school->email }}"> <i class="far fa-envelope the-icon"></i></a>
                                            <h4 class="author__title">@lang('app.call')</h4>
                                            <p class="author__meta">@lang('app.by_mail')</p>
                                        </div>
                                        <div class="author-box clearfix">
                                            <a target="_blank" href="{{ $school->facebook }}"> <i class="fab fa-facebook-square the-icon"></i></a>
                                            <h4 class="author__title">@lang('app.call')</h4>
                                            <p class="author__meta">@lang('app.by_facebook')</p>
                                        </div>
                                        <div class="author-box clearfix">
                                            <a target="_blank" href="{{ $school->twitter }}"> <i class="fab fa-twitter-square the-icon"></i></a>
                                            <h4 class="author__title">@lang('app.call')</h4>
                                            <p class="author__meta">@lang('app.by_twitter')</p>
                                        </div>
                                        <div class="author-box clearfix">
                                            <a target="_blank" href="{{ $school->instagram }}"><i class="fab fa-instagram-square the-icon"></i></a>
                                            <h4 class="author__title">@lang('app.call')</h4>
                                            <p class="author__meta">@lang('app.by_instrgram')</p>
                                        </div>
                                        <div class="author-box clearfix">
                                            <a target="_blank" href="{{ $school->snapchat }}"> <i class="fab fa-snapchat-square the-icon"></i></a>
                                            <h4 class="author__title">@lang('app.call')</h4>
                                            <p class="author__meta">@lang('app.by_snapchat')</p>
                                        </div>
                                        <div class="author-box clearfix">
                                            <a target="_blank" href="{{ $school->youtube }}"><i class="fab fa-youtube-square the-icon"></i></a>
                                            <h4 class="author__title">@lang('app.call')</h4>
                                            <p class="author__meta">@lang('app.by_youtube')</p>
                                        </div>


                                        <!--<ul class="author__contact">
                                                <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span>00 build., City, Country</li>
                                                <li><span class="la la-phone"><i class="fa fa-phone" aria-hidden="true"></i></span><a href="#">+123 456 789 012ax</a></li>
                                                <li><span class="la la-envelope-o"><i class="fa fa-envelope" aria-hidden="true"></i></span><a href="#">example@companyName.com</a></li>
                                            </ul>-->

                                    </div>
                                </div>
                            </div>
                            <div class="main-search-field-2">
                                <div class="widget-boxed mt-5">
                                    <div class="widget-boxed-header">
                                        <h4>@lang('app.recent_ads')</h4>
                                    </div>
                                    <div class="widget-boxed-body">
                                        <div class="recent-post">
                                            @forelse ($recentAds as $recentAd)
                                                <div class="recent-main my-2">
                                                    <div class="recent-img">
                                                        <a
                                                            href="{{ route('school', [toSlug($recentAd->translate('title')), $recentAd->id]) }}"><img
                                                                src="{{ $recentAd->getFile() }}" alt="" width="90"
                                                                height="70"></a>
                                                    </div>
                                                    <div class="info-img">
                                                        <a
                                                            href="{{ route('school', [toSlug($recentAd->translate('title')), $recentAd->id]) }}">
                                                            <h6>{{ $recentAd->translate('title') }}</h6>
                                                        </a>
                                                    </div>
                                                </div>
                                            @empty

                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                {{-- #SLIDER START --}}
                                <div class="widget-boxed popular mt-5">
                                    <div class="widget-boxed-header">
                                        <h4>@lang('app.may_you_link')</h4>
                                    </div>
                                    <div class="widget-boxed-body">
                                        <div class="the-slider">
                                            @forelse ($featuredAds as $featuredAd)
                                                <div>
                                                    <a href="{{ route('school', [toSlug($featuredAd->translate('title')), $featuredAd->id]) }}"
                                                        class="slider-link">
                                                        <div
                                                            class="badge-container d-flex justify-content-between p-3 align-items-center">

                                                        </div>

                                                        <img src="{{ $featuredAd->getFile() }}"
                                                            alt="{{ $featuredAd->translate('title') }}">

                                                    </a>
                                                </div>

                                            @empty

                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                {{-- #SLIDER END --}}


                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <!-- START SIMILAR PROPERTIES -->
            <section class="similar-property recently portfolio bshd p-0 bg-white-inner">
                <div class="container">
                    <h5>@lang('app.from_the_same_city')</h5>
                    <div class="row portfolio-items">
                        @forelse ($similarAds as $similarAd)
                            <div class="item col-lg-4 col-md-6 col-xs-12 landscapes">
                                <div class="project-single">
                                    <div class="project-inner project-head">
                                        <div class="project-bottom">
                                            <h4><a
                                                    href="{{ route('school', [toSlug($similarAd->translate('title')), $similarAd->id]) }}"></a><span
                                                    class="category">##buldingtype</span>
                                            </h4>
                                        </div>
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="single-property-1.html" class="homes-img">
                                                {{-- <div class="homes-tag button alt featured">New</div> --}}
                                                {{-- <div class="homes-price">Family Home</div> --}}
                                                <img src="{{ $similarAd->getFile() }}"
                                                    alt="{{ $similarAd->translate('title') }}"
                                                    class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="button-effect">
                                            {{-- <a href="single-property-1.html" class="btn"><i
                                                    class="fas fa-link"></i></a>
                                            <a href="https://www.youtube.com/watch?v=2xHQqYRcrx4"
                                                class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                            <a href="single-property-2.html" class="img-poppu btn"><i
                                                    class="fas fa-image"></i></i></a> --}}
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                        <h3><a
                                                href="{{ route('school', [toSlug($similarAd->translate('title')), $similarAd->id]) }}">{{ $similarAd->translate('title') }}</a>
                                        </h3>
                                        <p class="homes-address mb-3">
                                            <a
                                                href="{{ route('school', [toSlug($similarAd->translate('title')), $similarAd->id]) }}">
                                                <i
                                                    class="fa fa-map-marker"></i><span>{{ Str::substr($similarAd->translate('text'), 0, 100) }}</span>
                                            </a>
                                        </p>
                                        <!-- homes List -->
                                        <ul class="homes-list clearfix">
                                            <li>
                                                <i class="fa fa-bed" aria-hidden="true"></i>
                                                <span>{{ $similarAd->governorate->translate('name') }}</span>
                                            </li>
                                            <li>
                                                <i class="fa fa-bath" aria-hidden="true"></i>
                                                <span>{{ $similarAd->region->translate('name') }}</span>
                                            </li>

                                        </ul>
                                        <!-- Price -->
                                        <div class="price-properties">

                                            <div class="compare">
                                                {{-- <a href="#" title="Compare">
                                                    <i class="fas fa-exchange-alt"></i>
                                                </a>
                                                <a href="#" title="Share">
                                                    <i class="fas fa-share-alt"></i>
                                                </a>
                                                <a href="#" title="Favorites">
                                                    <i class="fa fa-heart-o"></i>
                                                </a> --}}
                                            </div>
                                        </div>
                                        <div class="footer">
                                            <div class="footer">
                                                <a target="_blank"
                                                    href="http://api.whatsapp.com/send?phone={{ $similarAd->phone }}">
                                                    <i class="fab fa-whatsapp-square"></i>
                                                    @lang('app.call')
                                                </a>
                                                <a href="tel:{{ $similarAd->phone }}">
                                                    <span>
                                                        <i class="fas fa-phone-square-alt"></i>@lang('app.call_now')
                                                    </span>
                                                </a>
                                                {{-- <a href="agent-details.html">
                                        <i class="fab fa-whatsapp-square"></i> {{ $ad->user->name }}
                                        <span>
                                            <i class="fas fa-phone-square-alt"></i> Call Now
                                        </span>
                                    </a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty

                        @endforelse

                    </div>
                </div>
            </section>
            <!-- END SIMILAR PROPERTIES -->
        </div>
    </section>
    {{-- VIDEO MODAL START --}}
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">


                <div class="modal-body">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9" wire:ignore>
                        <iframe class="embed-responsive-item"
                            src="https://www.youtube.com/embed/{{ $school->video_link }}" id="video" frameborder="0"
                            allowfullscreen></iframe>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- VIDEO MODAL END --}}
    <!-- END SECTION PROPERTIES LISTING -->
    @push('js')

        <script>
            $(document).ready(function() {
                $('.the-slider').slick();
                $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
                    disableOn: 700,
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false
                });
            });
        </script>

    @endpush
    @push('css')
        <style>
            .modal-dialog {
                max-width: 800px;
                margin: 30px auto;
            }

            .modal-body {
                position: relative;
                padding: 0px;
            }

            .close {
                position: absolute;
                right: -30px;
                top: 0;
                z-index: 999;
                font-size: 2rem;
                font-weight: normal;
                color: #fff;
                opacity: 1;
            }

            .slick-slide {
                height: 250px !important;
                transition: all .5s !important;
            }

            .slick-slide:hover .title-info {
                height: 50px;
            }

            .the-slider div {
                margin-top: 10px !important;
            }


            .widget-boxed .slick-prev,
            .widget-boxed .slick-next {
                top: 0;
            }

            .slider-link {
                position: relative;
                display: block;
            }

            .slider-link .badge-container {
                position: absolute !important;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 999;
                height: 40px;
            }

            .slider-link .title {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
            }

            .slider-link .title h3 {
                color: #fff;
                padding: 5px;
            }

            .slider-link .title-info {
                list-style: none;
                height: 0;
                background: #c18847;
                display: flex;
                margin-bottom: 0;
                justify-content: space-between;
                font-size: 16px;
                color: #fff;
                transition: all .5s !important;
            }

            .slider-link .title-info li {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                margin-left: auto;
                margin-right: auto;
            }

            .slider-link .badge-container span {
                /* width: 100px; */
                font-size: 16px;
            }

            .video-btn {
                position: absolute;
                top: 55%;
                left: 50%;
                transform: translate(-95%, -50%);
                background-color: #fff;
                z-index: 99;
                width: 70px;
                height: 70px;
                border-radius: 10px;
            }

            .author-box .fas.fa-phone-alt {
                font-size: 3em;
                float: left;
                width: 50px;
                height: 50px;
                margin-right: 5px;
                color: #274abb;
            }

        </style>
    @endpush
</div>
