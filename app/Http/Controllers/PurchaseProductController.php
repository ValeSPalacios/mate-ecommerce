<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Provider;
use App\Models\ProductProvider;
use App\Helpers\Notification;
use App\Http\Requests\PurchaseRequest;
use Auth;

use function PHPUnit\Framework\isNull;

class PurchaseProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = Product::all();
        return view('admin.purchase.list',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::all();
        $products = Product::all();
        //dd($products[0]->product_provider);
        return view('admin.purchase.create',compact('providers','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        //dd($request);
        $provider = Provider::find($request->provider);
        $product = Product::find($request->product);
        if(!is_null($provider) && !is_null($product)){
            $product->stock = $product->stock + $request->count;
            $product->cost_price = $request->cost_price;
            $product->increase = $request->increase;
            $product->user_updated = auth()->user()->id;
            $product->save();

            /* Pivot */
            $productProvider = ProductProvider::where('product_id',$product->id)
                ->where('provider_id',$provider->id)->first();
            if(is_null($productProvider)){
                ProductProvider::create([
                    'product_id'    =>  $product->id,
                    'provider_id'   =>  $provider->id,
                ]);
            }

            $notification = Notification::Notification('Product Successfully Update', 'success');
            return redirect()->route('admin.purchase.index')->with('notification', $notification);
        }
        $notification = Notification::Notification('Error', 'error');
        return redirect()->back()->with('notification', $notification);
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
    public function edit(Product $product, Provider $provider)
    {       

            //dd("entra edit");
            //dd($product);
            $products=[];
            $providers=[];
            $purchase=ProductProvider::select('id')->where('product_id',$product->id)->where('provider_id',$provider->id)->first();
            //dd($purchase);
            return view('admin.purchase.edit',compact('purchase','product','provider','products','providers'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseRequest $request, Product $product)
    {
        //
        //dd($request);
        if(!is_null($product)){
            $product->stock = $product->stock + $request->count;
            $product->cost_price = $request->cost_price;
            $product->increase = $request->increase;
            $product->user_updated = auth()->user()->id;
            $product->save();

            $notification = Notification::Notification('Product Successfully Update', 'success');
            return redirect()->route('admin.purchase.index')->with('notification', $notification);
        }
        $notification = Notification::Notification('Error', 'error');
        return redirect()->back()->with('notification', $notification);

    
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
