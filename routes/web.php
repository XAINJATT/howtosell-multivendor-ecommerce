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

        // City
        Route::get('city', '\App\Http\Controllers\Admin\CityController@index')->name('city');
        Route::get('city/add', '\App\Http\Controllers\Admin\CityController@add')->name('city.add');
        Route::post('city/store', '\App\Http\Controllers\Admin\CityController@store')->name('city.store');
        Route::post('city/load', '\App\Http\Controllers\Admin\CityController@load')->name('city.all');
        Route::get('city/edit/{id}', '\App\Http\Controllers\Admin\CityController@edit')->name('city.edit');
        Route::post('city/update', '\App\Http\Controllers\Admin\CityController@update')->name('city.update');
        Route::post('city/delete', '\App\Http\Controllers\Admin\CityController@delete')->name('city.delete');
        Route::post('city/getDriver', '\App\Http\Controllers\Admin\CityController@getDriver')->name('city.getDriver');
        Route::post('city/CheckForDuplicateCity', '\App\Http\Controllers\Admin\CityController@CheckForDuplicateCity')->name('city.CheckForDuplicateCity');

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
