@extends('layouts.app-auth')

@section('content')
@php
    $phone = explode('>', explode('<', DB::table('infos')->where('id', 1)->first()->text_en)[1])[1];
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header main-header-bg text-light">@lang('verified')</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('auth.passwords.verified.mail.post') }}">
                        @csrf
                        
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        
                        <div class="form-group row">
                            <label for="activated_code" class="col-md-4 col-form-label text-md-right">{{ __('Activated Code') }}</label>

                            <div class="col-md-6">
                                <input id="activated_code" type="number" class="form-control @error('activated_code') is-invalid @enderror" name="activated_code" value="{{ old('activated_code') }}" autofocus>

                                @error('activated_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary main-header-bg text-light">
                                    @lang('Submit')
                                </button>
                                <br/>
                                
                                <a href="/resend-code" class="btn btn-sm mt-5 btn-outline-info ">
                                    @lang('app.resend_code')
                                </a>
                                
                                <a href="tel:{{$phone}}" class="btn btn-sm mt-5 btn-outline-secondary ">
                                    @lang('app.call_us')
                                </a>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
