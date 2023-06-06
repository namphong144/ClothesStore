<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\ProductCategoryController;

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


//=========================CLIENT========================
Route::get('/', [ClientController::class, 'home'])->name('homepage');
Route::get('/shop', [ClientController::class, 'shop'])->name('shop');
Route::get('/shop/{slug}', [ClientController::class, 'category'])->name('danh-muc');
Route::get('/shop/san-pham/{slug}', [ClientController::class, 'product'])->name('san-pham');

 //search
 Route::get('/tim-kiem', [ClientController::class, 'timkiem'])->name('tim-kiem');

 //blog
 Route::get('/blogs', [ClientController::class, 'blog'])->name('blogs');
 Route::get('/blogs/{slug}', [ClientController::class, 'blog_detail'])->name('blog-detail');

  //contact
  Route::get('/contact', [ClientController::class, 'contact'])->name('contact');