@extends('layouts.appClient')
@extends('layouts.logo')
@extends('layouts.navBar')
@section('title','Carrito')
    
@section('content')
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper" style="margin-left: 0px;">
       @if (isset($cart))
       <div class="content">
        <div>
            <form action={{route('buyProducts',$cart->id)}} method="post">
                @csrf
                <button type="submit" class="btn btn-success">
                    Buy
                </button>
            </form>
            
            
        </div>
       </div>
       @endif
        
            <div class="container">
                
                @if($errors->has('msgError'))
                <p class="text-danger text-center">{{ $errors->first('msgError') }}</p>
               @endif
               <div id="appVue">
                
                    <appmainvue :idUserLogin="{{Auth::user()->id}}"></appmainvue>
               </div>
                
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@extends('layouts.footer')
       


