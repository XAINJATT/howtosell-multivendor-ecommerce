<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\FirstOrderDiscountMail;
use App\Mail\OrderMail;
use App\Models\Booking;
use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use function Nette\Utils\first;

class OrderController extends Controller
{
    public function checkout(Request $request){
        $cart = Cart::Content();
        return view('frontend.checkout',compact('cart'));
    }

    public function createOrder(Request $request){
        dd($request);
    }


    public function myBookings(){
        $user_id = Auth::id();
        $myBookings = Booking::with(['Vendor'])->where('user_id',$user_id)->get();

        return view('admin.my-booking.my_bookings',compact('myBookings'));
    }
    public function bookings(){

        $user_id = Auth::id();
        if (\auth()->user()->hasRole('admin')){
            $bookings = Booking::with(['User'])->get();
        }else {
            $bookings = Booking::with(['User'])->where('vendor_id', $user_id)->get();
        }

        return view('admin.bookings.bookings',compact('bookings'));
    }


    public function sendMailsOnOrder($data)
    {
        $vendorData = [
          'mail_title'=>'New Order Mail',
          'mail_text'=>'Congrats You got a new Order on '.env('APP_NAME').' From User '.\auth()->user()->name
        ];
        $vendorMail = User::where('id',$data['vendor_id'])->first();
        Mail::to($vendorMail->email)->send(new OrderMail($vendorData));

        $adminData = [
            'mail_title'=>'New Order Mail',
            'mail_text'=>'Vendor ' . $vendorMail->name . ' got a new Order on '.env('APP_NAME').' From User '.\auth()->user()->name
        ];
        Mail::to(env('ADMIN_MAIL'))->send(new OrderMail($adminData));

    }
}
