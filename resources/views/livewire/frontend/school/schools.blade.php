<div>
     <x-slot name="meta_title">@lang('app.schools')</x-slot>
    <x-slot name="meta_descrption">@lang('app.schools')</x-slot>
    <x-slot name="og_title">@lang('app.schools')</x-slot>
    <x-slot name="og_description">@lang('app.schools')</x-slot>
    <x-slot name="og_url">{{ Request::url() }}</x-slot>
    <x-slot name="og_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_title">@lang('app.schools')</x-slot>
    <x-slot name="twitter_description">@lang('app.schools')</x-slot>
    <x-slot name="twitter_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_card">@lang('app.schools')</x-slot>
    <!-- START SECTION HEADINGS -->
    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>@lang('app.schools')</h1>
                <h2><a href="{{ url('/') }}">@lang('app.home') </a> &nbsp;/&nbsp; @lang('app.schools')</h2>;
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
                            <h3>@lang('app.schools')</h3>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Search Form -->
            <!--<div class="hero-inner" wire:ignore>-->

                <!-- Welcome Text -->
            <!--    <div class="welcome-text">-->
            <!--        <ul class="nav nav-tabs rld-banner-tab d-flex justify-content-around">-->
            <!--            <li class="nav-item">-->
            <!--                <a class="nav-link active" data-toggle="tab" href="#tabs_1">@lang('app.search')</a>-->
            <!--            </li>-->
            <!--            <li class="nav-item">-->
            <!--                {{-- <a class="nav-link" data-toggle="tab" href="#tabs_2">For Rent</a> --}}-->
            <!--                {{-- <a class="nav-link" data-toggle="tab" href="#">For Rent</a> --}}-->
            <!--            </li>-->
            <!--        </ul>-->
            <!--    </div>-->
                <!--/ End Welcome Text -->
                <!-- Search Form -->
            <!--    <div class="banner-search-wrap">-->
            <!--        <div class="tab-content">-->
            <!--            <div class="tab-pane fade active show" id="tabs_1">-->
            <!--                <div class="rld-main-search">-->
            <!--                    <div class="row d-flex justify-content-center">-->
            <!--                        <div class="col-xl-4 col-lg-4 col-md-4 pl-0 ">-->
            <!--                            <div class="rld-single-select w-100">-->
            <!--                                <select id="governorate_id" class="select single-select mr-0  w-100 governorate_id"-->
            <!--                                    name="governorate_id" onchange="return onGovernorateChange(event);">-->
            <!--                                    <option value="">@lang('app.governorates')</option>-->
            <!--                                    @forelse ($governorates as $governorate)-->
            <!--                                        <option value="{{ $governorate->id }}">-->
            <!--                                            {{ $governorate->translate('name') }}</option>-->
            <!--                                    @empty-->
            <!--                                        <option value="">@lang('app.no_data')</option>-->
            <!--                                    @endforelse-->
            <!--                                </select>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="col-xl-4 col-lg-4 col-md-4 pl-0">-->
            <!--                            <div class="rld-single-select w-100">-->
            <!--                                <select class="select single-select mr-0  w-100 region_id" id="region_id"-->
            <!--                                    onchange="return onRegionChange(event);">-->
            <!--                                    <option value="">@lang('app.regions')</option>-->
            <!--                                    @forelse ($regions as $region)-->
            <!--                                        <option value="{{ $region->id }}">-->
            <!--                                            {{ $region->translate('name') }}</option>-->
            <!--                                    @empty-->
            <!--                                        <option value="">@lang('app.no_data')</option>-->
            <!--                                    @endforelse-->
            <!--                                </select>-->



            <!--                            </div>-->
            <!--                        </div>-->

            <!--                        {{-- <div class="col-xl-2 col-lg-2 col-md-4 pl-0">-->
            <!--                            <div class="rld-single-select ml-22">-->
            <!--                                <select class="select single-select building_type_id"-->
            <!--                                    onchange=" onBuildingTypeChange(event);" wire:model="building_type_id">-->
            <!--                                    <option value="" wire:model="building_type_id">-->
            <!--                                        @lang('app.building_type')</option>-->
            <!--                                    @forelse ($buildingTypes as $buildingType)-->
            <!--                                        <option value="{{ $buildingType->id }}">-->
            <!--                                            {{ $buildingType->translate('name') }}</option>-->
            <!--                                    @empty-->
            <!--                                        <option value="">@lang('app.no_data')</option>-->
            <!--                                    @endforelse-->
            <!--                                </select>-->
            <!--                            </div>-->
            <!--                        </div> --}}-->
            <!--                        {{-- <div class="col-xl-2 col-lg-2 col-md-4 pl-0">-->
            <!--                            <div class="rld-single-select ml-22">-->
            <!--                                <select class="select single-select type" onchange="onTypeChange(event);"-->
            <!--                                    wire:model="type">-->
            <!--                                    <option value="">@lang('app.type')</option>-->
            <!--                                    <option value="SALE">@lang('app.sale')</option>-->
            <!--                                    <option value="RENT">@lang('app.rent')</option>-->
            <!--                                </select>-->
            <!--                            </div>-->
            <!--                        </div> --}}-->
            <!--                        {{-- <div class="col-xl-2 col-lg-2 col-md-4 pl-0">-->
            <!--                            <div class="dropdown-filter rld-single-select ml-22">-->
            <!--                                @lang('app.advanced_search')-->
            <!--                            </div>-->
            <!--                        </div> --}}-->
            <!--                        <div class="col-xl-2 col-lg-2 col-md-4">-->
            <!--                            <a class="btn btn-yellow" href="#"-->
            <!--                                wire:click.prevent="search">@lang('app.search_now')</a>-->
            <!--                        </div>-->
            <!--                        <div class="explore__form-checkbox-list full-filter">-->
            <!--                            <div class="row">-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="tab-pane fade" id="tabs_2">-->
            <!--                <div class="rld-main-search">-->
            <!--                    <div class="row d-flex justify-content-center">-->
            <!--                        <div class="col-xl-2 col-lg-2 col-md-4">-->
            <!--                            <div class="rld-single-select">-->
            <!--                                <select class="select single-select mr-0" style="display: none;">-->
            <!--                                    <option value="1">Country</option>-->
            <!--                                    <option value="2">Kuwait City</option>-->
            <!--                                    <option value="3">salwa</option>-->
            <!--                                    <option value="3">Salmay</option>-->
            <!--                                    <option value="3">Alahmadi</option>-->
            <!--                                    <option value="3">Farwaniya</option>-->
            <!--                                    <option value="3">ELmangaf</option>-->
            <!--                                </select>-->
            <!--                                <div class="nice-select select single-select mr-0" tabindex="0"><span-->
            <!--                                        class="current">Country</span>-->
            <!--                                    <ul class="list">-->
            <!--                                        <li data-value="1" class="option selected">Country</li>-->
            <!--                                        <li data-value="2" class="option">Kuwait City</li>-->
            <!--                                        <li data-value="3" class="option">salwa</li>-->
            <!--                                        <li data-value="3" class="option">Salmay</li>-->
            <!--                                        <li data-value="3" class="option">Alahmadi</li>-->
            <!--                                        <li data-value="3" class="option">Farwaniya</li>-->
            <!--                                        <li data-value="3" class="option">ELmangaf</li>-->
            <!--                                    </ul>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="col-xl-2 col-lg-2 col-md-4">-->
            <!--                            <div class="rld-single-select">-->
            <!--                                <select class="select single-select mr-0" style="display: none;">-->
            <!--                                    <option value="1">City</option>-->
            <!--                                    <option value="2">Kuwait City</option>-->
            <!--                                    <option value="3">salwa</option>-->
            <!--                                    <option value="3">Salmay</option>-->
            <!--                                    <option value="3">Alahmadi</option>-->
            <!--                                    <option value="3">Farwaniya</option>-->
            <!--                                    <option value="3">ELmangaf</option>-->
            <!--                                </select>-->
            <!--                                <div class="nice-select select single-select mr-0" tabindex="0"><span-->
            <!--                                        class="current">City</span>-->
            <!--                                    <ul class="list">-->
            <!--                                        <li data-value="1" class="option selected">City</li>-->
            <!--                                        <li data-value="2" class="option">Kuwait City</li>-->
            <!--                                        <li data-value="3" class="option">salwa</li>-->
            <!--                                        <li data-value="3" class="option">Salmay</li>-->
            <!--                                        <li data-value="3" class="option">Alahmadi</li>-->
            <!--                                        <li data-value="3" class="option">Farwaniya</li>-->
            <!--                                        <li data-value="3" class="option">ELmangaf</li>-->
            <!--                                    </ul>-->
            <!--                                </div>-->



            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="col-xl-3 col-lg-3 col-md-4">-->
            <!--                            <div class="rld-single-select">-->
            <!--                                <select class="select single-select" style="display: none;">-->
            <!--                                    <option value="1">Property Type</option>-->
            <!--                                    <option value="2">Family House</option>-->
            <!--                                    <option value="3">Apartment</option>-->
            <!--                                    <option value="3">Real Estates</option>-->
            <!--                                </select>-->
            <!--                                <div class="nice-select select single-select" tabindex="0"><span-->
            <!--                                        class="current">Property Type</span>-->
            <!--                                    <ul class="list">-->
            <!--                                        <li data-value="1" class="option selected">Property Type</li>-->
            <!--                                        <li data-value="2" class="option">Family House</li>-->
            <!--                                        <li data-value="3" class="option">Apartment</li>-->
            <!--                                        <li data-value="3" class="option">Real Estates</li>-->
            <!--                                    </ul>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="col-xl-3 col-lg-3 col-md-4">-->
            <!--                            <div class="dropdown-filter rld-single-select">Advanced Search</div>-->
            <!--                        </div>-->
            <!--                        <div class="col-xl-2 col-lg-2 col-md-4">-->
            <!--                            <a class="btn btn-yellow" href="#">Search Now</a>-->
            <!--                        </div>-->
            <!--                        <div class="explore__form-checkbox-list full-filter">-->
            <!--                            <div class="row">-->
            <!--                                <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0">-->
                                                <!-- Form Property Status -->
            <!--                                    <div class="form-group categories">-->
            <!--                                        <div class="nice-select form-control wide" tabindex="0"><span-->
            <!--                                                class="current"><i-->
            <!--                                                    class="fa fa-home"></i>Property Status</span>-->
            <!--                                            <ul class="list">-->
            <!--                                                <li data-value="1" class="option selected ">For Sale</li>-->
            <!--                                                <li data-value="2" class="option">For Rent</li>-->
            <!--                                            </ul>-->
            <!--                                        </div>-->
            <!--                                    </div>-->
                                                <!--/ End Form Property Status -->
            <!--                                </div>-->
            <!--                                <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 ">-->
                                                <!-- Form Bedrooms -->
            <!--                                    <div class="form-group beds">-->
            <!--                                        <div class="nice-select form-control wide" tabindex="0"><span-->
            <!--                                                class="current"><i class="fa fa-bed"-->
            <!--                                                    aria-hidden="true"></i> Bedrooms</span>-->
            <!--                                            <ul class="list">-->
            <!--                                                <li data-value="1" class="option selected">1</li>-->
            <!--                                                <li data-value="2" class="option">2</li>-->
            <!--                                                <li data-value="3" class="option">3</li>-->
            <!--                                                <li data-value="3" class="option">4</li>-->
            <!--                                                <li data-value="3" class="option">5</li>-->
            <!--                                                <li data-value="3" class="option">6</li>-->
            <!--                                                <li data-value="3" class="option">7</li>-->
            <!--                                                <li data-value="3" class="option">8</li>-->
            <!--                                                <li data-value="3" class="option">9</li>-->
            <!--                                                <li data-value="3" class="option">10</li>-->
            <!--                                            </ul>-->
            <!--                                        </div>-->
            <!--                                    </div>-->
                                                <!--/ End Form Bedrooms -->
            <!--                                </div>-->
            <!--                                <div class="col-lg-4 col-md-6 py-1 pl-0 pr-0">-->
                                                <!-- Form Bathrooms -->
            <!--                                    <div class="form-group bath">-->
            <!--                                        <div class="nice-select form-control wide" tabindex="0"><span-->
            <!--                                                class="current"><i class="fa fa-bath"-->
            <!--                                                    aria-hidden="true"></i> Bathrooms</span>-->
            <!--                                            <ul class="list">-->
            <!--                                                <li data-value="1" class="option selected">1</li>-->
            <!--                                                <li data-value="2" class="option">2</li>-->
            <!--                                                <li data-value="3" class="option">3</li>-->
            <!--                                                <li data-value="3" class="option">4</li>-->
            <!--                                                <li data-value="3" class="option">5</li>-->
            <!--                                                <li data-value="3" class="option">6</li>-->
            <!--                                                <li data-value="3" class="option">7</li>-->
            <!--                                                <li data-value="3" class="option">8</li>-->
            <!--                                                <li data-value="3" class="option">9</li>-->
            <!--                                                <li data-value="3" class="option">10</li>-->
            <!--                                            </ul>-->
            <!--                                        </div>-->
            <!--                                    </div>-->
                                                <!--/ End Form Bathrooms -->
            <!--                                </div>-->
            <!--                                <div class="col-lg-5 col-md-12 col-sm-12 py-1 pr-30 mr-5 sld">-->
                                                <!-- Price Fields -->
            <!--                                    <div class="main-search-field-2">-->
                                                    <!-- Area Range -->
            <!--                                        <div class="range-slider">-->
            <!--                                            <label>Area Size</label>-->
            <!--                                            <div id="area-range" data-min="0" data-max="1300"-->
            <!--                                                data-unit="sq ft"-->
            <!--                                                class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">-->
            <!--                                                <input type="text" class="first-slider-value"-->
            <!--                                                    disabled=""><input type="text"-->
            <!--                                                    class="second-slider-value" disabled="">-->
            <!--                                                <div class="ui-slider-range ui-widget-header ui-corner-all"-->
            <!--                                                    style="left: 0%; width: 100%;"></div><a-->
            <!--                                                    class="ui-slider-handle ui-state-default ui-corner-all"-->
            <!--                                                    href="#" style="left: 0%;"></a><a-->
            <!--                                                    class="ui-slider-handle ui-state-default ui-corner-all"-->
            <!--                                                    href="#" style="left: 100%;"></a>-->
            <!--                                            </div>-->
            <!--                                            <div class="clearfix"></div>-->
            <!--                                        </div>-->
            <!--                                        <br>-->
                                                    <!-- Price Range -->
            <!--                                        <div class="range-slider">-->
            <!--                                            <label>Price Range</label>-->
            <!--                                            <div id="price-range" data-min="0" data-max="600000"-->
            <!--                                                data-unit="KD"-->
            <!--                                                class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">-->
            <!--                                                <input type="text" class="first-slider-value"-->
            <!--                                                    disabled=""><input type="text"-->
            <!--                                                    class="second-slider-value" disabled="">-->
            <!--                                                <div class="ui-slider-range ui-widget-header ui-corner-all"-->
            <!--                                                    style="left: 0%; width: 100%;"></div><a-->
            <!--                                                    class="ui-slider-handle ui-state-default ui-corner-all"-->
            <!--                                                    href="#" style="left: 0%;"></a><a-->
            <!--                                                    class="ui-slider-handle ui-state-default ui-corner-all"-->
            <!--                                                    href="#" style="left: 100%;"></a>-->
            <!--                                            </div>-->
            <!--                                            <div class="clearfix"></div>-->
            <!--                                        </div>-->
            <!--                                    </div>-->
            <!--                                </div>-->
            <!--                                <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30">-->
                                                <!-- Checkboxes -->
            <!--                                    <div class="checkboxes one-in-row margin-bottom-10 ch-1">-->
            <!--                                        <input id="check-2" type="checkbox" name="check">-->
            <!--                                        <label for="check-2">AC</label>-->
            <!--                                        <input id="check-3" type="checkbox" name="check">-->
            <!--                                        <label for="check-3">Swimming Pool</label>-->
            <!--                                        <input id="check-4" type="checkbox" name="check">-->
            <!--                                        <label for="check-4">Central Heating</label>-->
            <!--                                        <input id="check-5" type="checkbox" name="check">-->
            <!--                                        <label for="check-5">Laundry Room</label>-->
            <!--                                        <input id="check-6" type="checkbox" name="check">-->
            <!--                                        <label for="check-6">Gym</label>-->
            <!--                                        <input id="check-7" type="checkbox" name="check">-->
            <!--                                        <label for="check-7">Alarm</label>-->
            <!--                                        <input id="check-8" type="checkbox" name="check">-->
            <!--                                        <label for="check-8">Wifi</label>-->
            <!--                                    </div>-->
                                                <!-- Checkboxes / End -->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
                <!--/ End Search Form -->
            <!--</div>-->
            <!--/ End Search Form -->
            <br><br><br>
            <!-- END SECTION HEADINGS -->
            <section class="headings-2 pt-0">
                <div class="pro-wrapper">
                    <div class="detail-wrapper-body">
                        <div class="listing-title-bar">
                            <div class="text-heading text-left">
                                <p class="font-weight-bold mb-0 mt-3">{{ $schools->total() }} @lang('app.results')</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="cod-pad single detail-wrapper mr-2 mt-0 d-flex justify-content-md-end align-items-center">
                        <div class="input-group border rounded input-group-lg w-auto mr-4">
                            {{-- <label
                                class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3"
                                for="inputGroupSelect01"><i
                                    class="fas fa-align-left fs-16 pr-2"></i>@lang('app.sort_by'):</label>
                            <select class="disable-select" wire:model="filter">
                                <option selected value="">@lang('app.all')</option>
                                <option value="MOST_VIWED">@lang('app.most_viwed')</option>
                                <option value="LOW_TO_HIGH">@lang('app.price_low_to_high')</option>
                                <option value="HIGH_TO_LOW">@lang('app.price_high_to_low')</option>
                            </select> --}}
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
                @forelse ($schools as $school)
                    <div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale">
                        <div class="project-single">
                            <div class="project-inner project-head">
                                <div class="homes">
                                    <!-- homes img -->
                                    <a href="{{ route('school', [toSlug($school->translate('title')), $school->id]) }}"
                                        class="homes-img">
                                        {{-- <div class="homes-tag button alt featured">
                                           </div>
                                        <div class="homes-tag button alt sale">
                                           </div> --}}
                                        <img src="{{ $school->getFile() }}" alt="@lang('app.alt_img')"
                                            class="img-responsive">
                                    </a>
                                </div>
                                <div class="button-effect">

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
                                        href="{{ route('school', [toSlug($school->translate('title')), $school->id]) }}">{{ $school->translate('title') }}</a>
                                </h3>
                                <p class="homes-address mb-3">
                                    <a href="#">
                                        <i
                                            class="fa fa-map-marker"></i><span>{{ Str::limit($school->translate('text'), 100) }}</span>
                                    </a>
                                </p>
                                <!-- homes List -->
                                <ul class="homes-list clearfix">
                                    {{-- <li>
                                        <span>##room @lang('app.rooms')</span>
                                    </li>
                                    <li>
                                        <span>##bathroom @lang('app.bathrooms')</span>
                                    </li>
                                    <li>
                                        <span>##distance @lang('app.size_meter') |
                                           ##views</span>
                                    </li> --}}
                                    <li>
                                        <span>{{ $school->region->translate('name') }}</span>
                                    </li>
                                </ul>
                                <div class="footer">
                                    <a target="_blank" href="http://api.whatsapp.com/send?phone={{ $school->phone }}">
                                        <i class="fab fa-whatsapp-square"></i> {{ $school->translate('title') }};
                                    </a>
                                    <a href="tel:{{ $school->phone }}">
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
                @empty
                    {!! noData() !!}
                @endforelse

            </div>
            <nav aria-label="..." class="pt-3">
                {{ count($schools) > 0 ? $schools->links() : '' }}
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
                    regionValues += "<option value='" + val.id + "'>" + val.name_en + "</option>"
                    console.log(val);
                });
                $(".region_id").html(regionValues);
                // RE INITIALIZE NICE SELECT PLUGIN
                // $('.region_id').niceSelect();
                $('.region_id').niceSelect('update');
            });
            $(document).ready(function(e) {
                $('.disable-select').niceSelect('destroy');

            });
        </script>
    @endpush
</div>
