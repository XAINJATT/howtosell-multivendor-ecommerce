<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController; // Adjust the namespace for FrontendController

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

// Authentication
Route::get('/register', function () {
    return redirect(url('/login'));
});
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

        // Category
        Route::get('category', '\App\Http\Controllers\Admin\CategoryController@index')->name('category');
        Route::get('category/add', '\App\Http\Controllers\Admin\CategoryController@add')->name('category.add');
        Route::post('category/store', '\App\Http\Controllers\Admin\CategoryController@store')->name('category.store');
        Route::post('category/load', '\App\Http\Controllers\Admin\CategoryController@load')->name('category.all');
        Route::get('category/edit/{id}', '\App\Http\Controllers\Admin\CategoryController@edit')->name('category.edit');
        Route::post('category/update', '\App\Http\Controllers\Admin\CategoryController@update')->name('category.update');
        Route::post('category/delete', '\App\Http\Controllers\Admin\CategoryController@delete')->name('category.delete');
        Route::post('city/CheckForDuplicateCategory', '\App\Http\Controllers\Admin\CityController@CheckForDuplicateCategory')->name('category.CheckForDuplicateCategory');

        // Edit Profile
        Route::get('edit-profile', '\App\Http\Controllers\UserController@EditProfile');
        Route::post('update-personal-details', '\App\Http\Controllers\UserController@UpdatePersonalDetails');
        Route::post('update-account-security', '\App\Http\Controllers\UserController@UpdateAccountSecurity');
    });
});
