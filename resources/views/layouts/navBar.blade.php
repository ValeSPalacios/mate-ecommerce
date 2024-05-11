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
                                            @foreach ($categories as $category)
                                            <li><a class="dropdown-item" id="equipoMate"
                                                href="{{route('showProduct',$category->id)}}">
                                                {{$category->name}}
                                            </a>
                                            </li>
                                            @endforeach
                                        </ul>

                                    </li>


                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="#">Info</a>
                                    </li>


                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href='${contact}'>Contacto</a>
                                    </li>

                                    

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
