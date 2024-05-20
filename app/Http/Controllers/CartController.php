<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Helpers\Notification;
use App\Models\Category;
use Exception;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        $cart = Cart::with('carts_details')->where('user_created',auth()->user()->id)->first();
        if(is_null($cart)) {
            Session::flash('empty_cart',1);
            return redirect()->route('index');
        }
        /*$total = 0;
        foreach ($cart->carts_details as $key => $detail) {
            $cart->carts_details[$key]->costPrice = (((($detail->increase * $detail->cost_price) / 100) + $detail->cost_price) * $detail->count);
            $total += (((($detail->increase * $detail->cost_price) / 100) + $detail->cost_price) * $detail->count);
        }*/
        //$cart->total = $total;
        return view('cart.listVue',compact('cart','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {
            DB::beginTransaction();
            $product = Product::find($request->product_id);
            $cart = Cart::where('user_created',auth()->user()->id)->first();
            if(is_null($cart)){
                $cart = Cart::create([
                    'date'          =>  Carbon::now(),
                    'user_created'  =>  auth()->user()->id,
                    'user_updated'  =>  auth()->user()->id,
                ]);
                $detail = CartDetail::create([
                    'cart_id'       =>  $cart->id,
                    'product_id'    =>  $product->id,
                    'cost_price'    =>  $product->cost_price,
                    'increase'      =>  $product->increase,
                    'count'         =>  $request->count,
                ]);

            }else{
                $detail = CartDetail::where('cart_id',$cart->id)->where('product_id',$product->id)->first();
                if(is_null($detail)){
                    $detail = CartDetail::create([
                        'cart_id'       =>  $cart->id,
                        'product_id'    =>  $product->id,
                        'cost_price'    =>  $product->cost_price,
                        'increase'      =>  $product->increase,
                        'count'         =>  $request->count,
                    ]);
                }else{
                    $detail->cost_price     =  $product->cost_price;
                    $detail->increase       =  $product->increase;
                    $detail->count          = $detail->count  + $request->count;
                    $detail->save();
                }
            }
            if(!is_null($cart) && !is_null($detail)){
                $product->stock = $product->stock - $request->count;
                $product->save();
                DB::commit();
                $notification = Notification::Notification('Product Successfully Add', 'success');
                return redirect()->route('cart.index')->with('notification', $notification);
            }
        } catch (\Exception $e) {
/*             dd($e); */
            DB::rollBack();
            $notification = Notification::Notification('Error', 'error');
            return redirect('/')->with('notification', $notification);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id_cart_detail)
    {
        //
        $variation=!is_null($request->input('add'))?1:(!is_null($request->input('minus'))?-1:0);
       $cart_detail=CartDetail::find($id_cart_detail);
       if(!is_null($cart_detail) && $variation!=0){
            $cart_detail->count+=$variation;
            $cart_detail->save();
            return redirect()->route('cart.index');
       }else{
            return redirect()->route('cart.index')->withErrors(['msgError'=>'Error al modificar los datos del producto']);
       }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
