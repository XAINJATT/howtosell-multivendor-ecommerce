<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetail($id){
        $product = Product::with(['ProductColors', 'ProductSizes', 'ProductImages'])->where('id', $id)->first();
        return view('frontend/room-detail',compact('product'));
    }
}
