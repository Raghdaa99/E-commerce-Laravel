<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\FrontSiteController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\dashboard;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ComplaintController;

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

//Route::get('/', function () {
//    return view('frontsite.index');
//});
Route::get('/', [FrontSiteController::class, 'showHome'])->name('frontsite.home');
Route::get('/shop/{id}', [FrontSiteController::class, 'showShop'])->name('frontsite.shop');
Route::post('filter/{id}', [FrontSiteController::class, 'filter'])->name('product.filter');
Route::get('/cart', [FrontSiteController::class, 'showCart'])->name('frontsite.cart');
Route::get('/details/{id}', [FrontSiteController::class, 'showDetails'])->name('frontsite.details');
Route::get('/checkout', [FrontSiteController::class, 'checkout'])->name('frontsite.checkout');
Route::get('/checkout1', [CheckoutController::class, 'checkout1'])->name('checkout')->middleware('auth');
Route::post('/checkout-one', [CheckoutController::class, 'checkout1store'])->name('checkout.store');
Route::post('/checkout-two', [CheckoutController::class, 'checkout2store'])->name('checkout2.store');
Route::post('/checkout-three', [CheckoutController::class, 'checkout3store'])->name('checkout3.store');
Route::get('/checkout-order', [CheckoutController::class, 'checkoutOrder'])->name('checkout.order');
Route::post('/carts/{id}/store', [dashboard\CartController::class, 'store']);
Route::post('/carts/{id}/singleAddToCart', [dashboard\CartController::class, 'singleAddToCart']);
Route::post('/search', [FrontSiteController::class, 'search'])->name('frontsite.search');
Route::post('/cart/update', [dashboard\CartController::class, 'update'])->name('cart.update');
Route::prefix('admin')->middleware('is_admin')->group(function () {
    Route::get('/', [dashboard\DashboardController::class, 'index'])->name('admin.home');
    Route::resource('category', dashboard\CategoryController::class);
    Route::resource('post', dashboard\PostController::class);
    Route::resource('products', dashboard\ProductController::class);
    Route::resource('order', dashboard\OrderController::class);
    Route::resource('invoice', dashboard\InvoiceController::class);

    Route::resource('roles', RoleController::class);

    Route::resource('permissions', PermissionController::class);
    Route::resource('complaints', ComplaintController::class);
    Route::resource('files', \App\Http\Controllers\FileController::class);

});



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {

    Route::resource('users', UserController::class);
//    Route::resource('products', ProductController::class);

});

Route::get('/pay', function () {
    return view('paywithpaypal');
});
//Route::get('/paywithpaypal', array('as' => 'paywithpaypal','uses' => 'PaypalController@payWithPaypal'));
//Route::post('/paypal', array('as' => 'paypal','uses' => 'PaypalController@postPaymentWithpaypal'));
//Route::get('/paypal', array('as' => 'status','uses' => 'PaypalController@getPaymentStatus'));

//
//// route for processing payment
//Route::post('/paypal', [App\Http\Controllers\PaypalController::class, 'index'])->name('paypal');
//
//// route for check status of the payment
//Route::get('/status', [App\Http\Controllers\PaypalController::class, 'getPaymentStatus'])->name('status');
//Route::get('/paywithpaypal', [App\Http\Controllers\PaypalController::class, 'payWithPaypal'])->name('paywithpaypal');

//
//Route::post('/paypal',[\App\Http\Controllers\PaypalController::class,'index'])->name('paypal_call');
//Route::get('/paypal/return',[\App\Http\Controllers\PaypalController::class,'paypalReturn'])->name('paypal_return');
//Route::get('/paypal/cancel',[\App\Http\Controllers\PaypalController::class,'paypalCancel'])->name('paypal_cancel');

//
//Route::get('handle-payment', [\App\Http\Controllers\PayPalPaymentController::class,'handlePayment'])->name('make.payment');
Route::get('cancel-payment', [\App\Http\Controllers\CheckoutController::class, 'paymentCancel'])->name('cancel.payment');
Route::get('payment-success', [\App\Http\Controllers\CheckoutController::class, 'paymentSuccess'])->name('success.payment');
