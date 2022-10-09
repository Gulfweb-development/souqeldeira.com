<div>
    <x-slot name="meta_title">@lang('app.ads')</x-slot>
    <x-slot name="meta_descrption">@lang('app.ads')</x-slot>
    <x-slot name="og_title">@lang('app.ads')</x-slot>
    <x-slot name="og_description">@lang('app.ads')</x-slot>
    <x-slot name="og_url">{{ Request::url() }}</x-slot>
    <x-slot name="og_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_title">@lang('app.ads')</x-slot>
    <x-slot name="twitter_description">@lang('app.ads')</x-slot>
    <x-slot name="twitter_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_card">@lang('app.ads')</x-slot>
    <!-- START SECTION HEADINGS -->
    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>@lang('app.real_estates')</h1>
                <h2><a href="{{ url('/') }}">@lang('app.home') </a> &nbsp;/&nbsp; @lang('app.ads')</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->
    <!-- START SECTION PROPERTIES LISTING -->
    <section class="properties-list featured portfolio blog">
        <div class="container">
            <section class="headings-2 pt-0 pb-0">
                <div class="pro-wrapper">
                    <div class="detail-wrapper-body">
                        <div class="listing-title-bar">
                            <div class="text-heading text-left">
                                <p><a href="{{ url('/') }}">@lang('app.home') </a> &nbsp;/&nbsp;
                                    <span>@lang('app.list')</span>
                                </p>
                            </div>
                            <h3>@lang('app.ads')</h3>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Search Form -->
            <div class="hero-inner" wire:ignore>

                <!-- Welcome Text -->
                <div class="welcome-text">
                    <ul class="nav nav-tabs rld-banner-tab d-flex justify-content-around">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs_1">@lang('app.search')</a>
                        </li>
                    </ul>
                </div>
                <!--/ End Welcome Text -->
                <!-- Search Form -->
                <div class="banner-search-wrap">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tabs_1">
                            <div class="rld-main-search">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                        <div class="rld-single-select ml-22">
                                            <select id="governorate_id" class="select single-select mr-0 governorate_id"
                                                name="governorate_id" onchange="return onGovernorateChange(event);">
                                                <option value="">@lang('app.governorates')</option>
                                                @forelse ($governorates as $governorate)
                                                    <option value="{{ $governorate->id }}">
                                                        {{ $governorate->translate('name') }}</option>
                                                @empty
                                                    <option value="">@lang('app.no_data')</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                        <div class="rld-single-select ml-22">
                                            <select class="select single-select mr-0 region_id" id="region_id"
                                                onchange="return onRegionChange(event);">
                                                <option value="">@lang('app.regions')</option>
                                                @forelse ($regions as $region)
                                                    <option value="{{ $region->id }}">
                                                        {{ $region->translate('name') }}</option>
                                                @empty
                                                    <option value="">@lang('app.no_data')</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                        <div class="rld-single-select ml-22">
                                            <select class="select single-select building_type_id"
                                                onchange=" onBuildingTypeChange(event);" wire:model="building_type_id">
                                                <option value="" wire:model="building_type_id">
                                                    @lang('app.building_type')</option>
                                                @forelse ($buildingTypes as $buildingType)
                                                    <option value="{{ $buildingType->id }}">
                                                        {{ $buildingType->translate('name') }}</option>
                                                @empty
                                                    <option value="">@lang('app.no_data')</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                        <div class="rld-single-select ml-22">
                                            <select class="select single-select type" onchange="onTypeChange(event);"
                                                wire:model="type">
                                                <option value="">@lang('app.type')</option>
                                                <option value="SALE">@lang('app.sale')</option>
                                                <option value="RENT">@lang('app.rent')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                        <div class="dropdown-filter rld-single-select ml-22">
                                            @lang('app.advanced_search')
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4">
                                        <a class="btn btn-yellow" href="#"
                                            wire:click.prevent="search">@lang('app.search_now')</a>
                                    </div>
                                    <div class="explore__form-checkbox-list full-filter">
                                        <div class="row">
                                            {{-- <div class="col-xl-3 col-lg-3 col-md-3 pl-0">
                                                <div class="rld-single-select ml-22">
                                                    <select class="select single-select rooms_count"
                                                        onchange="onRoomsChange(event);">
                                                        <option value="">@lang('app.rooms_count')</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 pl-0">
                                                <div class="rld-single-select ml-22">
                                                    <select class="select single-select bathrooms_count"
                                                        onchange="onBathRoomChange(event);">
                                                        <option value="">@lang('app.bathrooms_count')
                                                        </option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                            </div> --}}

                                            <div class="col-xl-6 col-lg-6 col-md-6 pl-0">
                                                <div class="rld-single-select ml-22">
                                                    <input type="price_from form-control" name="price_from"
                                                        onchange="onPriceFromChange(event);"
                                                        placeholder="@lang('app.price_from')">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 pl-0">
                                                <div class="rld-single-select ml-22">
                                                    <input type="price_to form-control" name="price_to"
                                                        onchange="onPriceToChange(event);"
                                                        placeholder="@lang('app.price_to')">
                                                </div>
                                            </div>

                                            <div class="col-lg-5 col-md-12 col-sm-12 py-1 pr-30 mr-5 sld">
                                                <!-- Price Fields -->
                                                {{-- <div class="main-search-field-2">
                                                                <!-- Area Range -->
                                                                <div class="range-slider">
                                                                    <label>Area Size</label>
                                                                    <div id="area-range" data-min="0" data-max="1300"
                                                                        data-unit="sq ft"></div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <br>
                                                                <!-- Price Range -->
                                                                <div class="range-slider">
                                                                    <label>Price Range</label>
                                                                    <div id="price-range" data-min="0" data-max="600000"
                                                                        data-unit="KD"></div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </div> --}}
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30">
                                                <!-- Checkboxes -->
                                                {{-- <div class="checkboxes one-in-row margin-bottom-10 ch-1">
                                                                <input id="check-2" type="checkbox" name="check">
                                                                <label for="check-2">AC</label>
                                                                <input id="check-3" type="checkbox" name="check">
                                                                <label for="check-3">Swimming Pool</label>
                                                                <input id="check-4" type="checkbox" name="check">
                                                                <label for="check-4">Central Heating</label>
                                                                <input id="check-5" type="checkbox" name="check">
                                                                <label for="check-5">Laundry Room</label>
                                                                <input id="check-6" type="checkbox" name="check">
                                                                <label for="check-6">Gym</label>
                                                                <input id="check-7" type="checkbox" name="check">
                                                                <label for="check-7">Alarm</label>
                                                                <input id="check-8" type="checkbox" name="check">
                                                                <label for="check-8">Wifi</label>
                                                            </div> --}}
                                                <!-- Checkboxes / End -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs_2">
                            <div class="rld-main-search">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-xl-2 col-lg-2 col-md-4">
                                        <div class="rld-single-select">
                                            <select class="select single-select mr-0 d-none">
                                                <option value="1">Country</option>
                                                <option value="2">Kuwait City</option>
                                                <option value="3">salwa</option>
                                                <option value="3">Salmay</option>
                                                <option value="3">Alahmadi</option>
                                                <option value="3">Farwaniya</option>
                                                <option value="3">ELmangaf</option>
                                            </select>
                                            <div class="nice-select select single-select mr-0" tabindex="0"><span
                                                    class="current">Country</span>
                                                <ul class="list">
                                                    <li data-value="1" class="option selected">Country</li>
                                                    <li data-value="2" class="option">Kuwait City</li>
                                                    <li data-value="3" class="option">salwa</li>
                                                    <li data-value="3" class="option">Salmay</li>
                                                    <li data-value="3" class="option">Alahmadi</li>
                                                    <li data-value="3" class="option">Farwaniya</li>
                                                    <li data-value="3" class="option">ELmangaf</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4">
                                        <div class="rld-single-select">
                                            <select class="select single-select mr-0 d-none">
                                                <option value="1">City</option>
                                                <option value="2">Kuwait City</option>
                                                <option value="3">salwa</option>
                                                <option value="3">Salmay</option>
                                                <option value="3">Alahmadi</option>
                                                <option value="3">Farwaniya</option>
                                                <option value="3">ELmangaf</option>
                                            </select>
                                            <div class="nice-select select single-select mr-0" tabindex="0"><span
                                                    class="current">City</span>
                                                <ul class="list">
                                                    <li data-value="1" class="option selected">City</li>
                                                    <li data-value="2" class="option">Kuwait City</li>
                                                    <li data-value="3" class="option">salwa</li>
                                                    <li data-value="3" class="option">Salmay</li>
                                                    <li data-value="3" class="option">Alahmadi</li>
                                                    <li data-value="3" class="option">Farwaniya</li>
                                                    <li data-value="3" class="option">ELmangaf</li>
                                                </ul>
                                            </div>



                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-4">
                                        <div class="rld-single-select">
                                            <select class="select single-select d-none">
                                                <option value="1">Property Type</option>
                                                <option value="2">Family House</option>
                                                <option value="3">Apartment</option>
                                                <option value="3">Real Estates</option>
                                            </select>
                                            <div class="nice-select select single-select" tabindex="0"><span
                                                    class="current">Property Type</span>
                                                <ul class="list">
                                                    <li data-value="1" class="option selected">Property Type</li>
                                                    <li data-value="2" class="option">Family House</li>
                                                    <li data-value="3" class="option">Apartment</li>
                                                    <li data-value="3" class="option">Real Estates</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-4">
                                        <div class="dropdown-filter rld-single-select">Advanced Search</div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-4">
                                        <a class="btn btn-yellow" href="#">Search Now</a>
                                    </div>
                                    <div class="explore__form-checkbox-list full-filter">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0">
                                                <!-- Form Property Status -->
                                                <div class="form-group categories">
                                                    <div class="nice-select form-control wide" tabindex="0"><span
                                                            class="current"><i
                                                                class="fa fa-home"></i>Property Status</span>
                                                        <ul class="list">
                                                            <li data-value="1" class="option selected ">For Sale</li>
                                                            <li data-value="2" class="option">For Rent</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!--/ End Form Property Status -->
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 ">
                                                <!-- Form Bedrooms -->
                                                <div class="form-group beds">
                                                    <div class="nice-select form-control wide" tabindex="0"><span
                                                            class="current"><i class="fa fa-bed"
                                                                aria-hidden="true"></i> Bedrooms</span>
                                                        <ul class="list">
                                                            <li data-value="1" class="option selected">1</li>
                                                            <li data-value="2" class="option">2</li>
                                                            <li data-value="3" class="option">3</li>
                                                            <li data-value="3" class="option">4</li>
                                                            <li data-value="3" class="option">5</li>
                                                            <li data-value="3" class="option">6</li>
                                                            <li data-value="3" class="option">7</li>
                                                            <li data-value="3" class="option">8</li>
                                                            <li data-value="3" class="option">9</li>
                                                            <li data-value="3" class="option">10</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!--/ End Form Bedrooms -->
                                            </div>
                                            <div class="col-lg-4 col-md-6 py-1 pl-0 pr-0">
                                                <!-- Form Bathrooms -->
                                                <div class="form-group bath">
                                                    <div class="nice-select form-control wide" tabindex="0"><span
                                                            class="current"><i class="fa fa-bath"
                                                                aria-hidden="true"></i> Bathrooms</span>
                                                        <ul class="list">
                                                            <li data-value="1" class="option selected">1</li>
                                                            <li data-value="2" class="option">2</li>
                                                            <li data-value="3" class="option">3</li>
                                                            <li data-value="3" class="option">4</li>
                                                            <li data-value="3" class="option">5</li>
                                                            <li data-value="3" class="option">6</li>
                                                            <li data-value="3" class="option">7</li>
                                                            <li data-value="3" class="option">8</li>
                                                            <li data-value="3" class="option">9</li>
                                                            <li data-value="3" class="option">10</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!--/ End Form Bathrooms -->
                                            </div>
                                            <div class="col-lg-5 col-md-12 col-sm-12 py-1 pr-30 mr-5 sld">
                                                <!-- Price Fields -->
                                                <div class="main-search-field-2">
                                                    <!-- Area Range -->
                                                    <div class="range-slider">
                                                        <label>Area Size</label>
                                                        <div id="area-range" data-min="0" data-max="1300"
                                                            data-unit="sq ft"
                                                            class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                                            <input type="text" class="first-slider-value"
                                                                disabled=""><input type="text"
                                                                class="second-slider-value" disabled="">
                                                            <div class="ui-slider-range ui-widget-header ui-corner-all left-0 w-100"></div><a
                                                                class="ui-slider-handle ui-state-default ui-corner-all left-0"
                                                                href="#"></a><a
                                                                class="ui-slider-handle ui-state-default ui-corner-all left-100-percent"
                                                                href="#"></a>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <br>
                                                    <!-- Price Range -->
                                                    <div class="range-slider">
                                                        <label>Price Range</label>
                                                        <div id="price-range" data-min="0" data-max="600000"
                                                            data-unit="KD"
                                                            class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                                            <input type="text" class="first-slider-value"
                                                                disabled=""><input type="text"
                                                                class="second-slider-value" disabled="">
                                                            <div class="ui-slider-range ui-widget-header ui-corner-all left-0 w-100"></div><a
                                                                class="ui-slider-handle ui-state-default ui-corner-all left-0"></a><a
                                                                class="ui-slider-handle ui-state-default ui-corner-all left-100-percent"
                                                                href="#"></a>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30">
                                                <!-- Checkboxes -->
                                                <div class="checkboxes one-in-row margin-bottom-10 ch-1">
                                                    <input id="check-2" type="checkbox" name="check">
                                                    <label for="check-2">AC</label>
                                                    <input id="check-3" type="checkbox" name="check">
                                                    <label for="check-3">Swimming Pool</label>
                                                    <input id="check-4" type="checkbox" name="check">
                                                    <label for="check-4">Central Heating</label>
                                                    <input id="check-5" type="checkbox" name="check">
                                                    <label for="check-5">Laundry Room</label>
                                                    <input id="check-6" type="checkbox" name="check">
                                                    <label for="check-6">Gym</label>
                                                    <input id="check-7" type="checkbox" name="check">
                                                    <label for="check-7">Alarm</label>
                                                    <input id="check-8" type="checkbox" name="check">
                                                    <label for="check-8">Wifi</label>
                                                </div>
                                                <!-- Checkboxes / End -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Search Form -->
            </div>
            <!--/ End Search Form -->
            <br><br><br>
            <!-- END SECTION HEADINGS -->
            <section class="headings-2 pt-0">
                <div class="pro-wrapper">
                    <div class="detail-wrapper-body">
                        <div class="listing-title-bar">
                            <div class="text-heading text-left">
                                <p class="font-weight-bold mb-0 mt-3">{{ $ads->total() }} @lang('app.results')</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="cod-pad single detail-wrapper mr-2 mt-0 d-flex justify-content-md-end align-items-center">
                        <div class="input-group border rounded input-group-lg w-auto mr-4">
                            <label
                                class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3"
                                for="inputGroupSelect01"><i
                                    class="fas fa-align-left fs-16 pr-2"></i>@lang('app.sort_by'):</label>
                            <select class="disable-select" wire:model="filter">
                                <option selected value="">@lang('app.all')</option>
                                <option value="MOST_VIWED">@lang('app.most_viwed')</option>
                                <option value="LOW_TO_HIGH">@lang('app.price_low_to_high')</option>
                                <option value="HIGH_TO_LOW">@lang('app.price_high_to_low')</option>
                            </select>
                            {{-- <select class="form-control border-0 bg-transparent shadow-none p-0"
                                data-style="bg-transparent border-0 font-weight-600 btn-lg pl-0 pr-3"
                                 wire:model="filter">

                            </select> --}}
                        </div>
                        <div class="sorting-options">
                            {{-- <a href="javascript:void(0);" class="change-view-btn lde"><i
                                    class="fa fa-th-list"></i></a> --}}
                            <a href="javascript:void(0);" class="change-view-btn active-view-btn"><i
                                    class="fa fa-th-large"></i></a>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                @forelse ($ads as $ad)
                    <div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale">
                        <div class="project-single">
                            <div class="project-inner project-head">
                                <div class="homes">
                                    <!-- homes img -->
                                    <a href="{{ route('ad.search', [toSlug($ad->title), $ad->id]) }}"
                                        class="homes-img">
                                        <div class="homes-tag button alt featured">
                                            {{ $ad->buildingType->translate('name') }}</div>
                                        <div class="homes-tag button alt sale">
                                            {{ $ad->type == 'RENT' ? __('app.rent') : __('app.sale') }}</div>
                                        <div class="homes-price">@lang('app.currency') {{ $ad->price }}</div>
                                        <img src="{{ toAdDefaultImage($ad->getFile()) }}"
                                            class="img-responsive">
                                    </a>
                                </div>
                                <div class="button-effect">
                                    @if (authApprovedUser())
                                        @if ($ad->favorites()->where('user_id', user()->id)->count() > 0)
                                            <button class="btn favorite-btn bg-light"
                                                wire:click.prevent="deleteFromFavorite({{ $ad->id }})"><i
                                                    class="fas fa-heart color-main"></i></button>
                                        @else
                                            <button class="btn favorite-btn"
                                                wire:click.prevent="addToFavorite({{ $ad->id }})"><i
                                                    class="fas fa-heart"></i></button>
                                        @endif
                                    @endif
                                    {{-- <a href="{{ $ad->video_link }}" class="btn popup-video popup-youtube"><i
                                            class="fas fa-video"></i></a>
                                    <a href="single-property-2.html" class="img-poppu btn"><i
                                            class="far fa-image"></i></a> --}}
                                </div>
                            </div>
                            <!-- homes content -->
                            <div class="homes-content">
                                <!-- homes address -->
                                <h3><a
                                        href="{{ route('ad.search', [toSlug($ad->title), $ad->id]) }}">{{ $ad->title }}</a>
                                </h3>
                                <p class="homes-address mb-3">

                                        <span>{!! Str::limit($ad->text, 100) !!}</span>

                                </p>
                                <!-- homes List -->
                                <ul class="homes-list clearfix">
                                    <li>
                                        <i class="fas fa-map-marker"></i>
                                        <span>{{ $ad->governorate->translate('name') }}</span>
                                    </li>
                                      <li>
                                          <i class="fas fa-map-marker"></i>
                                        <span>{{ $ad->region->translate('name') }}</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-mobile-alt"></i>
                                        <span>{{ $ad->phone }}</span>
                                    </li>
                                    {{-- <li>
                                        <span>{{ $ad->region->translate('name') }}</span>
                                    </li> --}}
                                </ul>
                                <div class="footer">
                                    <a target="_blank" href="https://api.whatsapp.com/send?phone=+965{{ $ad->phone }}&text={{ route('ad.search', [toSlug($ad->title), $ad->id]) }}">
                                        <i class="fab fa-whatsapp-square"></i> {{ $ad->user->name }}
                                    </a>
                                    {{-- <a target="_blank" href="http://api.whatsapp.com/send?phone={{ $ad->phone }}&text={{ route('ad.search', [toSlug($ad->title), $ad->id]) }}">
                                        <i class="fab fa-whatsapp-square"></i> {{ $ad->user->name }}
                                    </a> --}}
                                    <a href="tel:{{ $ad->phone }}">
                                        <span>
                                            <i class="fas fa-phone-square-alt"></i> Call Now
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
                @empty
                    {!! noData() !!}
                @endforelse

            </div>
            <nav aria-label="..." class="pt-3">
                {{ count($ads) > 0 ? $ads->links() : '' }}
            </nav>
        </div>
    </section>
    <!-- END SECTION PROPERTIES LISTING -->
    @push('css')
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    @endpush
     @push('js')
        <script>
            function onGovernorateChange(e) {
                @this.set('governorate_id', e.target.value);
            }

            function onRegionChange(e) {
                @this.set('region_id', e.target.value);
            }

            function onBuildingTypeChange(e) {
                @this.set('building_type_id', e.target.value);
            }

            function onTypeChange(e) {
                @this.set('type', e.target.value);
            }
            function onRoomsChange(e) {
                @this.set('rooms_count', e.target.value);
            }
            function onBathRoomChange(e) {
                @this.set('bathrooms_count', e.target.value);
            }
            function onPriceFromChange(e) {
                @this.set('price_from', e.target.value);
            }
            function onPriceToChange(e) {
                @this.set('price_to', e.target.value);
            }


            Livewire.on('reinit-niceSelect', e => {
                // alert('@@@@@');
                //  $('.governorate_id').niceSelect('update');
            });

            Livewire.on('update-regions', regions => {
                var regionMenu = $("#region_id");
                // RESET REGIONS MENU
                $(".region_id").html("");
                var regionValues = "<option value=''>{{ __('app.choose_region') }}</option>";
                // APPEND NEW DATA
                regions.forEach(val => {
                    @if(App::getLocale() == "ar")
                        regionValues += "<option value='" + val.id + "'>" + val.name_ar + "</option>"
                    @else
                        regionValues += "<option value='" + val.id + "'>" + val.name_en + "</option>"
                    @endif
                    console.log(val);
                });
                $(".region_id").html(regionValues);
                // RE INITIALIZE NICE SELECT PLUGIN
                // $('.region_id').niceSelect();
                $('.region_id').niceSelect('update');
            })
        </script>
    @endpush
</div>
