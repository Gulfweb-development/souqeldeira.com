<div>
     <x-slot name="meta_title">@lang('app.policy')</x-slot>
    <x-slot name="meta_descrption">{{ Str::limit(strip_tags(isset($policies[0]) ? $policies[0]->translate('name') : __('app.policy') ), 155)  }}</x-slot>
    <x-slot name="og_title">@lang('app.policy')</x-slot>
    <x-slot name="og_description">{{ Str::limit(strip_tags(isset($policies[0]) ? $policies[0]->translate('name') : __('app.policy') ), 155)  }}</x-slot>
    <x-slot name="og_url">{{ Request::url() }}</x-slot>
    <x-slot name="og_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_title">@lang('app.policy')</x-slot>
    <x-slot name="twitter_description">{{ Str::limit(strip_tags(isset($policies[0]) ? $policies[0]->translate('name') : __('app.policy') ), 155)  }}</x-slot>
    <x-slot name="twitter_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_card">@lang('app.policy')</x-slot>
    <!-- Header Container / End -->
    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>@lang('app.details')</h1>
                <h2>
                       <a href="{{ url('/') }}">@lang('app.home') </a>&nbsp;/&nbsp;
                    @lang('app.policy')</h2>
                </h2>
            </div>
        </div>
    </section>
    <!-- START SECTION PROPERTIES LISTING -->
    <section class="single-proper blog details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 blog-pots">
                    <div class="row">
                        <div class="col-md-12">
                            <section class=" pt-4">
                                {{-- <div class="pro-wrapper">
                                    <div class="detail-wrapper-body">
                                        <div class="listing-title-bar">
                                            <h3>{{ $ad->translate('title') }} <span
                                                    class="mrg-l-5 category-tag">{{ $ad->type }}</span></h3>
                                            <div class="mt-0">
                                                <a href="javascript:void(0);" class="listing-address text-secondary">
                                                    <i
                                                        class="fa fa-map-marker pr-2 ti-location-pin mrg-r-5"></i>asdads
                                                    - hadjkhassajkd
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single detail-wrapper mr-2">
                                        <div class="detail-wrapper-body">
                                            <div class="listing-title-bar">
                                                <h4>@lang('app.currency') {{ number_format($ad->price, 0) }}</h4>
                                                <div class="mt-0">
                                                    <a href="javascript:void(0);"
                                                        class="listing-address text-secondary">
                                                        <p>{{ $ad->distance }} / @lang('app.size_meter')</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
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
                            {{-- <div class="floor-plan property wprt-image-video w50 pro">
                                <h5>{{ $blog->translate('title') }}</h5>
                                <img alt="image" src="{{ $blog->getFile() }}">
                            </div> --}}
                            <div class="blog-info details mb-30">
                                <h5 class="mb-4">@lang('app.policies')</h5>
                             <ul>
                                 @forelse ($policies as $policy)
                                      <li class="lead mb-4"><h6 class="lead font-weight-normal">{{ $policy->translate('name') }}</h6></li>
                                 @empty
                                     {!! noData() !!}
                                 @endforelse

                             </ul>
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



                </div>
                {{-- <aside class="col-lg-4 col-md-12 car">
                    <div class="single widget">
                        <!-- end author-verified-badge -->
                        <div class="sidebar">

                            <div class="main-search-field-2">
                                <div class="widget-boxed mt-5">
                                    <div class="widget-boxed-header">
                                        <h4>@lang('app.recent_blogs')</h4>
                                    </div>
                                    <div class="widget-boxed-body">
                                        <div class="recent-post">
                                            @forelse ($recentBlogs as $recentBlog)
                                                <div class="recent-main my-2">
                                                    <div class="recent-img">
                                                        <a
                                                            href="{{ route('blog', [toSlug($recentBlog->translate('title')), $recentBlog->id]) }}"><img
                                                                src="{{ $recentBlog->getFile() }}" alt="" width="90"
                                                                height="70"></a>
                                                    </div>
                                                    <div class="info-img">
                                                        <a
                                                            href="{{ route('blog', [toSlug($recentBlog->translate('title')), $recentBlog->id]) }}">
                                                            <h6>{{ $recentBlog->translate('title') }}</h6>
                                                        </a>

                                                    </div>
                                                </div>
                                            @empty

                                            @endforelse
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </aside> --}}
            </div>

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
                        {{-- <iframe class="embed-responsive-item"
                            src="https://www.youtube.com/embed/{{ $ad->video_link }}" id="video" frameborder="0"
                            allowfullscreen></iframe> --}}
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
