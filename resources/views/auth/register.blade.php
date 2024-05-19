@extends('layouts.appClient')

@section('title','Registrarse')

@section('logo')
    @include('layouts.logo')
@endsection

@section('content')

    <section class="h-100 h-custom register-style">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <img src="{{asset('image/mate-register.svg')}}"
                            class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
                            alt="Sample photo">
                        <div class="card-body p-4 p-md-5 body">
                            <h3 class="poppins-semibold mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Registración</h3>

                            <form class="px-md-2" method="POST" action="{{ route('register') }}" id="formRegister"
                            novalidate>
                                @csrf

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input id="username" type="text" class="form-control
                                        @error('username') is-invalid @enderror" 
                                        name="username" value="{{ old('username') }}"
                                        required autocomplete="username" autofocus>
                                    <label class="poppins-medium form-label" for="username">Usuario</label>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <label class="poppins-medium form-label" for="email">Correo electrónico</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <label class="poppins-medium form-label" for="password">Contraseña</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input id="password-confirm" type="password" class="form-control form-control-lg @error('password-confirm') is-invalid @enderror" name="password-confirm" required autocomplete="new-password">
                                    <label class="poppins-medium form-label" for="password-confirm">Confirmar contraseña</label>
                                    @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>

                                <div class="pt-1 mb-4">
                                    <div class="col d-flex justify-content-center">
                                        <button type="submit" class="poppins-regular btn general-btn btn-lg btn-block">
                                            Registrarse
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@if(session()->has('succes_register'))
    @section('scripts')
        <script>
            Swal.fire({
            position: "center",
            icon: "success",
            color: "#C07F49",
            iconColor: "#C07F49",
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
