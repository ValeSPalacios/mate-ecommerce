@extends('layouts.appClient')

@section('title','Home')
@section('logo')
    @include('layouts.logo')
@endsection
@section('nav')
    @include('layouts.navBar')
@endsection

@section('content')
    <div class="content">
        <!-- Inicio carousel -->
        <div class="row carousel-style justify-content-center py-4">
            <div id="carouselExampleCaptions" class="carousel slide w-50">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="{{asset('image/home/portada-1.svg')}}" alt="...">
                    <div class="carousel-caption d-none d-sm-block">
                        <h3>Nuestro local</h3>
                        <p>Podés visitar el local para compras y entregas inmediatas.</p>
                    </div>
                    </div>
                    <div class="carousel-item">
                    <img src="{{asset('image/home/portada-2.svg')}}" alt="...">
                    <div class="carousel-caption d-none d-sm-block">
                        <h3>Mates</h3>
                        <p>Tenemos todos los tipos: de madera, vidrio, calabaza, acrílico, cerámica, plástico, ¡para todos los gustos!</p>
                    </div>
                    </div>
                    <div class="carousel-item">
                    <img src="{{asset('image/home/portada-3.svg')}}" alt="...">
                    <div class="carousel-caption d-none d-sm-block">
                        <h3>Regionales</h3>
                        <p>Accesorios, bombillas, bazar, botellas deportivas, set de asado, encontras todo lo que necesitas para tu negocio!</p>
                    </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>


        <div class="row row-cols-1 row-cols-md-3 align-items-center home-banner-style py-4 poppins-semibold">
            <div class="col align-middle py-4">
                <div class="d-flex justify-content-center align-items-center">
                    <i class="fa fa-truck fa-2xl pr-2" aria-hidden="true"></i>
                    <h5 class="poppins-semibold">Envíos nacionales e internacionales</h5>
                </div>
            </div>
            <div class="col align-middle py-4">
                <div class="d-flex justify-content-center align-items-center">
                    <i class="fa fa-credit-card fa-2xl pr-2" aria-hidden="true"></i>
                    <h5 class="poppins-semibold">3 cuotas sin interés</h5>
                </div>
            </div>
            <div class="col align-middle py-4">
                <div class="d-flex justify-content-center align-items-center">
                    <i class="fa fa-usd fa-2xl pr-2" aria-hidden="true"></i>
                    <h5 class="poppins-semibold">25% de descuento en efectivo o transferencia</h5>
                </div>
            </div>
        </div>

        <div class="row products-style justify-content-around py-4">
            <h3 class="poppins-semibold p-4">Conocé nuestros productos</h3>
            <div class="col-12 justify-content-around">
                <div class="container justify-content-around">
                    <div class="row justify-content-around">
                        @foreach ($products as $product)
                            <div class="col">
                                <a href="{{route('showProduct',$category=3)}}">
                                    <div class="card body" style="width: 20rem;">
                                        <img src="{{asset($product->product_image)}}" alt="products_home" height="250px">
                                        <div class="card-body">
                                            <h4 class="card-title poppins-medium">{{$product->name}}</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Muestra una notificación para confirmar
que se envió el mail de reseteo de
contraseña-->
@if(session()->has('success_send_reset_mail'))
    @section('scripts')
        <script>
            Swal.fire({
            position: "center",
            icon: "success",
            color: "#C07F49",
            iconColor: "#C07F49",
            title: "Se ha enviado un mensaje a su correo electrónico",
            showConfirmButton: true,
            timer: 1500
            });
        </script>
    @endsection
@endif

@section('footer')
    @include('layouts.footer')
@endsection