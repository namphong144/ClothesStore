<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductDetailController;
use App\Http\Controllers\Admin\ProductCategoryController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//=========================ADMIN========================
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::resource('/user', UserController::class);

    Route::resource('/category', ProductCategoryController::class);

    Route::resource('/brand', BrandController::class);

    Route::resource('/size', SizeController::class);

    Route::resource('/color', ColorController::class);

    Route::resource('/product', ProductController::class);
    Route::get('product-image/{product_image_id}/delete', [ProductController::class, 'destroyImage']);

    //image product
    Route::resource('/product/{product_id}/image', ProductImageController::class);

});

//=========================CLIENT========================
//home
Route::get('/', [ClientController::class, 'home'])->name('homepage');

//shop
Route::get('/shop', [ClientController::class, 'shop'])->name('shop');
Route::get('/shop/{slug}', [ClientController::class, 'category'])->name('danh-muc');

//product
Route::get('/shop/san-pham/{slug}', [ClientController::class, 'product'])->name('san-pham');

//coupon
Route::post('/check-coupon',[CartController::class, 'check_coupon']);

//cart
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax'])->name('add-to-cart');
Route::get('/cart', [CartController::class, 'show_cart'])->name('show-cart');
Route::post('/update-cart',[CartController::class, 'update_cart'])->name('update-cart');
Route::get('/delete-product/{session_id}', [CartController::class,'delete_product']);
Route::get('/delete-all-product',[CartController::class, 'delete_all_product']);
Route::get('/show-cart',[CartController::class,'show_cart_header']);
Route::get('/hover-cart',[CartController::class,'hover_cart']);

//checkout
Route::get('/checkout',[CheckoutController::class,'show_checkout']);
Route::post('/confirm-order',[CheckoutController::class,'confirm_order']);

//search
Route::get('/tim-kiem', [ClientController::class, 'timkiem'])->name('tim-kiem');

//blog
Route::get('/blogs', [ClientController::class, 'blog'])->name('blogs');
Route::get('/blogs/{slug}', [ClientController::class, 'blog_detail'])->name('blog-detail');

//contact
Route::get('/contact', [ClientController::class, 'contact'])->name('contact');



//-----------auth-----------
Route::get('/home', [HomeController::class, 'index'])->name('home');
Auth::routes();
