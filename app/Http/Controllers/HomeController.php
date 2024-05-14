<?php

namespace App\Http\Controllers;
use App\Models\Category;
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
            $categories=Category::all();
            //dd($categories);
            return view('welcome',compact('categories'));
        }else if(auth()->check() && auth()->user()->roles[0]->id==1){
            return redirect()->route('admin.index');
        }
    }
}
