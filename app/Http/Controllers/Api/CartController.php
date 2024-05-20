<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\DetailResource;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return response('Error al recuperar los datos del carrito',404);
    
        

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
    
        $detail=CartDetail::find($request->query('detailId'));
        $detail->delete();
        return response()->noContent();
    }
}
