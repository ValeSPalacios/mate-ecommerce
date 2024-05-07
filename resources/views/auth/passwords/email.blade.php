@extends('layouts.appClient')
@extends('layouts.logo')
@extends('layouts.navBar')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card formBody">
                <div class="card-header text-center backColor colorLetter">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if($errors->has('error_message'))
                    <p class="text-danger text-center">{{ $errors->first('error_message') }}</p>
                   @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="login" class="col-md-4 col-form-label text-md-end">{{ __('Email|Username') }}</label>

                            <div class="col-md-6">
                                <input id="login" type="login" class="form-control 
                                @error('login') is-invalid @enderror" name="login" 
                                value="{{ old('login') }}" required autocomplete="email" autofocus>

                                @error('login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btnStyle1">
                                    {{ __('Send Password Reset Link') }}
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

@extends('layouts.footer')
