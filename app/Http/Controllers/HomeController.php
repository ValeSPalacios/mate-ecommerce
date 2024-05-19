<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!auth()->check() || (auth()->check() && auth()->user()->roles[0]->id==2)){
            $products=Product::orderBy('cost_price')->limit(3)->get();
            //dd($products);
            $categories=Category::all();
            //dd($categories);
            return view('welcome',compact('categories', 'products'));
        }else if(auth()->check() && auth()->user()->roles[0]->id==1){
            return redirect()->route('admin.index');
        }
    }
}
