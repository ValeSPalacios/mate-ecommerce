@extends('layouts.appClient')
@extends('layouts.logo')
@extends('layouts.navBar')
@section('title','Carrito')
    
@section('content')
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper" style="margin-left: 0px;">
        <!-- Main content -->
        <div class="content">
            <div>
                <form action={{route('buyProducts',$cart->id)}} method="post">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        Buy
                    </button>
                </form>
            </div>
            <div class="container">
                @if($errors->has('msgError'))
                <p class="text-danger text-center">{{ $errors->first('msgError') }}</p>
               @endif
                <div class="row col-12 mt-4">
                            <h2>Cart</h2>
                            <table id="cartList" class="table table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Count</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                    <th>Add One</th>
                                    <th>Reduce One</th>
                                    <th>Delete Item</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart->carts_details as $detail)
                                        <tr>
                                            <td>{{ $detail->product->name }}</td>
                                            <td>{{ $detail->count }}</td>
                                            <td>{{ number_format($detail->cost_price,2,'.',',') }}</td>
                                            {{-- <td>$ {{number_format((((($detail->increase * $detail->cost_price) / 100) + $detail->cost_price) * $detail->count),2,',','.')  }}</td> --}}
                                            <td>$ {{ number_format($detail->costPrice,2,'.',',') }}</td>
                                            <td>
                                                <form action="{{route('cart.update',$detail->id)}}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" name="add" value="add">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </button> 
                                                </form>
                                                
                                            </td>
                                            <td>
                                                <form action="{{route('cart.update',$detail->id)}}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" name="minus" value="minus">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </button> 
                                                </form>
                                                
                                            </td>
                                            <td>
                                                <a href="">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                                <tfoot>
                                    <th colspan="3" class="text-right">Total</th>
                                    <th>$ {{ number_format($cart->total,2,'.',',') }}</th>
                                </tfoot>
                            </table>



                </div>
                
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@if ($errors->has('buyError'))
@section('scripts')
    <script>
        Swal.fire({
        icon: "error",
        title: "Error al realizar la compra",
        text:'{{$errors->first('buyError')}}'
       
        });
    </script>
@endsection
    
@endif


@extends('layouts.footer')
       


