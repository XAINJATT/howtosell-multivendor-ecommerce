<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetail($id){
        $product = Product::with(['ProductColors.Color', 'ProductSizes.Size', 'ProductImages'])->where('id', $id)->first();
        return view('frontend.product_detail',compact('product'));
    }
    public function allProducts(){
        $colors = Color::all();
        $sizes = Size::all();
        $category = \request('category_id');
        if ($category) {
            $products = Product::with(['ProductColors.Color', 'ProductSizes.Size', 'ProductImages'])
                ->where('category_id', $category)->get();
        }else{
            $products = Product::with(['ProductColors', 'ProductSizes', 'ProductImages'])->get();
        }

        return view('frontend.all_products',compact('products', 'colors', 'sizes'));
    }

    public function filterProducts(Request $request)
    {
        $colors = Color::withCount('products')->get();
        $sizes = Size::withCount('products')->get();
        $category = $request->input('category_id');
        $selectedColors = $request->input('color', []);
        $selectedSizes = $request->input('size', []);
        $selectedPriceRanges = $request->input('selected_price_ranges', []);

        $query = Product::with(['ProductColors.Color', 'ProductSizes.Size', 'ProductImages']);

        if ($category) {
            $query->where('category_id', $category);
        }

        if (!empty($selectedColors)) {
            $query->whereHas('ProductColors', function ($q) use ($selectedColors) {
                $q->whereIn('color_id', $selectedColors);
            });
        }

        if (!empty($selectedSizes)) {
            $query->whereHas('ProductSizes', function ($q) use ($selectedSizes) {
                $q->whereIn('size_id', $selectedSizes);
            });
        }
        
        if (!empty($selectedPriceRanges)) {
            $priceRanges = explode(',', $selectedPriceRanges);
            foreach ($priceRanges as $range) {
                [$minPrice, $maxPrice] = explode('-', $range);
                $query->orWhereBetween('price', [$minPrice, $maxPrice]);
            }
        }

        $products = $query->get();

        return view('frontend.all_products', compact('products', 'colors', 'sizes'));
    }    

}
