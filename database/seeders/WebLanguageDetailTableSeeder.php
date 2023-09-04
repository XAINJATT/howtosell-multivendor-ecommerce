<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WebLanguageDetail;

class WebLanguageDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WebLanguageDetail::create([
            'language_id' => '1',
            'detail' => '{
                "_token":"BclFs4ICkl3W7ZOexfJG7Dlh5vIKFIDShUmbUdfO",
                "language":"1",
                "customerservice":"Customer Service",
                "home":"Home",
                "shop":"Shop",
                "menfashion":"Men Fashion",
                "womenfashion":"Women Fashion",
                "kidsfashion":"Kids Fashion",
                "shownow":"Shop Now",
                "sellnow":"Sell Now",
                "earnprofit":"EARN PROFIT",
                "wanttosell":"Want to Sell?",
                "save":"SAVE",
                "specialoffer":"Special Offer",
                "categories":"CATEGORIES",
                "qualityproduct":"Quality Product",
                "freeshipping":"Free Shipping",
                "dayreturn":"Day Return",
                "support":"Support",
                "recentproduct":"RECENT PRODUCTS",
                "filterbyprice":"FILTER BY PRICE",
                "filterbycolor":"FILTER BY COLOR",
                "filterbysize":"FILTER BY SIZE",
                "applyfilter":"Apply Filters",
                "sizes":"Sizes",
                "colors":"Colors",
                "shareon":"Share on",
                "description":"Description",
                "productdescription":"Product Description",
                "reviews":"Reviews",
                "leaveareview":"Leave a review",
                "products":"Products",
                "price":"Price",
                "quantity":"Quantity",
                "total":"Total",
                "remove":"Remove",
                "applycoupon":"Apply Coupon",
                "cartsummary":"CART SUMMARY",
                "subtotal":"Subtotal",
                "shipping":"Shipping",
                "proceedtocheckout":"Proceed To Checkout",
                "getintouch":"Get In Touch",
                "getintouchdescription":"GetInTouch Description",
                "quickshop":"Quick Shop",
                "newsletter":"NewSletter",
                "newsletterdescription":"NewSletter Description",
                "followus":"FOLLOW US",
                "submit":null
                }',
        ]);
    }
}
