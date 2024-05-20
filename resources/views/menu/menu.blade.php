@section('menu')
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
      <img src="https://talentosdigitales.ar/assets/img/logoHeader-green.png" alt="Talento Digital Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">T D</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
          {{-- <p>Has Role {{ Auth::user()->roles[0]->name }}</p> --}}
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->



               <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa-regular fa-user me-3"></i>
                  <p class=" text-center">
                    User
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview text-center">
                  <li class="nav-item">
                    <a href="{{ route('admin.user.create') }}" class="nav-link">
                      <i class="fa-solid fa-user-plus me-3"></i>
                      <p>New</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link">
                      <i class="fa-solid fa-list me-3"></i>
                      <p>List</p>
                    </a>
                  </li>

                </ul>
              </li>
             
               <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa-solid fa-cubes me-3"></i>
                  <p>
                    Product
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview text-center">
                  <li class="nav-item">
                    <a href="{{ route('admin.product.create') }}" class="nav-link">
                      <i class="fa-solid fa-boxes-stacked me-3"></i>
                      <p>New</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.product.index') }}" class="nav-link">
                      <i class="fa-solid fa-list me-3"></i>
                      <p>List</p>
                    </a>
                  </li>

                </ul>
              </li>
             

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa-solid fa-dolly me-3"></i>
                  <p>
                    Graphics
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview text-center">
                  <li class="nav-item">
                    <a href="{{ route('admin.graphic.index') }}" class="nav-link">
                      <i class="fa-solid fa-bag-shopping me-3"></i>
                      <p>Products</p>
                    </a>
                  </li>

                </ul>
              </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Graphics
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Option 1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Option 2</p>
                </a>
              </li>

            </ul>
          </li>
        


          <li class="nav-header">SEPARATION</li>
      
          <li class="nav-item">

            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>

                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
       
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
@endsection
