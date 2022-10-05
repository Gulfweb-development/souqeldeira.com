<div>
    <x-slot name="meta_title">@lang('app.app_name')</x-slot>
    <x-slot name="meta_descrption">@lang('app.app_name')</x-slot>
    <x-slot name="og_title">@lang('app.app_name')</x-slot>
    <x-slot name="og_description">@lang('app.app_name')</x-slot>
    <x-slot name="og_url">{{ Request::url() }}</x-slot>
    <x-slot name="og_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_title">@lang('app.app_name')</x-slot>
    <x-slot name="twitter_description">@lang('app.app_name')</x-slot>
    <x-slot name="twitter_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_card">@lang('app.app_name')</x-slot>
        @livewire('frontend.components.home-search')
      
        @livewire('frontend.components.for-sale')
        @livewire('frontend.components.for-rent')

        <!-- START SECTION BLOG -->
        <section class="blog-section bg-white-2">
            <div class="container">
                <div class="row">
                    <div class="section-title col-md-5">
                        <h3>Last &amp;</h3>
                        <h2>Offers</h2>
                    </div>
                </div>
                <div class="news-wrap">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-xs-12">
                            <div class="news-item" data-aos="fade-up">
                                <a href="blog-details.html" class="news-img-link">
                                    <div class="news-item-img">
                                        <img class="img-responsive" src="images/blog/b-1.jpg" alt="blog image">
                                    </div>
                                </a>
                                <div class="news-item-text">
                                    <a href="blog-details.html"><h3>ALDira Market</h3></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-xs-12">
                            <div class="news-item" data-aos="fade-up">
                                <a href="blog-details.html" class="news-img-link">
                                    <div class="news-item-img">
                                        <img class="img-responsive" src="images/blog/b-2.jpg" alt="blog image">
                                    </div>
                                </a>
                                <div class="news-item-text">
                                    <a href="blog-details.html"><h3>Test Site New </h3></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-xs-12">
                            <div class="news-item no-mb" data-aos="fade-up">
                                <a href="blog-details.html" class="news-img-link">
                                    <div class="news-item-img">
                                        <img class="img-responsive" src="images/blog/b-3.jpg" alt="blog image">
                                    </div>
                                </a>
                                <div class="news-item-text">
                                    <a href="blog-details.html"><h3>All Places in kuwait city </h3></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END SECTION BLOG -->

        @livewire('frontend.components.home-clients')

    </div>
