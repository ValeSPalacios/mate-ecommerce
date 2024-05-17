<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Helpers\Notification;
use App\Http\Requests\ProductRequest;
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
        return view('admin.product.list',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
       // dd($request);

        if ($request->file('product-img')) {
            $image = $request->file('product-img');
            $type = $image->getClientOriginalExtension();
            $img = date('Y-m-d-H-i-s') .  '.' . $type;
            $image->move('image/product/', $img);

            $product_image = 'image/product/' . $img;
        } else {
            $product_image = '/dist/img/user2-160x160.jpg';
        }

       /* $data = [
            'name'      =>$request->name,
            'description'       =>$request->description,
            'product_image'     =>$product_image,
            'cost_price'        =>$request->price,
            'increase'          =>$request->increase,
            'stock'             =>0,
            'enabled'           =>true,
            'user_created'      =>auth()->user()->id,
            'user_updated'      =>auth()->user()->id,
        ];*/
       // dd($request);
        $product = Product::create([
            'name'      =>trim($request->name),
            'description'       =>trim($request->description),
            'product_image'     =>trim($product_image),
            'cost_price'        =>$request->cost_price,
            'increase'          =>$request->increase,
            'stock'             =>$request->stocck,
            'enabled'           =>true,
            'category_id'       =>$request->category,
            'user_created'      =>auth()->user()->id,
            'user_updated'      =>auth()->user()->id,
        ]);
        if(!is_null($product)){
            
            $notification = Notification::Notification('Product Successfully Created', 'success');
            return redirect()->route('admin.product.index')->with('notification', $notification);
        }
        $notification = Notification::Notification('Error', 'error');
        return redirect()->route('admin.product.create')->with('notification', $notification);

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
    public function edit(Product $product)
    {
        $categories=Category::all();
       return view('admin.product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        //dd($product);
        $product->name=$request->name;
        $product->description=$request->description;
        $product->cost_price=$request->cost_price;
        $product->category_id=$request->category;
        $product->increase=$request->increase;
        $product->stock=$request->stock;
        $product->user_updated=auth()->user()->id;
        $product->save();
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        //dd($request);
        try {
            DB::beginTransaction();
            $product=Product::find($request->productId);
            if(!is_null($product)){
               
                    $product->delete();
                    
                    DB::commit();
                    return ['status' => 200];
                 
            };
            DB::rollBack();
            return ['status' => 400];
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['status' => 400];
        }
        
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

        /**
     * Permite recuperar los datos de un producto para el usuario
     * @param \Illuminate\Http\Request $request La petición con los datos necesarios para recuperar el producto
     * @return JSON Un archivo json con los datos del usuario
     */
    public function getProductById(Request $request){
      
        //dd($request);
        $product=Product::with('category')->where('id',$request->productId)->first();
        if(!Is_null($product)){
            $data=[
                'name'=>$product->name,
                'cost_price'=>$product->cost_price,
                'increase'=>$product->increase,
                'stock'=>$product->stock,
                'category'=>$product->category->name,
                'product_image'=>$product->product_image,
                'description'=>$product->description
            ];
        }else{
            return ['status'=>400,'msgError'=>'No se encuentra el producto solicitado'];
        }
            
        

        
        //dd($data);
        return ['status'=>200,'data'=>json_encode($data)];
      
    }
}
