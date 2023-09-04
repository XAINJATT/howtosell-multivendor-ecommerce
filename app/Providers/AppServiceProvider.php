<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.inc.header',function ($view){
            $view->with(['all_categories'=>Category::all()]);
        });
        View::composer('frontend.inc.header',function ($view){
            $view->with(['languages'=>Language::where('status','active')->get()]);
        });
    }
}
