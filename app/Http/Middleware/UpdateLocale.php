<?php

namespace App\Http\Middleware;

use App\Models\Language;
use App\Models\WebLanguageDetail;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class UpdateLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = config()->get('app.locale'); // Retrieve the default locale from the configuration

        if (Session::has('locale')) {
            $locale = Session::get('locale');
        }

        App::setLocale($locale);
        $lang = Language::where('slug',$locale)->first();
        $webDetail = WebLanguageDetail::where('language_id',$lang->id)->first();
        if (!$webDetail){
            $webDetail = WebLanguageDetail::where('language_id',1)->first();
        }
        Session::put('webDet',json_decode($webDetail->detail));
        return $next($request);
    }
}
