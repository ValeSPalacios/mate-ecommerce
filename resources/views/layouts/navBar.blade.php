@section('nav')
<ul class="nav nav-tabs justify-content-center navGuestBar poppins-regular">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Inicio</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Productos
        </a>
        <ul class="dropdown-menu body logo-navbar-nav">
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
        <a class="nav-link" href="#">Información</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href='#'>Contacto</a>
    </li>
</ul>
@endsection
