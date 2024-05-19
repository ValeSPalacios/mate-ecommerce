@extends('layouts.appClient')

@section('title','Home')
@section('logo')
    @include('layouts.logo')
@endsection
@section('nav')
    @include('layouts.navBar')
@endsection

@section('content')
    <div
        class="alert alert-primary"
        role="alert"
    >
        <strong>Warning!</strong
        ><a href="#" class="alert-link">Click Here</a>
    </div>
    
    
@endsection

<!--Muestra el mensaje exitoso para mostrar que se envió el mail de reseteo de
contraseña-->
@if(session()->has('success_send_reset_mail'))
    @section('scripts')
        <script>
            Swal.fire({
            position: "center",
            icon: "success",
            color: "#C07F49",
            iconColor: "#C07F49",
            title: "Mail De Reinicio Enviado Correctamente",
            showConfirmButton: true,
            timer: 1500
            });
        </script>
    @endsection
@endif



@section('footer')
    @include('layouts.footer')
@endsection