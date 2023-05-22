<div>
    <x-slot name="meta_title">@lang('app.dashboard')</x-slot>
    <x-slot name="title">@lang('app.dashboard')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item active">@lang('app.dashboard')</li>
    </x-slot>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $approvedAds }}</h3>

                    <p>@lang('app.aproved_ads')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $penddingAds }}</h3>

                    <p>@lang('app.pendding_ads')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $companyUsers }}</h3>

                    <p>@lang('app.company')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $normalUsers }}</h3>

                    <p>@lang('app.users')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $registeredUsers }}</h3>

                    <p>@lang('app.registered_user')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $governorates }}</h3>

                    <p>@lang('app.governorates')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $regions }}</h3>

                    <p>@lang('app.regions')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $faqs }}</h3>

                    <p>@lang('app.faqs')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $paid_today }} @lang('app.currency')</h3>
                    <p>@lang('paid_today')</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dollar-sign"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $paid_this_week }} @lang('app.currency')</h3>
                    <p>@lang('paid_this_week')</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dollar-sign"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $paid_this_month }} @lang('app.currency')</h3>
                    <p>@lang('paid_this_month')</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dollar-sign"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $paid_last_month }} @lang('app.currency')</h3>
                    <p>@lang('paid_last_month')</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dollar-sign"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>


</div>
