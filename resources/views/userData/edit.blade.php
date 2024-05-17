@extends('layouts.appClient')
@extends('layouts.logo')
@extends('layouts.navBar')
@section('title','Editar Datos')
@section('content')


  <!-- Main content -->
  <section>
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card">
            <div class="card-header backColor colorLetter">
              <h3 class="card-title">Editar Datos</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form class="formBody" 
            action="{{route('userClient.update')}}"
             method="POST"  
            
            enctype="multipart/form-data" 
            autocomplete="off">
                  @method('PUT')
                  @csrf
                  @include('userData.partials.formDataUser')
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


@endsection
@extends('layouts.footer')
<!-- Content Wrapper. Contains page content -->

@section('scripts')
    <script src="{{ asset('js/modules/user/form.js') }}"></script>
@endsection
