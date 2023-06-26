<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[HomeController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

Route::get('/redirect',[HomeController::class,'redirect']);//->middleware('auth','verified')//

Route::get('/product_details/{id}',[HomeController::class,'product_details']);
Route::get('cash_order',[HomeController::class,'cash_order']);
Route::get('stripe/{totalprice}',[HomeController::class,'stripe']);
Route::get('stripe/{totalprice}',[HomeController::class,'stripePost'])->name('stripe.post');
Route::get('/product_search','App\http\controllers\HomeController@product_search')->name('product_search');
Route::get('/products',[HomeController::class,'products']);


Route::resource('/category',CategoryController::class);
Route::get('/searchproduct','App\http\controllers\Admin\ProductController@searchproduct')->name('searchproduct');
Route::resource('/product',ProductController::class);
// Route::resource('/cart',CartController::class);

Route::get('print_pdf/{id}','App\http\controllers\CartController@print_pdf')->name('print_pdf');
Route::resource('/cart',CartController::class)->except(['store']);

Route::get('search','App\http\controllers\Admin\OrderController@searchdata')->name('searchdata');
Route::get('delivered/{id}','App\http\controllers\Admin\OrderController@delivered')->name('delivered');
Route::resource('/order',OrderController::class);

Route::get('cart/store/{id}', 'App\Http\Controllers\CartController@store')->name('cart.store');




// Route::get('/view_category',[AdminController::class,'view_category']);
// Route::get('/add_category',[AdminController::class,'add_category']);
});