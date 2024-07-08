<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use Illuminate\Auth\AuthManager as AuthAuthManager;

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
})->name('home');

Route::get('/login', [AuthManager::class,'login'])->name('login');
Route::post('/login', [AuthManager::class,'loginpost'])->name('login.post');
Route::get('/register',  [AuthManager::class,'register'])->name('register');
Route::post('/register',  [AuthManager::class,'registerpost'])->name('register.post');
Route::get('/logout',[AuthAuthManager::class,'logout'])->name('logout');
Route::group(['middleware'=>'auth'],function(){
    Route::get('/profile',function(){
        return "Hi";
});

});