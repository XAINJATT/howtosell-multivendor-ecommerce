<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddToCartController extends Controller
{
    public function index(){
        $cart = Cart::Content();
        $total=0;
        $coupon_amount = 0;
        $shipping_amount=0;
        $coupon_code = '';
        if (Session::has('Coupon')){
            $coupon_amount = Session::get('Coupon')->discount_amount;
            $coupon_code = Session::get('Coupon')->coupon_code;
        }
        foreach ($cart as $item){
            $total +=$item->price*$item->qty;
        }

        return view('frontend.cart',compact('cart','total','coupon_amount','coupon_code','shipping_amount'));
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


//        dd($qty,$rowId);
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

    public function applyCoupon(Request $request){
        $coupon = Coupon::where('coupon_code',$request->code)->whereDate('start_date','<=',now()->format('Y-m-d'))
            ->whereDate('end_date','>=',now()->format('Y-m-d'))->first();
        if($coupon){
            Session::put('Coupon',$coupon);
            $msg = 'Coupon Applied Successfully';
            $status=true;
        }else{
            $msg = 'Coupon Not found or expired';
            $status=false;
        }
        return response()->json(['msg' => $msg, 'status'=>$status]);
    }
}

