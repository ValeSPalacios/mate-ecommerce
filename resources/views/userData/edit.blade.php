@extends('layouts.appClient')
@extends('layouts.logo')
@extends('layouts.navBar')
@section('title','Editar Datos')
@section('content')

  <section class="gradient-custom edit-user-style">
    <div class="container py-5">
      <div class="row justify-content-center align-items-center">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration">
            <form class="formBody body" 
              action="{{route('userClient.update')}}"
              method="POST"  
            
              enctype="multipart/form-data" 
              autocomplete="off">
                  @method('PUT')
                  @csrf
                  @include('userData.partials.formDataUser')
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
@extends('layouts.footer')

@section('scripts')
    <script src="{{ asset('js/modules/user/form.js') }}"></script>
@endsection
