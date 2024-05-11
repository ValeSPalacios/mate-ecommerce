<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        //listo todos los usuarios, excepto al usuario logueado
        $users=User::with('userdata')->where('id','!=',auth()->user()->id)->get();
        return view('admin.user.list',compact('users'));
    }
}
