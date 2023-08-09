<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use App\Models\WebLangDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use function Ramsey\Collection\Map\put;

class FrontendController extends Controller
{
    //

    public function index()
    {
        $categoryDetails = Category::all();

        $searchCategory = \request('category');
        $searchProduct = \request('search_product');
        $orderBy = null;
        if (\request()->price_filter) {
            $orderBy = \request()->price_filter;
            session()->put('price_filter', $orderBy);
        } else {
            if (session()->has('price_filter')) {
                $orderBy = session()->get('price_filter');
            }
        }
        $locale = Session::get('locale');
        if(!$locale){
            $locale = 'en';
        }
        $lang = Language::where('slug',$locale)->first();


        if ($searchCategory) {
            $categories = Category::where('parent_id', $searchCategory)->get();
            Session::put('categories', $categories);
            if ($orderBy == 'high_to_lower') {
                if ($searchProduct) {
                    $products = Product::with(['ProductFacilities', 'ProductFeatures', 'ProductOffers', 'ProductImages'])
                        ->where('category_id', $searchCategory)
                        ->where('language_id', $lang->id)
                        ->where('name', 'like', '%' . $searchProduct . '%')
                        ->orderBy('price', 'DESC')
                        ->get();
                } else {
                    $products = Product::with(['ProductFacilities', 'ProductFeatures', 'ProductOffers', 'ProductImages'])
                        ->where('category_id', $searchCategory)
                        ->where('language_id', $lang->id)
                        ->orderBy('price', 'DESC')
                        ->get();
                }
            } else {
                if ($searchProduct) {
                    $products = Product::with(['ProductFacilities', 'ProductFeatures', 'ProductOffers', 'ProductImages'])
                        ->where('category_id', $searchCategory)
                        ->where('language_id', $lang->id)
                        ->where('name', 'like', '%' . $searchProduct . '%')
                        ->orderBy('price', 'ASC')
                        ->get();
                } else {
                    $products = Product::with(['ProductFacilities', 'ProductFeatures', 'ProductOffers', 'ProductImages'])
                        ->where('category_id', $searchCategory)
                        ->where('language_id', $lang->id)
                        ->orderBy('price', 'ASC')
                        ->get();
                }
            }
        }
        else {
            $categories = Category::whereNull('parent_id')->get();
            Session::put('categories', $categories);
            if ($orderBy == 'high_to_lower') {
                if ($searchProduct) {
                    $products = Product::with(['ProductFacilities', 'ProductFeatures', 'ProductOffers', 'ProductImages'])
                        ->orderBy('price', 'DESC')
                        ->where('language_id', $lang->id)
                        ->where('name', 'like', '%' . $searchProduct . '%')
                        ->get();
                }else{
                    $products = Product::with(['ProductFacilities', 'ProductFeatures', 'ProductOffers', 'ProductImages'])
                        ->orderBy('price', 'DESC')
                        ->where('language_id', $lang->id)
                        ->get();
                }
            } else {
                if ($searchProduct) {
                    $products = Product::with(['ProductFacilities', 'ProductFeatures', 'ProductOffers', 'ProductImages'])
                        ->orderBy('price', 'ASC')
                        ->where('language_id', $lang->id)
                        ->where('name', 'like', '%' . $searchProduct . '%')
                        ->get();
                }else{
                    $products = Product::with(['ProductFacilities', 'ProductFeatures', 'ProductOffers', 'ProductImages'])
                        ->orderBy('price', 'ASC')
                        ->where('language_id', @$lang->id)
                        ->get();
                }
            }
        }

//        dd($products);
        return view('welcome', compact('products', 'categoryDetails'));
    }


    public function changeLocale(Request $request)
    {
        Session::put('locale', $request->lang);
        return back();
    }
}
