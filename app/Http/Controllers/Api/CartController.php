<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\DetailResource;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(Request $request){
        // aca podemos implementar API Resources que nos provee laravel
        /* return Comment::all(); */
        
        
        //dd($collection);
        $cart=Cart::where('user_created',$request->idUser)->first();
        //dd($cart);
        if(!empty($cart)){
            return DetailResource::collection(CartDetail::with(['product'])
            ->where('cart_id',$cart->id)
            ->paginate(5));
        }
        return response(null,404);
    
        

    }
   
    public function update( Request $request){

        $data=$request->all()['params'];
        //dd($data['params']['detailId']);
        $detail=CartDetail::find($data['detailId']);

        $detail->count+=$data['increment'];
        $detail->save();
    }


   
    public function destroy(Request $request){
        //dd($request->query('detailId'));
    
        $detail=CartDetail::with('cart')->where('id',$request->query('detailId'))->first();
    
        
        if(!is_null($detail)){
           $idCart=$detail->cart->id;
           $detail->delete();
           $cart=Cart::with('carts_details')->where('id',$idCart)->first();
           $data= (array)json_decode(json_encode($cart->carts_details,true));
           if(count($data)==0){
                $cart->delete();   
                return response('Carrito vacío',200);
           } 
            
        }

        return response()->noContent();
       
        
    }

   
}
