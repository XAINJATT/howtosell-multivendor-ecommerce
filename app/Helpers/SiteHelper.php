<?php

use Gloudemans\Shoppingcart\Facades\Cart;

if (!function_exists('CountCart')) {
    function CountCart()
    {
        return count(Cart::Content());
    }
}
