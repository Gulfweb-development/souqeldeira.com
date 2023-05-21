
<div class="row mt-3">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>{{ trans('your_balance') }}:</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>{{ __('normal') }}
                            :</strong> {{ \App\Models\SubscriptionHistories::getBalance()['normal'] }}
                    </div>
                    <div class="col-md-6">
                        <strong>{{ __('featured') }}
                            :</strong> {{ \App\Models\SubscriptionHistories::getBalance()['featured'] }}
                    </div>
                </div>
                <hr>
                @lang('what_is_featured')
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4>{{ trans('buy') }} {{ trans('normal') }}</h4>
            </div>
            <div class="card-body">
                <label class="mb-3">
                    {{ __('normal') }} (x {{ \App\Models\Setting::get('price_adv', 15)}} {{ __('app.currency') }})
                </label>
                <input class="form-control mb-3" name="countNormalAds" placeholder="@lang('enter_number')">
                @error('countNormalAds') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="card-footer">
                <button class="btn btn-primary col text-center" wire:loading.attr="disabled"
                        wire:click="payAsGo('normal')">{{ trans('buy') }}</button>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4>{{ trans('buy') }} {{ trans('featured') }}</h4>
            </div>
            <div class="card-body">
                <label class="mb-3">
                    {{ __('featured') }} (x {{ \App\Models\Setting::get('price_premium_adv', 15)}} {{ __('app.currency') }})
                </label>
                <input class="form-control mb-3" name="countFeaturedAds" placeholder="@lang('enter_number')">
                @error('countFeaturedAds') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="card-footer">
                <button class="btn btn-primary col text-center" wire:loading.attr="disabled"
                        wire:click="payAsGo('featured')">{{ trans('buy') }}</button>
            </div>
        </div>
    </div>
</div>
<hr class="mt-5">
<div class="row mt-3">
    @forelse ($lists as $list)
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $list['name_'.app()->getLocale()] }}</h4>
                </div>
                <div class="card-body">
                        <ul>
                            <li>
                                <strong>@lang('app.price'):</strong> {{ $list->price }}
                            </li>
                            <li>
                                <strong>{{ trans('normal') }}:</strong> {{ $list->adv_nurmal_count }}
                            </li>
                            <li>
                                <strong>{{ trans('featured') }}:</strong> {{ $list->adv_star_count }}
                            </li>
                            <li>
                                <strong>{{ trans('expire_days') }}</strong> {{ $list->expire_time .' '.__('days') }}
                            </li>
                        </ul>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary col text-center">{{ trans('buy') }}</button>
                </div>
            </div>
        </div>
    @empty
    @endforelse
</div>
