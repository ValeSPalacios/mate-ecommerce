@section('nav')
    <div class="d-flex justify-content-center" id="navGuestBar">
        <nav class="navbar">
            <div class="container-fluid">
                <button class="btn d-lg-none hamburgerBtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbar"
                    aria-controls="navbar">
                    <i class="fa-solid fa-bars hamburguerIcon"></i>

                </button>
                <div class="offcanvas-lg offcanvas-end" tabindex="-1" id="navbar"
                    aria-labelledby="offcanvasResponsiveLabel">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#navbar"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body optionBar">

                        <nav class="navbar navbar-expand-lg">
                            <div class="container-fluid">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5">
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="{{ route('index') }}">Home</a>
                                    </li>


                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Productos
                                        </a>
                                        <ul class="dropdown-menu optionBar">
                                            <li><a class="dropdown-item" id="equipoMate"
                                                    onclick="getProduct('${catEquipoMate}')">
                                                    Equipos De Mate</a></li>
                                            <li><a class="dropdown-item" id="mate"
                                                    onclick="getProduct('${catMate}')">Mate</a></li>
                                            <li><a class="dropdown-item" id="termo-mate">Termos y Mates</a></li>
                                            <li><a class="dropdown-item" id="latas">Juego De Latas</a></li>
                                            <li><a class="dropdown-item" id="bolsos">Bolsos Materos</a></li>
                                        </ul>

                                    </li>


                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="#">Info</a>
                                    </li>


                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href='${contact}'>Contacto</a>
                                    </li>

                                    @guest

                                    @else
                                        <li class="nav-item">
                                            <div class="dropdown">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#"
                                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" v-pre>
                                                    <i class="fa-regular fa-user"></i>

                                                </a>

                                                <div class="dropdown-menu dropdown-menu-start backColor colorLetter"
                                                    aria-labelledby="navbarDropdown">

                                                    <span class="fs-5 text-center d-block">
                                                        {{ Auth::user()->username }}
                                                    </span>
                                                     <!-- Empieza Codigo logout-->
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                   
                                                        onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                                                        <i class="fa-solid fa-power-off w-75">
                                                            {{ __('Logout') }}
                                                        </i>

                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                        class="d-none">
                                                        @csrf
                                                    </form>
                                                     <!-- Empieza Codigo logout-->
                                                    <a class="dropdown-item" href="{{ route('userClient.index') }}">
                                                        <i class="fa-solid fa-book w-75">

                                                            {{ __('Editar Datos') }}
                                                        </i>




                                                    </a>




                                                </div>
                                            </div>
                                        </li>
                                    @endguest

                                </ul>

                            </div>
                        </nav>
                    </div>
                </div>
            </div>

    </div>
    </nav>
    </div>
@endsection
