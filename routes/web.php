<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Fascade\Hash;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
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


Route::match(['get','post'],'/admin',[AdminController::class, 'login'])->name('admin');
Auth::routes();

Route::group(['middleware'=>['auth']],function(){
    Route::get('/admin/dashboard/',[AdminController::class, 'dashboard']);
    Route::get('/admin/settings/',[AdminController::class, 'settings']);
    Route::get('/admin/checkpwd/',[AdminController::class, 'checkPassword']);
    Route::match(['get','post'],'/admin/updatePwd/',[AdminController::class, 'updatePassword']);

    // admin category route lists
    Route::match(['get','post'],'/admin/add-category/',[CategoryController::class, 'addCategory']);
    Route::get('/admin/view-categories/',[CategoryController::class, 'viewCategories']);
    Route::match(['get','post'],'/admin/edit-category/{id}',[CategoryController::class, 'editCategory']);
    Route::match(['get','post'],'/admin/delete-category/{id}',[CategoryController::class, 'deleteCategory']);
     
    // admin category route lists
    Route::match(['get','post'],'/admin/add-product/',[ProductsController::class, 'addProduct']);
    Route::get('/admin/view-products/',[ProductsController::class, 'viewProducts']);
    Route::match(['get','post'],'/admin/edit-product/{id}',[ProductsController::class, 'editProduct']);
    Route::get('/admin/delete-product/{id}',[ProductsController::class, 'deleteProduct']);
    Route::get('/admin/delete-product-image/{id}',[ProductsController::class, 'deleteProductImage']);
    
    // admin product attribute routes
    Route::match(['get','post'],'/admin/add-attributes/{id}',[ProductsController::class, 'addAttributes']);
    Route::get('/admin/delete-attribute/{id}',[ProductsController::class, 'deleteAttribute']);
    Route::match(['get','post'],'/admin/add-images/{id}',[ProductsController::class, 'addImages']);
    Route::get('/admin/delete-product-images/{id}',[ProductsController::class, 'deleteProductImages']);
});

Route::get('/logout',[AdminController::class, 'logout']);


// frontend routes
Route::get('/', [IndexController::class, 'index'])->name('home');
// category listing page
Route::get('/products/{url}', [ProductsController::class, 'products'])->name('products');
Route::get('/product/{id}', [ProductsController::class, 'product'])->name('product');
Route::get('/getproductprice', [ProductsController::class, 'getProductPrice'])->name('product');