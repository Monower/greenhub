<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\AddUser;
use App\Http\Controllers\UserLogin;

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
    return view('index');
})->name('login');

Route::get('signup', function () {
    return view('pages.signup');
});

Route::post('signup',[AddUser::class,'add']);

Route::get('profile',function(){
    return view('pages.profile');
})->middleware('auth');

Route::post('login',[UserLogin::class,'login']);
