<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetail($id){
        $product = Product::with(['ProductColors.Color', 'ProductSizes.Size', 'ProductImages'])->where('id', $id)->first();


        return view('frontend.product_detail',compact('product'));
    }
    public function allProducts(){
        $category = \request('category_id');
        if ($category) {
            $products = Product::with(['ProductColors.Color', 'ProductSizes.Size', 'ProductImages'])
                ->where('category_id', $category)->get();
        }else{
            $products = Product::with(['ProductColors', 'ProductSizes', 'ProductImages'])->get();
        }

        return view('frontend.all_products',compact('products'));
    }
}
