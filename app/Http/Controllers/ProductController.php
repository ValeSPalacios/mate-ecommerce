<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Helpers\Notification;
use Exception;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.list',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('product_image')) {
            $image = $request->file('product_image');
            $type = $image->getClientOriginalExtension();
            $img = date('Y-m-d-H-i-s') .  '.' . $type;
            $image->move('image/product/', $img);

            $product_image = 'image/product/' . $img;
        } else {
            $product_image = '/dist/img/user2-160x160.jpg';
        }

        $data = [
            'description'       =>$request->description,
            'product_image'     =>$product_image,
            'cost_price'        =>null,
            'increase'          =>null,
            'stock'             =>null,
            'enabled'           =>true,
            'user_created'      =>auth()->user()->id,
            'user_updated'      =>auth()->user()->id,
        ];

        $product = Product::create($data);
        if(!is_null($product)){
            $notification = Notification::Notification('Product Successfully Created', 'success');
            return redirect('product')->with('notification', $notification);
        }
        $notification = Notification::Notification('Error', 'error');
        return redirect('product/create')->with('notification', $notification);

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
    public function update(Request $request, $id)
    {
        //
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

    /**
     * Permite mostrar todos los productos a los clientes
     */

    public function showToClient($id_category=1){
    
        $products=Product::where('category_id',$id_category)->paginate(3);
        $categories=Category::all();
        $category='Productos';
        //busco qué categoria, de todas las existentes, es la que se está mostrando
        for($i=0;$i<count($categories);$i++){
           if($categories[$i]->id==$id_category) {
                $category=$categories[$i]->name;
                $i=count($categories)+1;
           };
        };
        //dd($category);
        return view('client.product.showForCategory',compact('products','category','categories'));
    }
}
