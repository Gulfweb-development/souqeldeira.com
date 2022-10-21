<div>
        <!-- START SECTION PROPERTIES FOR RENT -->
        <section class="featured portfolio bg-white-3">
            <div class="container">
                <div class="row">
                    <div class="section-title col-md-51">
                        <!--<h3>@lang('app.apartments')</h3>-->
                        <h2>@lang('app.for_rent_title')</h2>
                    </div>
                </div>
                <div class="row portfolio-items">
                  @forelse ($rentAds as $rentAd)
                        <div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale">
                        <div class="project-single" data-aos="zoom-in">
                            <div class="listing-item compact">
                                <a href="{{ route('ad.search',[toSlug($rentAd->title),$rentAd->id]) }}" class="listing-img-container">
                                    <div class="listing-badges">
                                        <span class="featured">@lang('app.currency') {{ $rentAd->price }}</span>
                                        <span class="rent">@lang('app.for_rent')</span>
                                    </div>
                                    <div class="listing-img-content">
                                        <span class="listing-compact-title">{{ $rentAd->title }} <i>{{ $rentAd->phone }}</i></span>
                                        <ul class="listing-hidden-content blue">
                                            <li>@lang('app.region') <span>{{ $rentAd->region->translate('name') }} </span></li>
                                            <li>@lang('app.type') <span>{{ $rentAd->buildingType->translate('name') }} </span></li>
                                            <li>@lang('app.views') <span>{{ $rentAd->views }} </span></li>
                                            <li>@lang('app.created_at_ads') <span>{{ $rentAd->created_at->diffForHumans() }}</span></li>
                                        </ul>
                                    </div>
                                    <img src="{{ toAdDefaultImage($rentAd->getFile()) }}" alt="{{ $rentAd->title }}">
                                </a>
                            </div>
                        </div>
                    </div>
                        @section('schema')@parent{"image":"{{toAdDefaultImage($rentAd->getFile())}}","@context":"https://schema.org","@type":"Product","url":"{{ route('ad.search',[toSlug($rentAd->title),$rentAd->id]) }}","category":"rent-{{ $rentAd->buildingType->name_en }}","name":"{{ $rentAd->title }}","offers":{"priceCurrency":"KWD","price":"{{ $rentAd->price }}","@type":"Offer"},"description":"{{ str_replace('\\' , '\\\\' , strip_tags($rentAd->text)) }}"},@stop
                  @empty
                      {!! noData() !!}
                  @endforelse

                </div>
                <div class="bg-all">
                    <a href="{{ route('ads.search') }}" class="btn btn-outline-light">@lang('app.view_all')</a>
                </div>
            </div>
        </section>

        <!-- END SECTION PROPERTIES FOR RENT -->
</div>
