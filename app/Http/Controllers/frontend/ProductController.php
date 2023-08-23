<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Helpers\SiteHelper;

class ProductController extends Controller
{
    public function productDetail($slug)
    {
        $product = Product::with(['ProductColors.Color', 'ProductSizes.Size', 'ProductImages'])->where('slug', $slug)->first();
        return view('frontend.product_detail',compact('product'));
    }

    public function allProducts(Request $request)
    {
        $query = $request->input('q');
        $colors = Color::all();
        $sizes = Size::all();
        $category = $request->input('category');
        
        $productsQuery = Product::with(['ProductColors', 'ProductSizes', 'ProductImages', 'reviews'])
            ->orWhere('name', 'like', "%$query%");
        
        if ($category) {
            $productsQuery->whereHas('ProductCategory', function($q) use ($category){
                $q->where('slug', $category);
            });
        }
        
        $paginationSettings = SiteHelper::settings()['Pagination'];
        $products = $productsQuery->paginate($paginationSettings);
    
        // Calculate dynamic price ranges based on products' prices
        $minPrice = $products->min('discounted_price');
        $maxPrice = $products->max('discounted_price');
        $priceRangeCount = 5; // Number of desired price ranges
        $priceRangeInterval = ceil(($maxPrice - $minPrice) / $priceRangeCount);
        
        $priceRanges = [];
        $lowerPrice = $minPrice;
        for ($i = 1; $i <= $priceRangeCount; $i++) {
            $upperPrice = $lowerPrice + $priceRangeInterval;
            $priceRanges[] = "$lowerPrice-$upperPrice";
            $lowerPrice = $upperPrice + 1;
        }
    
        // Calculate price range counts
        $priceRangeCounts = [];
        foreach ($products as $product) {
            $price = $product->discounted_price;
            foreach ($priceRanges as $range) {
                [$minPrice, $maxPrice] = explode('-', $range);
                if ($price >= $minPrice && $price <= $maxPrice) {
                    $priceRangeCounts[$range] = isset($priceRangeCounts[$range]) ? $priceRangeCounts[$range] + 1 : 1;
                }
            }
        }
    
        return view('frontend.all_products', compact('products', 'colors', 'sizes', 'priceRanges', 'priceRangeCounts'));
    }
         

    public function filterProducts(Request $request)
    {
        $colors = Color::withCount('products')->get();
        $sizes = Size::withCount('products')->get();
        $category = $request->input('category_id');
        $selectedColors = $request->input('color', []);
        $selectedSizes = $request->input('size', []);
        $selectedPriceRanges = $request->input('price_range', []);
        $productNameFilter = $request->input('product_name', '');
    
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
    
        if (!empty($productNameFilter)) {
            $query->where('name', 'like', "%$productNameFilter%");
        }
    
        // Apply selected price range filter
        if (!empty($selectedPriceRanges)) {
            $query->where(function ($q) use ($selectedPriceRanges) {
                foreach ($selectedPriceRanges as $range) {
                    [$minPrice, $maxPrice] = explode('-', $range);
                    $q->orWhereBetween('discounted_price', [$minPrice, $maxPrice]);
                }
            });
        }

        $paginationSettings = SiteHelper::settings()['Pagination'];
        $products = $query->paginate($paginationSettings);
    
        // Calculate dynamic price ranges based on products' prices
        $minPrice = $products->min('discounted_price');
        $maxPrice = $products->max('discounted_price');
        $priceRangeCount = 5; // Number of desired price ranges
        $priceRangeInterval = ceil(($maxPrice - $minPrice) / $priceRangeCount);
    
        $priceRanges = [];
        $lowerPrice = $minPrice;
        for ($i = 1; $i <= $priceRangeCount; $i++) {
            $upperPrice = $lowerPrice + $priceRangeInterval;
            $priceRanges[] = "$lowerPrice-$upperPrice";
            $lowerPrice = $upperPrice + 1;
        }
    
        // Calculate price range counts for displayed products
        $priceRangeFilter = [];
        foreach ($products as $product) {
            $price = $product->discounted_price;
            foreach ($priceRanges as $range) {
                [$minPrice, $maxPrice] = explode('-', $range);
                if ($price >= $minPrice && $price <= $maxPrice) {
                    $priceRangeFilter[$range] = isset($priceRangeFilter[$range]) ? $priceRangeFilter[$range] + 1 : 1;
                }
            }
        }

        $productsQuery = Product::with(['ProductColors', 'ProductSizes', 'ProductImages', 'reviews'])->get();
    
        // Calculate dynamic price ranges based on products' prices
        $minPrice = $productsQuery->min('discounted_price');
        $maxPrice = $productsQuery->max('discounted_price');
        $priceRangeCount = 5; // Number of desired price ranges
        $priceRangeInterval = ceil(($maxPrice - $minPrice) / $priceRangeCount);
        
        $priceRanges = [];
        $lowerPrice = $minPrice;
        for ($i = 1; $i <= $priceRangeCount; $i++) {
            $upperPrice = $lowerPrice + $priceRangeInterval;
            $priceRanges[] = "$lowerPrice-$upperPrice";
            $lowerPrice = $upperPrice + 1;
        }
    
        // Calculate price range counts
        $priceRangeCounts = [];
        foreach ($productsQuery as $product) {
            $price = $product->discounted_price;
            foreach ($priceRanges as $range) {
                [$minPrice, $maxPrice] = explode('-', $range);
                if ($price >= $minPrice && $price <= $maxPrice) {
                    $priceRangeCounts[$range] = isset($priceRangeCounts[$range]) ? $priceRangeCounts[$range] + 1 : 1;
                }
            }
        }
    
        return view('frontend.all_products', compact('products', 'colors', 'sizes', 'priceRangeCounts', 'selectedPriceRanges'));
    }
    
    
    
    
      
}
