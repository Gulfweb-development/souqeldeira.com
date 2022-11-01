<div>
 <x-slot name="meta_title">{{ \App\Http\Controllers\Frontend\FrontendLangController::setting()->translate('title') .' - '.$ad->title }}</x-slot>
    <x-slot name="meta_descrption">{{ Str::limit(strip_tags($ad->text), 155)  }}</x-slot>
    <x-slot name="og_title">{{  \App\Http\Controllers\Frontend\FrontendLangController::setting()->translate('title') .' - '. $ad->title }}</x-slot>
    <x-slot name="og_description">{{ Str::limit(strip_tags($ad->text), 155)  }}</x-slot>
    <x-slot name="og_url">{{ Request::url() }}</x-slot>
    <x-slot name="og_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_title">{{  \App\Http\Controllers\Frontend\FrontendLangController::setting()->translate('title') .' - '. $ad->title }}</x-slot>
    <x-slot name="twitter_description">{{ Str::limit(strip_tags($ad->text), 155)  }}</x-slot>
    <x-slot name="twitter_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_card">{{  \App\Http\Controllers\Frontend\FrontendLangController::setting()->translate('title') .' - '. $ad->title }}</x-slot>
    <!-- Header Container / End -->
    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>{{ $ad->title }}</h1>
                <h2>
                    <a href="{{ url('/') }}">@lang('app.home') </a>&nbsp;/&nbsp;
                    <a href="{{ route('ads.search') }}">@lang('app.ads') </a>
                    &nbsp;/&nbsp;{{ $ad->title }}
                </h2>
            </div>
        </div>
    </section>
    <!-- START SECTION PROPERTIES LISTING -->
    <section class="single-proper blog details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section class="headings-2 pt-0 pb-4">
                        <div class="pro-wrapper row">
                            <div class="col-md-8 col-sm-12">
                                <div class="listing-title-bar">
                                    <h3>{{ $ad->title }}</h3>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12 @if(app()->getLocale() == 'ar') text-left @else text-right @endif">
                                <div class="detail-wrapper-body">
                                    <div class="listing-title-bar">
                                        <h4>@lang('app.currency') {{ number_format($ad->price, 0) }} <span class="mrg-l-5 category-tag">{{ $ad->type }}</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pro-wrapper row">
                            <div class="col-md-6 col-sm-12">
                                <div class="mt-4">
                                        <a href="javascript:void(0);" class="listing-address text-secondary">
                                            <i
                                                class="fa fa-map-marker pr-2 pl-2 ti-location-pin mrg-r-5"></i>{{ $ad->governorate->translate('name') }}
                                            - {{ $ad->region->translate('name') }}
                                        </a>
                                    </div>
                            </div>

                            <div class="col-md-6 col-sm-12 @if(app()->getLocale() == 'ar') text-left @else text-right @endif">
                                <div class="mt-4">
                                            @if (authApprovedUser())
                                            @if ($ad->favorites()->where('user_id', user()->id)->count() > 0)
                                            <span title="@lang('app.remove_from_favorite')" style="color:#ff0000;cursor:pointer;" wire:click.prevent="deleteFromFavorite({{ $ad->id }})"><i class="fas fa-heart"></i>@lang('app.remove_from_favorite')</span>
                                            @else
                                            <span title="@lang('app.add_to_favorite')" style="cursor:pointer;" wire:click.prevent="addToFavorite({{ $ad->id }})"><i class="fas fa-heart"></i>@lang('app.add_to_favorite')</span>
                                            @endif
                                            @endif
                                            <span class="mr-3 ml-3" title="@lang('app.whatsapp')"><a target="_blank" style="font-size:14px;"
                                                href="https://api.whatsapp.com/send?phone=+965{{ $ad->phone }}&text={{ __('app.whatsapp_text' , ['url' => route('ad.search', [toSlug($ad->title), $ad->id]) ] ) }}"><i class="fab  fa-whatsapp-square mr-1 ml-1"></i> {{ $ad->phone }}</a></span>
                                            <span class="mr-3 ml-3" title="@lang('app.phone')"><a target="_blank" style="font-size:14px;"  href="tel:{{$ad->phone}}"><i class="fa fa-phone mr-1 ml-1"></i> {{ $ad->phone }}</a></span>
                                            <span class="mr-3 ml-3" title="@lang('app.views')"><i class="fa fa-eye mr-1 ml-1"></i> {{ $ad->views }}</span>
                                            <span class="mr-3 ml-3" title="@lang('app.created_at_ads') {{ $ad->created_at->format('Y/m/d H:i:s') }}"><i class="fa fa-calendar-alt mr-1 ml-1"></i> {{ $ad->created_at->diffForHumans() }}</span>
                                            
                                        </div>



                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 blog-pots">
                    <div class="floor-plan property wprt-image-video w50 pro">
                        {{--
                        <div class="d-flex justify-content-between align-items-center">
                            <!--<h5>@lang('app.floor_plans')</h5>-->
                            <h5>
                                @if (authApprovedUser())
                                    @if ($ad->favorites()->where('user_id', user()->id)->count() > 0)
                                        <button title="@lang('app.add_to_favorite')"
                                                class="btn favorite-btn bg-main text-light"
                                                wire:click.prevent="deleteFromFavorite({{ $ad->id }})"><i
                                                class="fas fa-heart"></i></button>
                                    @else
                                        <button class="btn favorite-btn"
                                                wire:click.prevent="addToFavorite({{ $ad->id }})"><i
                                                class="fas fa-heart"></i></button>
                                    @endif
                                @endif
                            </h5>
                        </div>
                        --}}
                        <img alt="{{ $ad->title }}" src="{{ toAdDefaultImage($ad->getFile()) }}">
                    </div>
                    <div class="blog-info details mb-30">
                        <h5 class="mb-4">@lang('app.description')</h5>
                        <div @if(isArabic(strip_tags($ad->text))) class="text-right" dir="rtl" @else class="text-left" dir="ltr" @endif>
                            {!! $ad->text!!}
                        </div>
                    </div>
                    <div class="single homes-content details mb-30">
                        <!-- title -->
                        <h5 class="mb-4">@lang('app.details')</h5>
                        <ul class="homes-list clearfix">

                            <li>
                                <span class="font-weight-bold mr-1">@lang('app.governorate'):</span>
                                <span class="det">{{ $ad->governorate->translate('name') }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">@lang('app.region'):</span>
                                <span class="det">{{ $ad->region->translate('name') }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">@lang('app.price'):</span>
                                <span class="det">{{ $ad->price }}</span>
                            </li>

                            <li>
                                <span class="font-weight-bold mr-1">@lang('app.user'):</span>
                                <span class="det">{{ $ad->user->name }}</span>
                            </li>

                            <li>
                                <span class="font-weight-bold mr-1">@lang('app.phone'):</span>
                                <span class="det">{{ $ad->phone }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">@lang('app.type'):</span>
                                <span class="det">{{ $ad->type }}</span>
                            </li>

                            <li>
                                <span class="font-weight-bold mr-1">@lang('app.building_type'):</span>
                                <span class="det">{{ $ad->buildingType->translate('name') }}</span>
                            </li>

                            <li>
                                <span class="font-weight-bold mr-1">@lang('app.views'):</span>
                                <span class="det">{{ $ad->views }}</span>
                            </li>

                            <li>
                                <span class="font-weight-bold mr-1">@lang('app.created_at_ads'):</span>
                                <span class="det" title="{{ $ad->created_at->format('Y/m/d H:i:s') }}">{{ $ad->created_at->diffForHumans() }}</span>
                            </li>

                        </ul>


                    </div>

                    <!-- Star Reviews -->
                    @livewire('frontend.components.comments',['ad' => $ad])
                    <!-- End Add Review -->

                </div>
                <aside class="col-lg-4 col-md-12 car">
                    <div class="single widget">
                        <!-- end author-verified-badge -->
                        <div class="sidebar">
                            <div class="widget-boxed mt-33">
                                <div class="widget-boxed-header">
                                    <h4>@lang('app.information')</h4>
                                </div>
                                <div class="widget-boxed-body">
                                    <div class="sidebar-widget author-widget2">
                                        @php
     $url = url('adasdsasad/'.toSlug($ad->title).'/'.$ad->id);
     $whatsapptxt = trans('app.whatsapp_text');
     $whatsapplink = "https://api.whatsapp.com/send?text=".urlencode($ad->title)."%0a".urlencode($url);
     @endphp
     <div class="author-box clearfix">
         <a style="margin:5;pxfloat:left;color:#3b5998;" target="_blank" href="https://www.facebook.com/sharer.php?u={{$url}}"><i class="fab fa-facebook fa-2x"></i></a>
         <a style="margin:5;pxfloat:left;color:#00acee;"  target="_blank" href="https://twitter.com/share?url={{$url}}&text={{$ad->title}}&via=website&hashtags=#aldeiramarket"><i class="fab fa-twitter fa-2x"></i></a>
         <a style="margin:5;pxfloat:left;color:#db4a39;"  target="_blank" href="https://plus.google.com/share?url={{$url}}"><i class="fab fa-google-plus fa-2x"></i></a>
         <a style="margin:5;pxfloat:left;color:#E60023"  target="_blank"  href="https://pinterest.com/pin/create/bookmarklet/?media={{toAdDefaultImage($ad->getFile())}}&url={{$url}}&is_video=&description={{$ad->title}}"><i class="fab fa-pinterest fa-2x"></i></a>
         <a style="margin:5;pxfloat:left;color:#0077b5"  target="_blank" href="https://www.linkedin.com/shareArticle?url={{$url}}&title={{$ad->title}}"><i class="fab fa-linkedin fa-2x"></i></a>
         <a style="margin:5;pxfloat:left;color:#128C7E"  target="_blank"  href="{!!$whatsapplink!!}"><i class="fab fa-whatsapp fa-2x"></i></a>
        


         
     </div>
                                        <div class="author-box clearfix">
                                            <a target="_blank"
                                                href="https://api.whatsapp.com/send?phone=+965{{ $ad->phone }}&text={{ __('app.whatsapp_text' , ['url' => route('ad.search', [toSlug($ad->title), $ad->id]) ] ) }}"> <i
                                                    class="fab fa-whatsapp-square"></i></a>
                                            <h4 class="author__title">{{ $ad->user->name }}</h4>
                                            <p class="author__meta">@lang('app.agent_of_property')</p>
                                        </div>
                                        <div class="author-box clearfix">
                                            <a href="tel:{{ $ad->phone }}"> <i class="fas fa-phone-alt"></i></a>
                                            <h4 class="author__title">@lang('app.call_now')</h4>
                                            <!--<p class="author__meta">@lang('app.better_from_mobile')</p>-->
                                            <p class="author__meta">
                                                <a href="tel:{{ $ad->phone }}">{{ $ad->phone }}</a>
                                            </p>
                                        </div>
                                        <!--<div class="author-box clearfix">-->
                                        <!--    <a href="javascript:void(0);"> <i class="fas fa-mobile-alt"></i></a>-->
                                        <!--    <h4 class="author__title">{{ $ad->phone }}</h4>-->
                                            <!--<p class="author__meta">@lang('app.kw_phone')</p>-->
                                        <!--</div>-->


                                        <!--<ul class="author__contact">
                                                <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span>00 build., City, Country</li>
                                                <li><span class="la la-phone"><i class="fa fa-phone" aria-hidden="true"></i></span><a href="#">+123 456 789 012ax</a></li>
                                                <li><span class="la la-envelope-o"><i class="fa fa-envelope" aria-hidden="true"></i></span><a href="#">example@companyName.com</a></li>
                                            </ul>-->
                                        <div class="agent-contact-form-sidebar">
                                            <h4>@lang('app.contact_owner')</h4>
                                            {{-- <form name="contact_form" method="post" action="functions.php"> --}}
                                            {{-- <input type="text" id="fname" name="full_name" placeholder="Full Name"
                                                    required />
                                                <input type="number" id="pnumber" name="phone_number"
                                                    placeholder="Phone Number" required /> --}}
                                            {{-- <input type="email" id="emailid" name="email_address"
                                                    placeholder="Email Address" required /> --}}
                                            <textarea placeholder="@lang('app.message')"
                                                wire:model.defer="text"></textarea>
                                            @error('text')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            <input type="button" name="sendmessage" class="multiple-send-message"
                                                value="@lang('app.send')" wire:loading.attr="disabled"
                                                wire:click.prevent="send" />
                                            {{-- </form> --}}
                                        </div>
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
                                                <div class="recent-main1 my-2 row">
                                                    <div class="col-4">
                                                        <div class="recent-img">
                                                            <a
                                                                href="{{ route('ad.search', [toSlug($recentAd->title), $recentAd->id]) }}"><img
                                                                    src="{{ toAdDefaultImage($recentAd->getFile()) }}" alt="{{ $recentAd->title }}" width="90"
                                                                    height="70"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="info-img">
                                                            <a
                                                                href="{{ route('ad.search', [toSlug($recentAd->title), $recentAd->id]) }}">
                                                                <h6>{{ $recentAd->title }}</h6>
                                                            </a>
                                                            <p>@lang('app.currency') {{ $recentAd->price }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty

                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                {{-- #SLIDER START --}}
{{--                                <div class="widget-boxed popular mt-5">--}}
{{--                                    <div class="widget-boxed-header">--}}
{{--                                        <h4>@lang('app.featured_videos')</h4>--}}
{{--                                    </div>--}}
{{--                                    <div class="widget-boxed-body">--}}
{{--                                        <div class="the-slider" wire:ignore>--}}
{{--                                            @forelse ($featuredAds as $featuredAd)--}}
{{--                                                <div>--}}
{{--                                                    <a href="{{ route('ad.search', [toSlug($featuredAd->title), $featuredAd->id]) }}"--}}
{{--                                                        class="slider-link">--}}
{{--                                                        <div--}}
{{--                                                            class="badge-container d-flex justify-content-between p-3 align-items-center">--}}
{{--                                                            <span--}}
{{--                                                                class="badge badge-success d-flex justify-content-center align-items-center">@lang('app.currency')--}}
{{--                                                                {{ $featuredAd->price }}</span>--}}
{{--                                                            <span--}}
{{--                                                                class="badge badge-danger d-flex justify-content-center align-items-center">{{ $featuredAd->type }}</span>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="title">--}}
{{--                                                            <h3>{{ $featuredAd->title }}</h3>--}}
{{--                                                            <ul class="title-info">--}}
{{--                                                                --}}{{-- <li>@lang('app.area')--}}
{{--                                                                    <span>{{ $featuredAd->distance }}--}}
{{--                                                                        @lang('app.size_meter')</span>--}}
{{--                                                                </li> --}}
{{--                                                                --}}{{-- <li>@lang('app.rooms')--}}
{{--                                                                    <span>{{ $featuredAd->rooms_count }}</span>--}}
{{--                                                                </li> --}}
{{--                                                                --}}{{-- <li>Beds <span>2</span></li> --}}
{{--                                                                <li>@lang('app.phone')--}}
{{--                                                                    <span>{{ $featuredAd->phone }}</span>--}}
{{--                                                                </li>--}}
{{--                                                            </ul>--}}
{{--                                                        </div>--}}
{{--                                                        <img src="{{ toAdDefaultImage($featuredAd->getFile()) }}"--}}
{{--                                                            alt="{{ $featuredAd->title }}">--}}

{{--                                                    </a>--}}
{{--                                                </div>--}}

{{--                                            @empty--}}

{{--                                            @endforelse--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
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
                    <div class="row portfolio-items1">
                        @forelse ($similarAds as $similarAd)
                            <div class="item col-lg-4 col-md-6 col-xs-12 landscapes">
                                <div class="project-single">
                                    <div class="project-inner project-head">
                                        <div class="project-bottom">
                                            <h4><a
                                                    href="{{ route('ad.search', [toSlug($similarAd->title), $similarAd->id]) }}"></a><span
                                                    class="category">{{ $similarAd->buildingType->translate('name') }}</span>
                                            </h4>
                                        </div>
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="single-property-1.html" class="homes-img">
                                                {{-- <div class="homes-tag button alt featured">New</div> --}}
                                                <div class="homes-tag button alt sale">{{ $similarAd->type }}</div>
                                                {{-- <div class="homes-price">Family Home</div> --}}
                                                <img src="{{ toAdDefaultImage($similarAd->getFile()) }}"
                                                    alt="{{ $similarAd->title }}" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="button-effect">
                                            @if (authApprovedUser())
                                                @if ($similarAd->favorites()->where('user_id', user()->id)->count() > 0)
                                                    <button class="btn favorite-btn bg-light"
                                                        wire:click.prevent="deleteFromFavorite({{ $similarAd->id }})"><i
                                                            class="fas fa-heart color-main"></i></button>
                                                @else
                                                    <button class="btn favorite-btn bg-main"
                                                        wire:click.prevent="addToFavorite({{ $similarAd->id }})"><i
                                                            class="fas fa-heart"></i></button>
                                                @endif
                                            @endif
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
                                        <h3><a href="{{ route('ad.search', [toSlug($similarAd->title), $similarAd->id]) }}">{{ $similarAd->title }}</a></h3>
                                        <p class="homes-address mb-3">
                                            {!! Str::substr($similarAd->text, 0, 100) !!}</span>

                                        </p>
                                        <!-- homes List -->
                                        <ul class="homes-list clearfix">
                                            <li>
                                                <i class="fas fa-map-marker"></i>
                                                <span>{{ $similarAd->governorate->translate('name') }}</span>
                                            </li>
                                            <li>

                                                <i class="fas fa-map-marker"></i>
                                                <span>{{ $similarAd->region->translate('name') }}</span>
                                            </li>
                                            <li>
                                                <i class="fas fa-mobile-alt"></i>
                                                <span>{{ $similarAd->phone }} </span>
                                            </li>
                                            <li>
                                                <i class="fas fa-building"></i>
                                                <span>{{ $similarAd->buildingType->translate('name') }}</span>
                                            </li>
                                        </ul>
                                        <!-- Price -->
                                        <div class="price-properties">
                                            <h3 class="title mt-3">
                                                <a href="javascript:void(0);">@lang('app.currency')
                                                    {{ $similarAd->price }}</a>
                                            </h3>
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
                                                    href="http://api.whatsapp.com/send?phone=+965{{ $similarAd->phone }}&text={{ __('app.whatsapp_text' , ['url' => route('ad.search', [toSlug($similarAd->title), $similarAd->id]) ] ) }}">
                                                    <i class="fab fa-whatsapp-square"></i>
                                                    {{ $similarAd->user->name }}
                                                </a>
                                                <a href="tel:{{ $similarAd->phone }}">
                                                    <span>
                                                        <i class="fas fa-phone-square-alt"></i> @lang('app.call_now')
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
                            src="https://www.youtube.com/embed/{{ $ad->video_link }}" id="video" frameborder="0"
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

            .author-box .fas.fa-phone-alt,
            .author-box .fas.fa-mobile-alt {
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
@section('schema2'){"image":"{{toAdDefaultImage($ad->getFile())}}","@context":"https://schema.org","@type":"Product","url":"{{ route('ad.search',[toSlug($ad->title),$ad->id]) }}","category":"{{ strtolower($ad->type) }}-{{ $ad->buildingType->name_en }}","name":"{{ $ad->title }}","offers":{"priceCurrency":"KWD","price":"{{ $ad->price }}","@type":"Offer"},"description":"{{ str_replace('\\' , '\\\\' , strip_tags($ad->text)) }}"}@stop
