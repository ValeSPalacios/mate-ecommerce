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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/password/resetCustom/{token}', 'Auth\ForgotPasswordController@passwordReset')
->name('passwordReset');
Auth::routes();
Route::post('/password/reset', 'Auth\ForgotPasswordController@passwordUpdate')
->name('password.update');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([
    'middleware'    =>  ['auth'],
    'prefix'        =>  'userClient'
],function(){
   
    Route::get('show','UserDataController@index')->name('userClient.index');
    Route::put('update','UserDataController@update')->name('userClient.update');

});
