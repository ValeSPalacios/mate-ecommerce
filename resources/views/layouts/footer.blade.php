@section('footer')
<div class="container-fluid footer-style poppins-medium text-center">
    <div class="row row-cols-1 row-cols-md-3 align-items-center">
        <div class="col align-middle py-4">
            <a class="navbar-brand" href="/">
                <img src="{{asset('img/logos/logo-mate.svg')}}" alt="Logo" width="100" height="100" class="d-inline-block align-text-top">
            </a>
        </div>
        <div class="col align-middle py-4">
            <div class="d-flex justify-content-evenly">
                <a href="https://web.whatsapp.com/" target='_blank'>
                    <i class="fa-brands fa-whatsapp fa-2xl footer-icon"></i>
                </a>
                <a href="https://www.instagram.com/" target='_blank'>
                    <i class="fa-brands fa-instagram fa-2xl footer-icon"></i>
                </a>
                <a href="https://www.facebook.com/" target='_blank'>
                    <i class="fa-brands fa-facebook fa-2xl footer-icon"></i>
                </a>
            </div>
            <div class="pt-4">¡Contactanos en nuestras redes sociales!</div>
        </div>
        <div class="col align-middle py-4">
            <div>
                <a href="https://maps.app.goo.gl/z4H85udvG3qk8jdFA" target='_blank'> <i class="fa-solid fa-house fa-xl footer-icon pr-2"></i> </a>        
                Calle Junín 1549
            </div>
            <div class="pt-4">
                <i class="fa-regular fa-envelope fa-xl footer-icon pr-2"></i>
                mate_shop@gmail.com
            </div>
        </div>
    </div>
</div>

@endsection