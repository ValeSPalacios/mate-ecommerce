@extends('layouts.appClient')
@extends('layouts.logo')

@section('content')
<div class="container py-5 reset-password">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-3 rounded-3 formBody body">
                <h3 class="poppins-semibold my-4 pb-md-0 mb-md-2 px-md-3">Reseteo de contraseña</h3>
                <h5 class="poppins-regular pb-md-0 mb-md-2 px-md-3">
                    Enviaremos un link a su correo electrónico.
                </h5>

                <div class="card-body">
                    @if($errors->has('error_message'))
                    <p class="text-danger text-center">{{ $errors->first('error_message') }}</p>
                   @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div data-mdb-input-init class="form-outline mb-4">
                            <input id="login" type="login" class="form-control 
                                @error('login') is-invalid @enderror" name="login" 
                                value="{{ old('login') }}" required autocomplete="email" autofocus>
                                @error('login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <label class="poppins-medium form-label" for="login">Usuario o Correo electrónico</label>
                        </div>

                        <div class="pt-1 mb-4">
                            <div class="col d-flex justify-content-center">
                                <button type="submit" class="poppins-regular btn general-btn btn-lg btn-block">
                                    Enviar
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
