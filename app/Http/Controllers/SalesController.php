<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesDetails;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SalesController extends Controller
{
    
    public function buy($idCart){
        
        
       try {
          DB::beginTransaction();
          //recupero el carrito del producto
           $cart = Cart::with('carts_details')->where('user_created',auth()->user()->id)
           ->first();
        
           //dd(count($cart->carts_details)==0);
                if(is_null($cart)) {
                    Session::flash('empty_cart',1);
                    return redirect()->route('index');
                }
           //el total de la compra
           $total=0;
           
           //La cabecera de la compra
           $salesHead=Sales::create([
            'user_id'=>auth()->user()->id
           ]);
           //dd($salesHead);
            //controlo inicialmente que se tengan datos en el carrito, en los detalles y que la cabecera
            //se haya creado

            if(count($cart->carts_details)==0 || empty($salesHead) || empty($cart)){
                DB::rollBack();
                return back()->withErrors(['buyError'=>'Error al comprar los productos']);
            }
           
            $total=$this->calculateTotal($cart);
           //Recorro el carrito con los detalles del producto
           foreach ($cart->carts_details as $detail) {
                
                //Controlo que el stock del producto sea mayor a la cantidad del detalle
                //para ese producto en el carrito
                if($detail->count<=$detail->product->stock){
                   
                    $newDetail=SalesDetails::create(
                        [
                           
                            'sale_id'=>$salesHead->id,
                            'product_id'=>$detail->product->id,
                            'quantity'=>$detail->count,
                            'sale_price'=>$detail->cost_price,
                            'increase'=>$detail->product->increase,
                            
                        ]
                        );
                        $product=Product::find($detail->product->id);
                        $product->stock=$product->stock-$detail->count;
                        $product->save();
                    if(is_null($newDetail)){
                        DB::rollBack();
                        return back()->withErrors(['buyError'=>'Error al comprar los productos']);
                    } 
                }else{
                    DB::rollBack();
                    return back()
                    ->withErrors(['buyError'=>'El stock del producto '.$detail->product->name.' '.'es menor a la cantidad deseada']);
                };
               
           };
         $salesHead=Sales::find($salesHead->id);
         $salesHead->total=$total;
         $salesHead->save();
         CartDetail::where('cart_id',$cart->id)->delete();
         $cart->delete();
         DB::commit();
         Session::flash('buy_success','Gracias por su compra');
         return redirect()->route('index');

       } catch (\Throwable $th) {
        //throw $th;
        DB::rollBack();
        dd($th);
       }
    }
    
    private function calculateTotal($cart){
        foreach ($cart->carts_details as $key => $detail) {
            $total=0;
            $total += (((($detail->increase * $detail->cost_price) / 100) + $detail->cost_price) * $detail->count);
            return $total;
        }
    }
}