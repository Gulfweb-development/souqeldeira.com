<div>
    <x-slot name="meta_title">@lang('app.agencies')</x-slot>
    <x-slot name="meta_descrption">@lang('app.agencies')</x-slot>
    <x-slot name="og_title">@lang('app.agencies')</x-slot>
    <x-slot name="og_description">@lang('app.agencies')</x-slot>
    <x-slot name="og_url">{{ Request::url() }}</x-slot>
    <x-slot name="og_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_title">@lang('app.agencies')</x-slot>
    <x-slot name="twitter_description">@lang('app.agencies')</x-slot>
    <x-slot name="twitter_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_card">@lang('app.agencies')</x-slot>
    <!-- START SECTION HEADINGS -->
    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>@lang('app.agencies')</h1>
                <h2><a href="{{ url('/') }}">@lang('app.home') </a> &nbsp;/&nbsp; @lang('app.agencies')</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->
    <!-- START SECTION PROPERTIES LISTING -->
    <section class="properties-list featured portfolio blog">
        <div class="container">
            <section class="headings-2 pt-0 pb-0">
                <div class="pro-wrapper">
                    {{-- <div class="detail-wrapper-body">
                        <div class="listing-title-bar">
                            <div class="text-heading text-left">
                                <p><a href="{{ url('/') }}">@lang('app.home') </a> &nbsp;/&nbsp;
                                    <span>@lang('app.list')</span>
                                </p>
                            </div>
                            <h3>@lang('app.ads')</h3>
                        </div>
                    </div> --}}
                </div>
            </section>
            <!-- Search Form -->

            <!--/ End Search Form -->
            <br>

            <section class="featured portfolio">
                <div class="container">
                    {!! \App\Models\Position::render() !!}
                </div>
            </section>
            <br><br>
            <!-- END SECTION HEADINGS -->
            <section class="headings-2 pt-0">
                <div class="pro-wrapper">
                    <div class="detail-wrapper-body">
                        <div class="listing-title-bar">
                            <div class="text-heading text-left">
                                <p class="font-weight-bold mb-0 mt-3">{{ $users->total() }} @lang('app.results')</p>
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
                            <a href="javascript:void(0);" class="change-view-btn active-view-btn"><i class="fa fa-th-large"></i></a>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                @forelse ($users as $user)
                    <div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale trackVisitor" track-data='{!!  json_encode(['type' => 'agency' , 'is_featured' =>0 , 'id' =>  $user->id]) !!}' track-id="{{$user->id}}">
                        <div class="project-single">
                            <a  href="{{ route('agency.ads',[toSlug($user->name),$user->id]) }}"  class="trackClick" track-data='{!! json_encode(['type' => 'agency_ads' , 'is_featured' => 0 , 'id' =>  $user->id]) !!}'>
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <div class="homes-img">
                                            {{-- <div class="homes-tag button alt featured">
                                                {{ $user->id }}</div> --}}
                                            {{-- <div class="homes-tag button alt sale">
                                                {{ $user->type == 'RENT' ? __('app.rent') : __('app.sale') }}</div> --}}
                                            {{-- <div class="homes-price">@lang('app.currency') {{ $user->price }}</div> --}}
                                            <img src="{{ toProfileDefaultImage($user->getFile() , 'images/company_default.jpg') }}"
                                                 class="img-responsive" alt="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="button-effect">
                                        {{-- <a href="#" class="btn"><i
                                                class="fas fa-link"></i></a>
                                        <a href="{{ $user->video_link }}" class="btn popup-video popup-youtube"><i
                                                class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i
                                                class="far fa-image"></i></a> --}}
                                    </div>
                                </div>
                            </a>
                            <!-- homes content -->
                            <div class="homes-content">
                                <!-- homes address -->
                                <h3><a href="{{ route('agency.ads',[toSlug($user->name),$user->id]) }}"  class="trackClick" track-data='{!! json_encode(['type' => 'agency_ads' , 'is_featured' => 0 , 'id' =>  $user->id]) !!}'>{{ $user->name }}</a></h3>
                                <p class="homes-address mb-3">
                                    @if($user->phone)
                                        <a href="tel:{{ $user->phone }}"  class="trackClick" track-data='{!! json_encode(['type' => 'agency_tel' , 'is_featured' =>  0, 'id' =>  $user->id]) !!}'>
                                            <i
                                                class="fa fa-mobile"></i><span>{{ $user->phone }}</span>
                                        </a>
                                @else
                                    <div style="height: 30px;"></div>
                                @endif
                                <div class="author-box clearfix">
                                    <button class="btn btn-default btn-sm text-white" wire:click.prevent="sendReport({{ $user->id }})">@lang('app.reportThisAcc')</button>
                                </div>

                                </p>
                                <!-- homes List -->
                                <ul class="homes-list clearfix">
                                    {{-- <li>
                                        <span>{{ $user->rooms_count }} @lang('app.rooms')</span>
                                    </li>
                                    <li>
                                        <span>{{ $user->bathrooms_count }} @lang('app.bathrooms')</span>
                                    </li>
                                    <li>
                                        <span>{{ $user->distance }} @lang('app.size_meter') |
                                            {{ $user->views }}</span>
                                    </li>
                                    <li>
                                        <span>{{ $user->region}}</span>
                                    </li> --}}
                                </ul>
                                <div class="footer">
                                    <a target="_blank" href="http://api.whatsapp.com/send?phone={{ $user->phone }}"  class="trackClick" track-data='{!! json_encode(['type' => 'agency_whatsapp' , 'is_featured' =>  0 , 'id' =>  $user->id]) !!}'>
                                        <i class="fab fa-whatsapp-square"></i> @lang('app.whatsapp')
                                    </a>
                                    <a href="tel:{{ $user->phone }}"  class="trackClick" track-data='{!! json_encode(['type' => 'agency_tel' , 'is_featured' => 0 , 'id' =>  $user->id]) !!}'>
                                        <span>
                                            <i class="fas fa-phone-square-alt"></i> Call Now
                                        </span>
                                    </a>
                                    {{-- <a href="agent-details.html">
                                        <i class="fab fa-whatsapp-square"></i> {{ $user->user->name }}
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
                {{ count($users) > 0 ? $users->links() : '' }}
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
