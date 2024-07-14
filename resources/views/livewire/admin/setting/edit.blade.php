<div>
    <x-slot name="title">@lang('app.setting') | @lang('app.edit')</x-slot>
    <x-slot name="pageTitle">@lang('app.dashboard') | @lang('app.setting') | @lang('app.edit')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.setting.index') }}">@lang('app.settings')</a></li>
        <li class="breadcrumb-item active">@lang('app.edit')</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <x-admin.input name="state.title_ar" label="{{ __('app.title_ar') }}"/>
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.title_en" label="{{ __('app.title_en') }}"/>
                </div>
                {{--                <div class="col-md-6">--}}
                {{--                    <hr />--}}
                {{--                    <x-admin.checkbox name="state.publish_all_to_social_media"--}}
                {{--                        label="{{ __('app.publish_all_to_social_media') }}" />--}}
                {{--                    <hr />--}}
                {{--                </div>--}}

            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <x-admin.input name="state.num_special_position" label="{{ __('num_special_position') }}"/>
                </div>
                @for($i = 0 ; $i < $state['num_special_position'] ; $i++ )
                    <div class="col-md-6">
                        <x-admin.input name="state.special_position.{{$i}}.price" label="{{ __('price_of_position') . ' ' . ( $i + 1) }}"/>
                    </div>
                    <div class="col-md-6">
                        <x-admin.input name="state.special_position.{{$i}}.expire" label="{{ __('expire_of_position') . ' ' . ( $i + 1) }}"/>
                    </div>
                @endfor
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <x-admin.input name="state.gift_normal" label="Num. Normal Gift Ads"/>
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.gift_premium" label="Num. Premium Gift Ads"/>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <x-admin.input name="state.expire_time_adv" label="{{ __('expire_time_adv') }}"/>
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.expire_time_premium_adv" label="{{ __('expire_time_premium_adv') }}"/>
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.price_adv" label="{{ __('price_adv') }}"/>
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.price_premium_adv" label="{{ __('price_premium_adv') }}"/>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <x-admin.input name="state.facebook" label="{{ __('app.facebook') }}"/>
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.twitter" label="{{ __('app.twitter') }}"/>
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.instagram" label="{{ __('app.instagram') }}"/>
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.youtube" label="{{ __('app.youtube') }}"/>
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.apple" label="Apple store Link"/>
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.android" label="Google Play Link"/>
                </div>

                {{--                <div class="col-md-6">--}}
                {{--                    <hr />--}}
                {{--                    <x-admin.checkbox name="state.is_payment_available"--}}
                {{--                        label="{{ __('app.is_payment_available') }}" />--}}
                {{--                    <hr />--}}
                {{--                </div>--}}
                <div class="col-md-12">
                    <x-admin.textarea name="state.description_ar" label="{{ __('app.description_ar') }}"/>
                </div>
                <div class="col-md-12">
                    <x-admin.textarea name="state.description_en" label="{{ __('app.description_en') }}"/>
                </div>
                <div class="col-md-12">
                    <x-admin.input name="state.keywords_ar" label="{{ __('app.keywords_ar') }}"/>
                </div>
                <div class="col-md-12">
                    <x-admin.input name="state.keywords_en" label="{{ __('app.keywords_en') }}"/>
                </div>

                <hr/>
                <div class="col-md-12">
                    <x-admin.tinymce name="state.home_details_ar"
                                     label="{{ __('app.home') .' '.__('app.description_ar') }}"/>
                </div>
                <div class="col-md-12">
                    <x-admin.tinymce name="state.home_details_en"
                                     label="{{ __('app.home') .' '.__('app.description_en') }}"/>
                </div>
                <div class="col-md-12">
                    <x-admin.tinymce name="state.terms_condition_ar" label="{{ __('app.terms_condition_ar') }}"/>
                </div>
                <div class="col-md-12">
                    <x-admin.tinymce name="state.terms_condition_en" label="{{ __('app.terms_condition_en') }}"/>
                </div>

                <hr/>
                <div class="col-md-12 mt-4 justify-content-center align-items-center d-flex border-1">
                    <button type="button" class="btn bg-gradient-primary btn-flat mt-4" wire:loading.attr="disabled"
                            wire:click.prevent="update">
                        <i class="far fa-save"></i>
                        @lang('app.update')
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
