<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\OrderController;
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
    Route::get('/level-choose', [UserController::class, 'level_choose'])->name('level-choose');

    Route::resource('/category', ProductCategoryController::class);

    Route::resource('/brand', BrandController::class);

    Route::resource('/size', SizeController::class);

    Route::resource('/color', ColorController::class);

    Route::resource('/product', ProductController::class);
    Route::get('product-image/{product_image_id}/delete', [ProductController::class, 'destroyImage']);
    Route::get('/product-status-choose', [ProductController::class, 'status_choose'])->name('product-status-choose');
    Route::post('/product-size/{prod_size_id}', [ProductController::class, 'updateQtySize']);
    Route::get('/product-size/{prod_size_id}/delete', [ProductController::class, 'deleteQtySize']);

    //image product
    Route::resource('/product/{product_id}/image', ProductImageController::class);

     //blog
     Route::resource('/blog', BlogController::class);

      //order
      Route::resource('/order', OrderController::class);
      //Route::get('/order-choxn', [OrderController::class, 'order_choxn'])->name('order-choxn');
      Route::get('/status-choose', [OrderController::class, 'orderstatus_choose'])->name('orderst-choose');

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
Route::post('/add-cart', [CartController::class, 'add_cart'])->name('add-cart');
Route::get('/list-cart', [CartController::class, 'list_cart'])->name('list-cart');
Route::post('/update-cart', [CartController::class, 'update_cart'])->name('update-cart');
Route::delete('/delete-cart', [CartController::class, 'delete_cart'])->name('delete-cart');
Route::post('/clear-all-cart', [CartController::class, 'clear_all_cart'])->name('clear-all-cart');

//checkout
 Route::get('/check-out', [CheckoutController::class, 'checkout'])->name('check-out');
 Route::post('/check-out-process', [CheckoutController::class, 'checkout_process'])->name('check-out-process');

 //history purchase
 Route::get('/history-purchase', [CheckoutController::class, 'history_purchase'])->name('history-purchase');
 Route::get('/history-detail/{id}', [CheckoutController::class, 'history_detail'])->name('history-detail');
 Route::put('/client-huy/{id}', [CheckoutController::class, 'client_huy'])->name('client-huy');
 Route::put('/client-nhan-hang/{id}', [CheckoutController::class, 'client_nhan_hang'])->name('client-nhan-hang');

 //rating
 Route::get('/danh-gia/{id}', [CheckoutController::class, 'danh_gia'])->name('danh-gia');
 Route::post('/add-rating/{id}', [CheckoutController::class, 'add_rating'])->name('add-rating');

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