@extends('layouts.appClient')

@section('title','Registrarse')

@section('logo')
    @include('layouts.logo')
@endsection

@section('nav')
    @include('layouts.navBar')
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center backColor colorLetter" id="headRegister">
                    {{ __('Register') }}
                </div>

                <div class="card-body" id="formBody">
                    <form method="POST" action="{{ route('register') }}"
                    id="formRegister">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                {{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control
                                 @error('username') is-invalid @enderror" 
                                 name="username" value="{{ old('username') }}"
                                  required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col d-flex justify-content-center">
                                <button type="submit" class="btn btnStyle1">
                                    {{ __('Register') }}
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


@if(session()->has('succes_register'))
    @section('scripts')
        <script>
            Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Se ha registrado correctamente",
            showConfirmButton: false,
            timer: 1500
            });
        </script>
    @endsection
@endif


@section('footer')
    @include('layouts.footer')
@endsection
