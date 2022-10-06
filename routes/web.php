<?php

use Illuminate\Support\Facades\Route;

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

Route::post('login', [App\Http\Controllers\Auth\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\Auth\AuthController::class, 'register']);
Route::get('/login-with-remote-provider', [App\Http\Controllers\Auth\AuthController::class, 'loginWithProvider'])
    ->name('login_with_remote_provider');
Route::get('/callback', [App\Http\Controllers\Auth\AuthController::class, 'providerCallback']);

Route::post('/tokens/create', [App\Http\Controllers\Auth\AuthController::class, 'createToken']);

Route::get('auth-check', [App\Http\Controllers\Auth\AuthController::class, 'authCheck']);

Route::get('/{any?}', static function (){
    return view('layouts.app');
})->where('eny','.*');
