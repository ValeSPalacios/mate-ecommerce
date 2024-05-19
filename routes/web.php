<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminRoleMiddleware;
use App\Http\Middleware\GuestRoleMiddleware;
use App\Http\Middleware\ClientUserRoleMiddleware;
use App\Http\Middleware\GuestAndClientRoleMiddleware;
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

/**
 * Las rutas para ir a las páginas de inicio de cada rol.
 * Uso ambas porque algunas acciones, como las de logueo, redireccionan a
 * http://127.0.0.1:8000/ y para no cambiarla, utilizo ambas
 */
Route::get('/home','HomeController@index')->name('index');
Route::get('/','HomeController@index')->name('index');

//El reseteo de contraseña sólo se permitirá al usuario que no inició sesión
Route::get('/password/resetCustom/{token}', 'Auth\ForgotPasswordController@passwordReset')
->middleware(GuestRoleMiddleware::class)
->name('passwordReset');
Auth::routes();

//Lo mismo para realizar la actualización del password. Sólo al que no inició sesión
Route::post('/password/reset', 'Auth\ForgotPasswordController@passwordUpdate')
->middleware(GuestRoleMiddleware::class)
->name('password.update');

//Sólo el visitante y el cliente pueden ver los productos para agregar al carrito
//El administrador no.
Route::get('showForCategory/{id_category}','ProductController@showToClient')
 ->middleware(GuestAndClientRoleMiddleware::class)
->name('showProduct');

//Aquí sólo acceden los clientes
Route::group([
    'middleware'    =>  ['auth',ClientUserRoleMiddleware::class],
    'prefix'        =>  'userClient'
],function(){
   
    Route::get('show','UserDataController@index')->name('userClient.index');
    Route::put('update','UserDataController@update')->name('userClient.update');
    Route::post('store','UserDataController@store')->name('userClient.store');
    Route::post('addCart','CartController@store')->name('cart.store');
    Route::get('indexCart','CartController@index')->name('cart.index');
    Route::post('cartStore','CartController@store')->name('cart.store');
    Route::put('{detail}/addToCart','CartController@update')->name('cart.update');

});

//Aquí sólo acceden los administradores
Route::group([
    'middleware'    =>  ['auth',AdminRoleMiddleware::class],
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
    Route::get('getUser/{userId?}','UserAdminController@getUserById')->name('admin.user.getUser');

    /**
     * Rutas para que el administrador gestione los proveedores
     */
    Route::get('createProvider','ProviderController@create')->name('admin.provider.create');
    Route::get('providerList','ProviderController@index')->name('admin.provider.index');
    Route::get('provider/{provider}/edit','ProviderController@edit')->name('admin.provider.edit');
    Route::get('getProvider/{providerId?}','ProviderController@getProviderById')->name('admin.provider.getProvider');
    Route::post('provider/store','ProviderController@store')->name('admin.provider.store');
    Route::post('provider/search','ProviderController@searchUser')->name('admin.provider.search');
    Route::get('providerDestroy/{idProvider?}','ProviderController@destroy')->name('admin.provider.destroy');
    Route::put('provider/{provider}/update', 'ProviderController@update')->name('admin.provider.update');

    //Route::put('{provider}/destroy','AdminController@index')->name('admin.provider.index');

    /**
     * Rutas para que el administrador gestione los productos
     */
    Route::get('create','ProductController@create')->name('admin.product.create');
    Route::get('productList','ProductController@index')->name('admin.product.index');
    Route::get('product/{product}/edit','ProductController@edit')->name('admin.product.edit');
    Route::post('product/store','ProductController@store')->name('admin.product.store');
    Route::post('product/search','ProductController@searchUser')->name('admin.prodcut.search');
    Route::get('productDestroy/{idProduct?}','ProductController@destroy')->name('admin.product.destroy');
    Route::put('product/{product}/update', 'ProductController@update')->name('admin.product.update');
    Route::get('getProduct','ProductController@getProductById')->name('admin.product.getProduct');

    /**
     * Rutas para que el administrador gestione las adquisiciones
     */
    Route::get('purchaseCreate','PurchaseProductController@create')->name('admin.purchase.create');
    Route::get('purchaseList','PurchaseProductController@index')->name('admin.purchase.index');
    Route::post('purchase/store','PurchaseProductController@store')->name('admin.purchase.store');
    Route::get('purchase/{product}/{provider}/edit','PurchaseProductController@edit')->name('admin.purchase.edit');
    Route::put('purchase//{product}/update','PurchaseProductController@update')->name('admin.purchase.update');

});
