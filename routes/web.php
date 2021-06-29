<?php

use App\Http\Controllers\BasketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Support\Storage\Contracts\StorageInterface;

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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);

Route::get('basket/add/{product}', [BasketController::class,'add'])->name('basket.add');
Route::get('basket', [BasketController::class,'index'])->name('basket.index');
Route::get('basket/clear', function(){
    resolve(StorageInterface::class)->clear();
});






