<nav class="navbar body">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{asset('img/logos/logo-mate.svg')}}" alt="Logo" width="100" height="100" class="d-inline-block align-text-top">
        </a>
        <div class="d-flex">
            @guest
                @if(Route::has('register'))
                    <div class="col-7 col-sm-7">
                        <a href="{{route('register')}}" class="body poppins-medium">
                            <h5>Registrarse</h5>
                        </a>
                    </div>
                @endif

                @if(Route::has('login'))
                    <div class="col-5 col-sm-5">
                        <a href="{{route('login')}}"  class="body poppins-medium">
                            <h5>Ingresar</h5>
                        </a>
                    </div>
                @endif
                @else

                <div class="btn-group">
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="{{ route('cart.index') }}">
                            <i class="fa fa-shopping-cart fa-2xl pr-2 nav-icon" aria-hidden="true"></i>
                        </a>
                    </div>
                    <button class="poppins-medium dropdown-toggle btn p-2" style="font-size: 20px" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->username }}
                    </button>
                    <ul class="poppins-regular logo-navbar-nav dropdown-menu dropdown-menu-end dropdown-menu-lg-start body">
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="{{route('userClient.index')}}"> {{ __('Editar Datos') }} </a>
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