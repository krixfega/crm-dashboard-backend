<?php
use App\Http\Controllers\admin\AdminPagesController;
use App\Http\Controllers\admin\customers\CustomersController;
use App\Http\Controllers\admin\staff\StaffController;
use App\Http\Controllers\admin\tailor\TailorController;
use App\Http\Controllers\admin\product\ProductController;
use App\Http\Controllers\admin\shop\shopController;
use App\Http\Controllers\admin\account\accountController;
use App\Http\Controllers\admin\shop\bookingController;
use App\Http\Controllers\admin\shop\fibricsController;
use App\Http\Controllers\admin\product\ProductCategoryController;
use App\Http\Controllers\user\UserPagesController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\product\UserProductController;
use App\Http\Controllers\user\product\UserShopController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//normal routes
Route::get('/', [UserPagesController::class, 'index'])->name('home');
Route::get('/product/{id}',[UserPagesController::class, 'singleProduct'])->name('product.show');
Route::get('/shoplist',[UserShopController::class, 'index'])->name('user.shop.index');
Route::get('/shoplist/filter', [UserShopController::class, 'filter'])->name('user.shop.filter');
Route::get('/shoplist/category/{id}', [UserShopController::class, 'category'])->name('user.shop.category');





// authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/cart',[CartController::class, 'create'])->name('cart.create');
    Route::get('/cart',[CartController::class, 'show'])->name('cart.show');
    Route::put('/cart',[CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart',[CartController::class, 'delete'])->name('cart.delete');
    Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');



});




// admin routes
Route::middleware(['auth', 'isAdmin'])->group(function () {



    Route::get('/admin', [AdminPagesController::class, 'index']);
    Route::get('/admin/profile', [AdminPagesController::class, 'profile'])->name('admin.profile');
    Route::put('/admin/profile/{id}', [AdminPagesController::class, 'updateProfile'])->name('admin.updateProfile');
        Route::resource('/admin/customers',CustomersController::class);
        Route::resource('/admin/staffs',StaffController::class);
    Route::resource('/admin/products',ProductController::class);
    Route::resource('/admin/productsCategory',ProductCategoryController::class);
    Route::resource('/admin/shop',shopController::class);
    Route::get('/admin/orders',[shopController::class,'orders'])->name('orders.index');
    Route::get('/admin/orders/history',[shopController::class,'history'])->name('orders.history');
    Route::put('/admin/orders/status/{id}',[shopController::class,'updateStatus'])->name('orders.update.status');
    Route::get('/admin/orders/view/{id}',[shopController::class,'show'])->name('orders.view');
    Route::delete('/admin/orders/{id}',[shopController::class,'delete'])->name('orders.delete');
    Route::get('/admin/orders/invoice/{id}',[shopController::class,'invoice'])->name('orders.invoice');

    Route::resource('/admin/booking',bookingController::class);
    Route::get('/admin/bookings/history',[bookingController::class,'history'])->name('booking.history');
    Route::get('/admin/bookings/invoice/{id}',[bookingController::class,'invoice'])->name('booking.invoice');

    Route::resource('/admin/fibrics',fibricsController::class);
    Route::post('/admin/shop/add_to_cart/{id}', [shopController::class, 'addToCart'])->name('shop.addToCart');
    Route::patch('/admin/shop/update-cart', [shopController::class, 'updateCart'])->name('shop.updateCart');
    Route::delete('/admin/shop/delete-cart', [shopController::class, 'deleteCart'])->name('shop.deleteCart');
    Route::get('/admin/sell', [shopController::class, 'sell'])->name('shop.sell');
    //account
    Route::get('/admin/account', [accountController::class, 'shop'])->name('account.index');
    Route::resource('/admin/tailor',TailorController::class);






  });






































































































































































