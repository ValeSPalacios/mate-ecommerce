@extends('layouts.appClient')
@extends('layouts.logo')
@extends('layouts.navBar')
@section('title',$category)
@section('content')


  <!-- Main content -->
  <section>
    <div class="container-fluid products-style">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
            <!-- /.card-header -->
            <div class="container">
              <div class="row">
                @foreach ($products as $product)
                  @include('client.product.partials.productCard') 
                @endforeach
               
              </div>
            </div>
            
                  
           
          <!-- /.card -->



        </div>
        <!--/.col (left) -->

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->

    <!--Código para la paginación-->
    <div class="d-flex justify-content-center">
      {{ $products->links() }}
    </div>
   
  </section>
  <!-- /.content -->


@endsection
@extends('layouts.footer')
<!-- Content Wrapper. Contains page content -->

@section('scripts')
    <script src="{{ asset('js/modules/cart/control.js') }}"></script>
@endsection
