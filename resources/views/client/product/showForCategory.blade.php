@extends('layouts.appClient')
@extends('layouts.logo')
@extends('layouts.navBar')
@section('title',$category)
@section('content')


  <!-- Main content -->
  <section>
    <div class="container-fluid products-style py-4">
      <h3 class="poppins-semibold p-4 mb-4">Productos relacionados</h3>
      <div class="row justify-content-around">
        <!-- left column -->
        <div class="col-12 justify-content-around">
          <!-- general form elements -->
            <!-- /.card-header -->
            <div class="container justify-content-around">
              <div class="row justify-content-around">
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
    <div class="d-flex products-style justify-content-center pb-4">
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
