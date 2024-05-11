<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@index')->name('index');

Route::get('/password/resetCustom/{token}', 'Auth\ForgotPasswordController@passwordReset')
->name('passwordReset');
Auth::routes();
Route::post('/password/reset', 'Auth\ForgotPasswordController@passwordUpdate')
->name('password.update');
Route::get('showForCategory/{id_category}','ProductController@showToClient')->name('showProduct');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([
    'middleware'    =>  ['auth'],
    'prefix'        =>  'userClient'
],function(){
   
    Route::get('show','UserDataController@index')->name('userClient.index');
    Route::put('update','UserDataController@update')->name('userClient.update');
    Route::post('addCart','CartController@store')->name('cart.store');
    Route::get('indexCart','CartController@index')->name('cart.index');
    Route::post('cartStore','CartController@store')->name('cart.store');
    Route::put('{detail}/addToCart','CartController@update')->name('cart.update');

});


Route::group([
    'middleware'    =>  ['auth'],
    'prefix'        =>  'admin'
],function(){
   
    /**
     * Rutas para que el administrador gestione los datos de los usuarios.
     */
    Route::get('userList','UserAdminController@index')->name('admin.index');
    Route::get('createUser','UserAdminController@create')->name('admin.user.create');
    Route::get('{user}/edit','UserAdminController@edit')->name('admin.user.edit');
    Route::post('store','UserAdminController@store')->name('admin.user.store');
    Route::post('search','UserAdminController@searchUser')->name('admin.user.search');
    Route::get('userDestroy/{user?}','UserAdminController@destroy')->name('admin.user.destroy');
    Route::put('{user}/update', 'UserAdminController@update')->name('admin.user.update');
    Route::get('show','UserAdminController@show')->name('admin.user.show');

    /**
     * Rutas para que el administrador gestione los proveedores
     */
    Route::get('createProvider','AdminController@index')->name('admin.provider.create');
    Route::get('providerList','AdminController@index')->name('admin.provider.index');
    //Route::put('{provider}/destroy','AdminController@index')->name('admin.provider.index');

    /**
     * Rutas para que el administrador gestione los productos
     */
    Route::get('createProduct','AdminController@index')->name('admin.product.create');
    Route::get('productList','AdminController@index')->name('admin.product.index');

    /**
     * Rutas para que el administrador gestione las adquisiciones
     */
    Route::get('purchaseCreate','AdminController@index')->name('admin.purchase.create');
    Route::get('purchaseList','AdminController@index')->name('admin.purchase.index');
    
    
    

});
