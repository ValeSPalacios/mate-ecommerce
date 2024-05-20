@extends('layouts.app')
@extends('layouts.navBarAdmin')
@extends('menu.menu')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title text-center">Create User</h3>
              </div>
              <!-- /.card-header -->

              <!-- form start -->
              <!--Quitar o agregar este onsubmit para probar que funcionen los controles del backend
                onsubmit="return validateForm(true);"-->
              <form method="post" action="{{ route('admin.user.store') }}"
                enctype="multipart/form-data" autocomplete="off"
                onsubmit="return validateForm()"
             >
                    @csrf
                    @include('admin.user.partials.form')
                    
              </form>
            </div>
            <!-- /.card -->



          </div>
          <!--/.col (left) -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/modules/user/form.js') }}"></script>
@endsection
