<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavoriteProduct;
use Illuminate\Support\Facades\Auth;

class FavoriteProductController extends Controller
{
    public function favoriteProduct(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['msg' => 'You need to be logged in to add favorites.'], 403);
        }

        $userId = Auth::id();
        $productId = $request->id;

        $favoriteProduct = FavoriteProduct::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($favoriteProduct) {
            $favoriteProduct->delete();
            $response = ['msg' => 'Product removed from favorites.', 'favorite' => false];
        } else {
            $favoriteProduct = new FavoriteProduct();
            $favoriteProduct->user_id = $userId;
            $favoriteProduct->product_id = $productId;
            $favoriteProduct->save();
            $response = ['msg' => 'Product added to favorites.', 'favorite' => true];
        }

        return response()->json($response);
    }
}
