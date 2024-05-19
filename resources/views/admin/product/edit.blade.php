@extends('layouts.app')
@extends('layouts.nav')
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
                <h3 class="card-title">Create Product</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- form start -->
                <form method="post" action="{{ route('admin.product.update',$product->id) }}"
                 id="updateForm"
                  onsubmit="return validateUpdateProduct({{$product}})"
                  enctype="multipart/form-data" autocomplete="off"
                  >
                        @csrf
                        @method('put')
                        @include('admin.product.partials.form')
                        
                </form>
              </div>


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
    <script src="{{ asset('js/modules/product/forms.js') }}"></script>
@endsection