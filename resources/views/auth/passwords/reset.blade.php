@extends('layouts.appClient')
@extends('layouts.logo')
@section('title','Reinicio Contraseña')
@section('content')

<div class="py-5 reset-password">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-3 rounded-3 formBody body">
                <h3 class="poppins-semibold my-4 pb-md-0 mb-md-2 px-md-3">Reseteo de contraseña</h3>

                    <div class="card-body">
                        @if($errors->has('error_message'))
                        <p class="text-danger text-center">{{ $errors->first('error_message') }}</p>
                       @endif
                       
                        <form method="POST" action="{{ route('password.update') }}"
                        novalidate>
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input id="email" type="email" class="form-control 
                                    @error('email') is-invalid @enderror"  name="email" value="{{ $email ?? old('email') }}"
                                    required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <label class="poppins-medium form-label" for="login">Correo electrónico</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <label class="poppins-medium form-label" for="password">Nueva Contraseña</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <label class="poppins-medium form-label" for="password_confirmation">Confirmar Contraseña</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <div class="col d-flex justify-content-center">
                                    <button type="submit" class="poppins-regular btn general-btn btn-lg btn-block">
                                        Guardar Contraseña
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
