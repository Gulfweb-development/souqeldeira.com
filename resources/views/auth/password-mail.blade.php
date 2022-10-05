@extends('layouts.app-auth')

@section('content')
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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
