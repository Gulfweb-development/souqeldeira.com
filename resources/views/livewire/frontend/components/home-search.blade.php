<div>
    <!-- STAR HEADER SEARCH -->
    <section id="hero-area" class="parallax-searchs home15 overlay thome-6 thome-1" data-stellar-background-ratio="0.5">
        <div class="hero-main">
            <div class="container" wire:ignore>
                <div class="row">
                    <div class="col-12">
                        <div class="hero-inner">
                            <br><br>
                            <!-- Welcome Text -->
                            <div class="welcome-text">
                                <ul class="nav nav-tabs rld-banner-tab d-flex justify-content-around">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab"
                                           href="#tabs_1">@lang('app.search')</a>
                                    </li>
                                </ul>
                            </div>
                            <!--/ End Welcome Text -->
                            <!-- Search Form -->
                            <div class="banner-search-wrap">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tabs_1">
                                        <div class="rld-main-search mr-0">
                                            <div class="row d-flex justify-content-center">

{{--                                                <div class="col-xl-2 col-lg-2 col-md-4 pl-0">--}}
{{--                                                    <div class="rld-single-select ml-22">--}}
{{--                                                        <select id="governorate_id"--}}
{{--                                                            class="select single-select mr-0 governorate_id"--}}
{{--                                                            name="governorate_id"--}}
{{--                                                            onchange="return onGovernorateChange(event);">--}}
{{--                                                            <option value="">@lang('app.governorates')</option>--}}
{{--                                                            @forelse ($governorates as $governorate)--}}
{{--                                                                <option value="{{ $governorate->id }}">--}}
{{--                                                                    {{ $governorate->translate('name') }}</option>--}}
{{--                                                            @empty--}}
{{--                                                                <option value="">@lang('app.no_data')</option>--}}
{{--                                                            @endforelse--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div class="col-xl-2 col-lg-2 col-md-4 pl-0">--}}
{{--                                                    <div class="rld-single-select ml-22">--}}
{{--                                                        <select class="select single-select mr-0 region_id"--}}
{{--                                                            id="region_id" onchange="return onRegionChange(event);">--}}
{{--                                                            <option value="">@lang('app.regions')</option>--}}
{{--                                                            @forelse ($regions as $region)--}}
{{--                                                                <option value="{{ $region->id }}">--}}
{{--                                                                    {{ $region->translate('name') }}</option>--}}
{{--                                                            @empty--}}
{{--                                                                <option value="">@lang('app.no_data')</option>--}}
{{--                                                            @endforelse--}}
{{--                                                        </select>--}}



{{--                                                    </div>--}}
{{--                                                </div>--}}

                                                <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                                    <div class="rld-single-select">
                                                        <select id="region_id"
                                                                class="nice-select single-select scrollme mr-0 region_id"
                                                                name="region_id" onchange="return onRegionChange(event);">
                                                            <option value="">@lang('app.governorates')</option>
                                                            @foreach ($governorates as $governorate)
                                                                <option disabled="disabled" style="font-weight:bold;color:#000000;font-size:20px;">--{{ $governorate->translate('name') }}--</option>
                                                                    @foreach ($governorate->regions as $region)
                                                                        <option value="{{ $region->id }}">
                                                                            {{ $region->translate('name') }}</option>
                                                                    @endforeach

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                                    <div class="rld-single-select">
                                                        <select class="select single-select building_type_id"
                                                                onchange=" onBuildingTypeChange(event);"
                                                                wire:model="building_type_id">
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
                                                    <div class="rld-single-select">
                                                        <select class="select single-select type"
                                                                onchange="onTypeChange(event);" wire:model="type">
                                                            <option value="">@lang('app.type')</option>
                                                            <option value="SALE">@lang('app.sale')</option>
                                                            <option value="RENT">@lang('app.rent')</option>
                                                            <option value="EXCHANGE">@lang('app.exchange')</option>
                                                            <option value="REQUEST">@lang('app.REQUEST')</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                                    <div class="dropdown-filter rld-single-select">
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
                                                                    onchange="onRoomsChange(event);"
                                                                    >
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
                                                                    onchange="onBathRoomChange(event);"
                                                                   >
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
                                                            <div class="rld-single-select">
                                                                <input type="price_from form-control" name="price_from"
                                                                       onchange="onPriceFromChange(event);"
                                                                       placeholder="@lang('app.price_from')">
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6 col-lg-6 col-md-6 pl-0">
                                                            <div class="rld-single-select">
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
                                                <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                                    <div class="rld-single-select">
                                                        <select class="select single-select mr-0">
                                                            <option value="1">Country</option>
                                                            <option value="2">Kuwait City</option>
                                                            <option value="3">salwa</option>
                                                            <option value="3">Salmay</option>
                                                            <option value="3">Alahmadi</option>
                                                            <option value="3">Farwaniya</option>
                                                            <option value="3">ELmangaf</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                                    <div class="rld-single-select">
                                                        <select class="select single-select mr-0">
                                                            <option value="1">City</option>
                                                            <option value="2">Kuwait City</option>
                                                            <option value="3">salwa</option>
                                                            <option value="3">Salmay</option>
                                                            <option value="3">Alahmadi</option>
                                                            <option value="3">Farwaniya</option>
                                                            <option value="3">ELmangaf</option>
                                                        </select>



                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-4 pl-0">
                                                    <div class="rld-single-select">
                                                        <select class="select single-select">
                                                            <option value="1">Property Type</option>
                                                            <option value="2">Family House</option>
                                                            <option value="3">Apartment</option>
                                                            <option value="3">Real Estates</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-4 pl-0">
                                                    <div class="dropdown-filter rld-single-select">Advanced Search
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 col-lg-2 col-md-4">
                                                    <a class="btn btn-yellow" href="#">Search Now</a>
                                                </div>
                                                <div class="explore__form-checkbox-list full-filter">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0">
                                                            <!-- Form Property Status -->
                                                            <div class="form-group categories">
                                                                <div class="nice-select form-control wide" tabindex="0">
                                                                    <span class="current"><i
                                                                            class="fa fa-home"></i>Property
                                                                        Status</span>
                                                                    <ul class="list">
                                                                        <li data-value="1" class="option selected ">For
                                                                            Sale</li>
                                                                        <li data-value="2" class="option">For
                                                                            Rent</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!--/ End Form Property Status -->
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 ">
                                                            <!-- Form Bedrooms -->
                                                            <div class="form-group beds">
                                                                <div class="nice-select form-control wide" tabindex="0">
                                                                    <span class="current"><i
                                                                            class="fa fa-bed"
                                                                            aria-hidden="true"></i> Bedrooms</span>
                                                                    <ul class="list">
                                                                        <li data-value="1" class="option selected">1
                                                                        </li>
                                                                        <li data-value="2" class="option">2</li>
                                                                        <li data-value="3" class="option">3</li>
                                                                        <li data-value="3" class="option">4</li>
                                                                        <li data-value="3" class="option">5</li>
                                                                        <li data-value="3" class="option">6</li>
                                                                        <li data-value="3" class="option">7
                                                                        </li>
                                                                        <li data-value="3" class="option">8
                                                                        </li>
                                                                        <li data-value="3" class="option">9
                                                                        </li>
                                                                        <li data-value="3" class="option">10
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!--/ End Form Bedrooms -->
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 py-1 pl-0 pr-0">
                                                            <!-- Form Bathrooms -->
                                                            <div class="form-group bath">
                                                                <div class="nice-select form-control wide" tabindex="0">
                                                                    <span class="current"><i
                                                                            class="fa fa-bath"
                                                                            aria-hidden="true"></i> Bathrooms</span>
                                                                    <ul class="list">
                                                                        <li data-value="1" class="option selected">1
                                                                        </li>
                                                                        <li data-value="2" class="option">2
                                                                        </li>
                                                                        <li data-value="3" class="option">3
                                                                        </li>
                                                                        <li data-value="3" class="option">4
                                                                        </li>
                                                                        <li data-value="3" class="option">5
                                                                        </li>
                                                                        <li data-value="3" class="option">6
                                                                        </li>
                                                                        <li data-value="3" class="option">7
                                                                        </li>
                                                                        <li data-value="3" class="option">8
                                                                        </li>
                                                                        <li data-value="3" class="option">9
                                                                        </li>
                                                                        <li data-value="3" class="option">10
                                                                        </li>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END HEADER SEARCH -->
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
