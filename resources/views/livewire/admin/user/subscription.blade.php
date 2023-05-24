<div>
    <div class="row mt-3">
        @if ( $error_message != "" )
            <div class="col-md-12">
                <div class="alert alert-danger">{!! $error_message !!}</div>
            </div>
        @endif
        @if ( $success_message != "" )
            <div class="col-md-12">
                <div class="alert alert-success">{!! $success_message !!}</div>
            </div>
        @endif
        <div class="col-md-6">
            <div class="card  mt-1">
                <div class="card-header">
                    <h4>{{ trans('your_balance') }}:</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>{{ __('normal') }}
                                :</strong> {{ \App\Models\SubscriptionHistories::getBalance($user)['normal'] }}
                        </div>
                        <div class="col-md-6">
                            <strong>{{ __('featured') }}
                                :</strong> {{ \App\Models\SubscriptionHistories::getBalance($user)['featured'] }}
                        </div>
                    </div>
                    <hr>
                    @lang('what_is_featured')
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card  mt-1">
                <div class="card-header">
                    <h4>{{ trans('buy') }} {{ trans('normal') }}</h4>
                </div>
                <div class="card-body">
                    <label class="mb-3">
                        {{ __('normal') }}
                    </label>
                    <input class="form-control mb-3" wire:model.defer="countNormalAds" name=""
                           placeholder="@lang('enter_number')">
                    @error('countNormalAds') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary col text-center" wire:loading.attr="disabled"
                            wire:click="payAsGo('normal')">{{ trans('buy') }}</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card  mt-1">
                <div class="card-header">
                    <h4>{{ trans('buy') }} {{ trans('featured') }}</h4>
                </div>
                <div class="card-body">
                    <label class="mb-3">
                        {{ __('featured') }}
                    </label>
                    <input class="form-control mb-3" wire:model.defer="countFeaturedAds" name=""
                           placeholder="@lang('enter_number')">
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
                <div class="card  mt-1">
                    <div class="card-header">
                        <h4>{{ $list['name_'.app()->getLocale()] }}</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>
                                <strong>@lang('app.price'):</strong> {{ $list->price }} {{ __('app.currency') }}
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
                        <button class="btn btn-primary col text-center" wire:loading.attr="disabled"
                                wire:click="package({{$list->id}})">{{ trans('buy') }}</button>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
