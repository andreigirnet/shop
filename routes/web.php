<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ExlpodeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\SaveForLaterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Mail\OrderPlaced;
use TCG\Voyager\Facades\Voyager;


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
Route::get('/stripe',function(){
    return view('front.stripe');
});
Route::get('/', [LandingPageController::class,'index'])->name('home');

Route::get('/shop', [ShopController::class,'index'])->name('front.shop');
Route::get('/shop/{product}', [ShopController::class,'show'])->name('front.show');

Route::get('/cart', [CartController::class,'index'])->name('front.cart');
Route::post('/cart/{product}', [CartController::class,'store'])->name('cart.store');
Route::patch('/cart/{product}', [CartController::class,'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class,'destroy'])->name('cart.destroy');
Route::post('/cart/switchToSaveForLater/{product}', [CartController::class,'SwitchToSaveForLater'])->name('cart.switchToSaveForLater');

Route::delete('/saveForLater/{product}', [SaveForLaterController::class,'destroy'])->name('saveForLater.destroy');
Route::post('/saveForLater/switchToCart/{product}', [SaveForLaterController::class,'switchToCart'])->name('saveForLater.switchToCart');

Route::post('/coupon', [CouponController::class,'store'])->name('coupon.store');
Route::delete('/coupon', [CouponController::class,'destroy'])->name('coupon.destroy');

Route::get('/guestCheckout', [CheckoutController::class,'index'])->name('guestCheckout');
Route::get('/checkout', [CheckoutController::class,'index'])->name('checkout.index')->middleware('auth');
Route::post('/checkout', [CheckoutController::class,'store'])->name('checkout.store');

Route::get('/thankYou', [ConfirmationController::class,'index'])->name('confirmation.index');
Route::get('/search',[ShopController::class,'search'])->name('search');
Route::get('/search-alg',[ShopController::class,'searchAlgolia'])->name('search-algolia');
Route::get('/vue-search',[ShopController::class,'vueAlgolia'])->name('vue-algolia');
Route::middleware('auth')->group(function (){
    Route::get('/user-dashboard',[UsersController::class,'edit'])->name('dashboard');
    Route::patch('/user-dashboard',[UsersController::class,'update'])->name('user.update');
    Route::get('/my-orders',[OrdersController::class,'index'])->name('orders.index');
    Route::get('/my-orders/{order}',[OrdersController::class,'show'])->name('orders.show');
});

Route::get('/mailable', function(){
   $order = App\Models\Order::find(1);
   return new OrderPlaced($order);
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::get('/explode',[ExlpodeController::class,'explode']);
Auth::routes();


