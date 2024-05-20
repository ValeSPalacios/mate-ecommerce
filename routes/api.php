<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('details/{idUser?}',[Api\CartController::class,'index'])->name('api.cart.index');
Route::put('details/update',[Api\CartController::class,'update'])->name('api.cart.update');
Route::delete('details/destroy',[Api\CartController::class,'destroy'])->name('api.cart.destroy');