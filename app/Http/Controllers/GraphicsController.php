<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class GraphicsController extends Controller
{
    public function index(){
       
        return view('admin.graphics.list');
    }
    /**
     * Permite obtener los 10 productos más caros
     */
    public function getTopFiveProducts(){
        $products=Product::orderBy('cost_price','desc')->limit(5)->get();
      
        $result=[];
        $labels=[];
        foreach($products as $product){
            array_push($labels,$product->name);
            array_push($result,intval($product->cost_price));
        }
        return json_encode(['status'=>200,'data'=>$result,'labels'=>$labels]);
        //dd($formatedData);
       
        //dd($formatedData);
    }

    /**
     * Obtengo la cantidad de productos para cada categoria
     */
    public function getCategoryCount(){
        $products = Product::select(
            'categories.name', 
            DB::raw('COUNT(*) as total_category')
          )
          ->join('categories', 'products.category_id', '=', 'categories.id')
          ->groupBy('categories.name')
          ->get();
         
       
        //$products=Product::with('category')->get();
        //dd(Product::with('category')->get());
        $result=[];
        $labels=[];
        foreach($products as $product){
            array_push($labels,$product->name);
            array_push($result,$product->total_category);
        }
        return json_encode(['status'=>200,'data'=>$result,'labels'=>$labels]);
    }

    /**
     * Obtiene los cinco productos con stock más bajo
     */
    public function getStock(){
        $products=Product::orderBy('stock','asc')->limit(5)->get();
      
        $result=[];
        $labels=[];
        foreach($products as $product){
            array_push($labels,$product->name);
            array_push($result,intval($product->stock));
        }
        return json_encode(['status'=>200,'data'=>$result,'labels'=>$labels]);
    }
}
