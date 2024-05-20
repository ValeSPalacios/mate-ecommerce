@extends('layouts.appClient')
@extends('layouts.logo')
@extends('layouts.navBar')
@section('title','Carrito')
    
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="py-4 cart-view">
        <div class="row p-4">
            <div>
                @if($errors->has('msgError'))
                <p class="text-danger text-center">{{ $errors->first('msgError') }}</p>
                @endif
                <div id="appVue">
                    <appmainvue :idUserLogin="{{Auth::user()->id}}"></appmainvue>
                </div>
            </div>
        </div>
        @if (isset($cart))
            <div class="d-flex justify-content-center pb-4">
                <form action={{route('buyProducts',$cart->id)}} method="post">
                    @csrf
                    <button type="submit" class="btn general-btn">
                        Comprar
                    </button>
                </form>
            </div>
        @endif
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@extends('layouts.footer')