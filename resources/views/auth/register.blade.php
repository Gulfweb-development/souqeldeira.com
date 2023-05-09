@extends('layouts.app-auth')
@section('meta_title',__('app.register'))
@section('meta_descrption',__('app.register'))
@section('og_title',__('app.register'))
@section('og_description',__('app.register'))
@section('og_url',Request::url())
@section('og_image',asset('images/logo-red.svg'))
@section('twitter_title',__('app.register'))
@section('twitter_description',__('app.register'))
@section('twitter_image',asset('images/logo-red.svg'))
@section('twitter_card',__('app.register'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header main-header-bg text-light">@lang('app.register')</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="type"
                                       class="col-md-4 col-form-label text-md-right">{{ __('app.account_type') }}</label>

                                <div class="col-md-6">
                                    <select name="type" class="form-control @error('type') is-invalid @enderror">
                                        <option value="USER">@lang('app.personal')</option>
                                        <option value="COMPANY">@lang('app.real_estate_office')</option>
                                    </select>

                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">@lang('app.name')</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="emailOrPhone"
                                       class="col-md-4 col-form-label text-md-right">@lang('app.email') / @lang('app.phone')</label>

                                <div class="col-md-6">
                                    <input id="emailOrPhone" type="text" class="form-control @error('phone') is-invalid @enderror  @error('email') is-invalid @enderror"
                                           name="v" value="{{ old('v') }}">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <?php
                            /*
                        ?>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('app.phone')</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone','+965') }}" placeholder="+965xxxxxxxx">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <?php
                            */
                            ?>
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">@lang('app.password')</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">@lang('app.confirm_password')</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">@lang('app.image')</label>
                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control" name="image">
                                </div>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @if ( \App\Http\Controllers\Frontend\FrontendLangController::setting()['terms_condition_'.app()->getLocale()] )
                                <div class="form-group row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-6">
                                        <div class="checkbox-group">
                                            <input class="form-check-inline @error('terms_condition') is-invalid @enderror" required type="checkbox" id="terms_condition" value="accept" name="terms_condition">
                                            <label class="form-check-label" for="terms_condition1" data-toggle="modal" data-target="#myModal" onclick="$('#myModal').modal('show');">&nbsp;{{ __('app.terms_condition') }}</label>
                                        </div>
                                    </div>
                                    @error('terms_condition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            @endif
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <br>
                                    <button type="submit" class="btn btn-primary main-header-bg">
                                        @lang('app.register')
                                    </button>
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        @lang('app.login')
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ( \App\Http\Controllers\Frontend\FrontendLangController::setting()['terms_condition_'.app()->getLocale()] )
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{ __('app.terms_condition_title') }}</h4>
                    </div>
                    <div class="modal-body">
                        {!! \App\Http\Controllers\Frontend\FrontendLangController::setting()['terms_condition_'.app()->getLocale()] !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
