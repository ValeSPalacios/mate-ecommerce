@extends('layouts.appClient')

@section('title','Login')

@section('logo')
    @include('layouts.logo')
@endsection

@section('content')



<section class="login-style">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card body" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="{{asset('image/mate-login.svg')}}" alt="login-form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center body">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <a href="/">
                                            <img src="{{asset('img/logos/logo-mate.svg')}}" alt="Logo" width="70" height="70">
                                        </a>
                                        <span class="poppins-semibold h1 fw-bold mb-0">¡Bienvenido!</span>
                                    </div>
                                    
                                    <h5 class="poppins-light fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Ingresa tu cuenta</h5>
                                    
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input id="login" type="text" class="form-control form-control-lg @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" 
                                        required autocomplete="login" autofocus>
                                        <label class="poppins-medium form-label" for="login">Correo o usuario</label>
                                        @if(session()->has('login_error'))
                                            <p class="poppins-medium text-danger pb-2">{{ session('login_error') }}</p>
                                        @endif
                                        @error('error_login')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        <label class="poppins-medium form-label" for="password">Contraseña</label>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-check d-flex justify-content-start mb-4">
                                        
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="poppins-light form-check-label" for="remember">
                                            {{ __('Recuerdame') }}
                                        </label>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button data-mdb-button-init data-mdb-ripple-init class="poppins-regular btn login-btn btn-lg btn-block" type="submit">Ingresar</button>
                                    </div>
                                    
                                    @if (Route::has('password.request'))
                                            <a class="poppins-light small text-muted" href="{{ route('password.request') }}">
                                                {{ __('¿Olvidaste la contraseña?') }}
                                            </a>
                                    @endif
                                    <p class="poppins-light mb-5 pb-lg-2" style="color: #393f81;">¿No tienes una cuenta? <a href="#!"
                                        style="color: #393f81;">Regístrate aquí</a></p>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('footer')
    @include('layouts.footer')
@endsection