<?php

use App\Models\Wallet;
use App\Models\WalletTransaction;
use Gloudemans\Shoppingcart\Facades\Cart;

if (!function_exists('CountCart')) {
    function CountCart()
    {
        return count(Cart::Content());
    }
}

if (!function_exists('WalletTrans')) {
    function WalletTrans($user_id,$amount,$orderId,$productId)
    {
        // transaction
        $wallet =  Wallet::where('user_id', $user_id)->first();
        WalletTransaction::create([
            'product_id' => $productId,
            'order_id' => $orderId,
            'user_id' => $user_id,
            'amount' => $amount
        ]);

        if ($wallet) {
            Wallet::where('user_id', $user_id)->update([
                'balance' => $wallet->balance + $amount
            ]);
        } else {
            Wallet::create([
                'user_id' => $user_id,
                'balance' => $wallet->balance + $amount
            ]);
        }
    }
}
if (!function_exists('webTranslation')) {
    function webTranslation($key)
    {
        $arr = session()->get('webDet');
        return $arr->$key;
    }
}
