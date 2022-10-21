<div>
          <!-- START SECTION PROPERTIES FOR SALE -->
        <section class="featured portfolio bg-white-3">
            <div class="container">
                <div class="row">
                    <div class="section-title col-md-51">
                        <!--<h3>@lang('app.apartments')</h3>-->
                        <h2>@lang('app.for_sale_title')</h2>
                    </div>
                </div>
                <div class="row portfolio-items">
                 @forelse ($saleAds as $saleAd)
                        <div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale">
                        <div class="project-single" data-aos="zoom-in">
                            <div class="listing-item compact">
                                <a href="{{ route('ad.search',[toSlug($saleAd->title),$saleAd->id]) }}" class="listing-img-container">
                                    <div class="listing-badges">
                                        <span class="featured">@lang('app.currency')
                                         {{ $saleAd->price }}</span>
                                        <span>@lang('app.for_sale')</span>
                                    </div>
                                    <div class="listing-img-content">
                                        <span class="listing-compact-title">{{ $saleAd->title }}<i>{{ $saleAd->phone }}</i></span>
                                        <ul class="listing-hidden-content blue">
                                            <li>@lang('app.region') <span>{{ $saleAd->region->translate('name') }} </span></li>
                                            <li>@lang('app.type') <span>{{ $saleAd->buildingType->translate('name') }} </span></li>
                                            <li>@lang('app.views') <span>{{ $saleAd->views }} </span></li>
                                            <li>@lang('app.created_at_ads') <span>{{ $saleAd->created_at->diffForHumans() }}</span></li>
                                        </ul>
                                    </div>
                                    <img src="{{ toAdDefaultImage($saleAd->getFile()) }}" width="350" height="197" alt="{{ $saleAd->title }}">
                                </a>
                            </div>
                        </div>
                    </div>
                     @section('schema')@parent{"image":"{{toAdDefaultImage($saleAd->getFile())}}","@context":"https://schema.org","@type":"Product","url":"{{ route('ad.search',[toSlug($saleAd->title),$saleAd->id]) }}","category":"sale-{{ $saleAd->buildingType->name_en }}","name":"{{ $saleAd->title }}","offers":{"priceCurrency":"KWD","price":"{{ $saleAd->price }}","@type":"Offer"},"description":"{{ str_replace('\\' , '\\\\' , strip_tags($saleAd->text)) }}"},@stop
                 @empty
                    {!! noData() !!}
                 @endforelse

                </div>
                <div class="bg-all">
                    <a href="{{ route('ads.search') }}" class="btn btn-outline-light">@lang('app.view_all')</a>
                </div>
            </div>
        </section>
        <!-- END SECTION PROPERTIES FOR SALE -->
</div>
