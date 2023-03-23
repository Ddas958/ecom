<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

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
});

Route::match(['get','post'],'/admin',[AdminController::class, 'login'])->name('admin');
Auth::routes();

Route::group(['middleware'=>['auth']],function(){
    Route::get('/admin/dashboard/',[AdminController::class, 'dashboard']);
    Route::get('/admin/settings/',[AdminController::class, 'settings']);
});
Route::get('/logout',[AdminController::class, 'logout']);


Route::get('/home', [HomeController::class, 'index'])->name('home');
