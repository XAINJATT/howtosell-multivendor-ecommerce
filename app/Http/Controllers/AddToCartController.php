<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class AddToCartController extends Controller
{
    public function index(){
        $cart = Cart::Content();

        return view('frontend.cart',compact('cart'));
    }
    public function AddToCart(Request $request){
        $product = Product::where('id',$request->id)->first();
        Cart::add($request->id, $product->name, 1, $product->price, 0, [
            'img' => $product->product_image,
        ]);
        return response()->json([
            'msg' => 'Added successfully',
        ]);
    }
    public function updateCart(Request $request){

        $qty   = $request->quantity;
        $rowId = $request->rowId;
        Cart::update($rowId, $qty);

        return response()->json([
            'msg' => 'Quantity update successfully',
        ]);
    }

    public function cart_remove(Request $req)
    {
//        dd($req);
        $rowId = $req->input('rowId');
        Cart::remove($rowId);
        if (count(Cart::content()) == 0) {
            Session::forget('CouponSession');
        }
        return redirect()->route('checkout');
    }
}
