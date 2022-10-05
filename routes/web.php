<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
Route::get('/login-with-remote-provider', 'App\Http\Controllers\Auth\AuthController@loginWithProvider')
    ->name('login_with_remote_provider');
Route::get('/callback', 'App\Http\Controllers\Auth\AuthController@providerCallback');

Route::post('/tokens/create', static function (Request $request) {
    $token = $request->user()->createToken('wheather');
    return ['token' => $token->plainTextToken];
});

Route::get('auth-check', [App\Http\Controllers\Auth\AuthController::class, 'authCheck']);

Route::get('/{any?}', static function (){
    return view('layouts.app');
})->where('eny','.*');
