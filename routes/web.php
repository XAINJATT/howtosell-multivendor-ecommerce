<?php

use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\FavoriteProductController;
use App\Http\Controllers\frontend\ProductController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController; // Adjust the namespace for FrontendController
use App\Http\Controllers\Auth\RegisterController;

//Command Routes
Route::get('clear-cache', function () {
    Artisan::call('storage:link');
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    //Create storage link on hosting
    $exitCode = Artisan::call('storage:link', []);
    echo $exitCode;
});

//Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/', [FrontendController::class, 'index']);
Route::post('change-locale', [FrontendController::class,'changeLocale'])->name('changeLocale');

// Use named routes for clarity
Route::get('/admin/login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('admin.login');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Authentication
// Route::get('/register', function () {
//     return redirect(url('/login'));
// });
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['prefix' => 'admin'], function(){

    Route::middleware(['auth'])->group(function () {
        /* Admin Routes */
        Route::group(['middleware' => 'admin.guest'],function(){
            Route::get('/', function () {
                return redirect(url('/login'));
            });
        });

        // Dashboard
        Route::get('dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('adminDashboard');
        Route::get('changePassword', 'App\Http\Controllers\Admin\DashboardController@changePassword')->name('changePassword');
        Route::post('updatePassword', 'App\Http\Controllers\Admin\DashboardController@updatePassword')->name('updatePassword');

        // Role
        Route::get('role', '\App\Http\Controllers\Admin\RoleController@index')->name('role');
        Route::get('role/add', '\App\Http\Controllers\Admin\RoleController@add')->name('role.add');
        Route::post('role/store', '\App\Http\Controllers\Admin\RoleController@store')->name('role.store');
        Route::post('role/load', '\App\Http\Controllers\Admin\RoleController@load')->name('role.all');
        Route::get('role/edit/{id}', '\App\Http\Controllers\Admin\RoleController@edit')->name('role.edit');
        Route::post('role/update', '\App\Http\Controllers\Admin\RoleController@update')->name('role.update');
        Route::post('role/delete', '\App\Http\Controllers\Admin\RoleController@delete')->name('role.delete');

        // Permission
        Route::get('permission', '\App\Http\Controllers\Admin\PermissionController@index')->name('permission');
        Route::get('permission/add', '\App\Http\Controllers\Admin\PermissionController@add')->name('permission.add');
        Route::post('permission/store', '\App\Http\Controllers\Admin\PermissionController@store')->name('permission.store');
        Route::post('permission/load', '\App\Http\Controllers\Admin\PermissionController@load')->name('permission.all');
        Route::get('permission/edit/{id}', '\App\Http\Controllers\Admin\PermissionController@edit')->name('permission.edit');
        Route::post('permission/update', '\App\Http\Controllers\Admin\PermissionController@update')->name('permission.update');
        Route::post('permission/delete', '\App\Http\Controllers\Admin\PermissionController@delete')->name('permission.delete');

        // Color
        Route::get('color', '\App\Http\Controllers\Admin\ColorController@index')->name('color');
        Route::get('color/add', '\App\Http\Controllers\Admin\ColorController@add')->name('color.add');
        Route::post('color/store', '\App\Http\Controllers\Admin\ColorController@store')->name('color.store');
        Route::post('color/load', '\App\Http\Controllers\Admin\ColorController@load')->name('color.all');
        Route::get('color/edit/{id}', '\App\Http\Controllers\Admin\ColorController@edit')->name('color.edit');
        Route::post('color/update', '\App\Http\Controllers\Admin\ColorController@update')->name('color.update');
        Route::post('color/delete', '\App\Http\Controllers\Admin\ColorController@delete')->name('color.delete');

        // Size
        Route::get('size', '\App\Http\Controllers\Admin\SizeController@index')->name('size');
        Route::get('size/add', '\App\Http\Controllers\Admin\SizeController@add')->name('size.add');
        Route::post('size/store', '\App\Http\Controllers\Admin\SizeController@store')->name('size.store');
        Route::post('size/load', '\App\Http\Controllers\Admin\SizeController@load')->name('size.all');
        Route::get('size/edit/{id}', '\App\Http\Controllers\Admin\SizeController@edit')->name('size.edit');
        Route::post('size/update', '\App\Http\Controllers\Admin\SizeController@update')->name('size.update');
        Route::post('size/delete', '\App\Http\Controllers\Admin\SizeController@delete')->name('size.delete');

        // Product
        Route::get('product', '\App\Http\Controllers\Admin\ProductController@index')->name('product');
        Route::get('product/add', '\App\Http\Controllers\Admin\ProductController@add')->name('product.add');
        Route::post('product/store', '\App\Http\Controllers\Admin\ProductController@store')->name('product.store');
        Route::post('product/load', '\App\Http\Controllers\Admin\ProductController@load')->name('product.all');
        Route::get('product/edit/{id}', '\App\Http\Controllers\Admin\ProductController@edit')->name('product.edit');
        Route::post('product/update', '\App\Http\Controllers\Admin\ProductController@update')->name('product.update');
        Route::post('product/delete', '\App\Http\Controllers\Admin\ProductController@delete')->name('product.delete');

        // Category
        Route::get('category', '\App\Http\Controllers\Admin\CategoryController@index')->name('category');
        Route::get('category/add', '\App\Http\Controllers\Admin\CategoryController@add')->name('category.add');
        Route::post('category/store', '\App\Http\Controllers\Admin\CategoryController@store')->name('category.store');
        Route::post('category/load', '\App\Http\Controllers\Admin\CategoryController@load')->name('category.all');
        Route::get('category/edit/{id}', '\App\Http\Controllers\Admin\CategoryController@edit')->name('category.edit');
        Route::post('category/update', '\App\Http\Controllers\Admin\CategoryController@update')->name('category.update');
        Route::post('category/delete', '\App\Http\Controllers\Admin\CategoryController@delete')->name('category.delete');
        Route::post('city/CheckForDuplicateCategory', '\App\Http\Controllers\Admin\CityController@CheckForDuplicateCategory')->name('category.CheckForDuplicateCategory');

        // Coupon
        Route::get('coupon', '\App\Http\Controllers\Admin\CouponController@index')->name('coupon');
        Route::get('coupon/add', '\App\Http\Controllers\Admin\CouponController@add')->name('coupon.add');
        Route::post('coupon/store', '\App\Http\Controllers\Admin\CouponController@store')->name('coupon.store');
        Route::post('coupon/load', '\App\Http\Controllers\Admin\CouponController@load')->name('coupon.all');
        Route::get('coupon/edit/{id}', '\App\Http\Controllers\Admin\CouponController@edit')->name('coupon.edit');
        Route::post('coupon/update', '\App\Http\Controllers\Admin\CouponController@update')->name('coupon.update');
        Route::post('coupon/delete', '\App\Http\Controllers\Admin\CouponController@delete')->name('coupon.delete');

        // Stock
        Route::get('stock', '\App\Http\Controllers\Admin\StockController@index')->name('stock');
        Route::post('stock/store', '\App\Http\Controllers\Admin\StockController@store')->name('stock.store');
        Route::post('stock/load', '\App\Http\Controllers\Admin\StockController@load')->name('stock.all');

        // Order
        Route::get('order', '\App\Http\Controllers\Admin\OrderController@index')->name('order');
        Route::post('order/store', '\App\Http\Controllers\Admin\OrderController@store')->name('order.store');
        Route::post('order/load', '\App\Http\Controllers\Admin\OrderController@load')->name('order.all');

        // Edit Profile
        Route::get('edit-profile', '\App\Http\Controllers\UserController@EditProfile');
        Route::post('update-personal-details', '\App\Http\Controllers\UserController@UpdatePersonalDetails');
        Route::post('update-account-security', '\App\Http\Controllers\UserController@UpdateAccountSecurity');


        Route::post('withdrawal-funds', [OrderController::class, 'WithdrawalFunds'])->name('admin.WithdrawalFunds');
    });
});
//fontend
Route::get('product-detail/{id}', [ProductController::class,'productDetail'])->name('productDetail');
Route::get('products', [ProductController::class,'allProducts'])->name('products');
Route::get('filter-products', [ProductController::class, 'filterProducts'])->name('frontend.filter-products');
Route::get('cart', [AddToCartController::class,'index']);
Route::post('add-to-cart', [AddToCartController::class,'AddToCart']);
Route::post('update-cart', [AddToCartController::class,'updateCart']);
Route::post('apply-coupon', [AddToCartController::class,'applyCoupon']);
Route::post('remove-product', [AddToCartController::class,'cart_remove']);
Route::post('favorite-product', [FavoriteProductController::class,'FavoriteProduct']);
Route::post('review/create', 'App\Http\Controllers\Frontend\ReviewController@create')->name('review.create');

//Route::middleware(['auth'])->group(function () {
    Route::get('checkout', [OrderController::class,'checkout']);
    Route::post('save-order-details', [OrderController::class,'saveOrderDetails']);
    Route::post('stripe', [OrderController::class,'stripe']);
    Route::post('stripe', [OrderController::class,'stripePost'])->name('stripe.post');

//});

