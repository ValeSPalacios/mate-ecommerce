<nav class="navbar body">
    
    <div class="container-fluid">
       <a class="navbar-brand" href="/">
            <img src="{{asset('img/logos/logo-mate.svg')}}" alt="Logo" width="100" height="100" class="d-inline-block align-text-top">
        </a>
        <div class="d-flex">
            @guest
                @if(Route::has('register'))
                    <div class="col-7 col-sm-7">
                        <a href="{{route('register')}}" class="body poppins-regular">
                            Registrarse
                        </a>
                    </div>
                @endif

                @if(Route::has('login'))
                    <div class="col-5 col-sm-5">
                        <a href="{{route('login')}}"  class="body poppins-regular">
                            Ingresar
                        </a>
                    </div>
                @endif
                @else

                <div class="btn-group">
                    <button class="poppins-medium dropdown-toggle btn p-2" style="font-size: 20px" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->username }}
                    </button>
                    <ul class="poppins-regular logo-navbar-nav dropdown-menu dropdown-menu-end dropdown-menu-lg-start body">
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="#"> {{ __('Editar Datos') }} </a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"> {{ __('Salir') }} </a>
                        </li>
                    </ul>
                </div>
            @endguest
        </div>
    </div>
</nav>


<!--<div class='container d-lg-flex justify-content-center'>
    <div class='row'>
        @guest
            <div class='col-lg-5 d-flex justify-content-center' id='headerImg'>
        @else
            <div class='col-lg-12 d-flex justify-content-center' id='headerImg'>
        @endguest
    
        <div class="m-auto">
            <img src="{{asset('img/logos/logo-mate.svg')}}" class="img-fluid"/>
        </div>
            
    </div>

    <div class='col-lg-7 col-md-12 d-flex align-items-center opcionesRegistro'>
        <div class="container ms-lg-5">
            <div class="row ms-5 fw-bold">
                @guest
                    @if(Route::has('register'))
                        <div class="col-7 col-sm-8">
                            <a href="{{route('register')}}" class="bi bi-people-fill">
                                Registrarse
                            </a>
                        </div>
                    @endif

                    @if(Route::has('login'))
                        <div class="col-5 col-sm-4">
                            <a href="{{route('login')}}"  class="bi bi-bookmark-check">
                                Login
                            </a>
                        </div>
                    @endif
                @endguest
            </div>
        </div>
    </div>
</div> -->
