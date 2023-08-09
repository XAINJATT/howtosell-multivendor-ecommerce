<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\FirstOrderDiscountMail;
use App\Mail\OrderMail;
use App\Models\Booking;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use function Nette\Utils\first;

class OrderController extends Controller
{
    public function checkout(Request $request){
//        $days =
        $date1 = Carbon::parse($request->start_date);
        $date2 = Carbon::parse($request->end_date);
        $differenceInDays = $date1->diffInDays($date2);
        $booking = Booking::where('user_id',\auth()->id())->first();

        $total = $request->product_price * $differenceInDays;
        $original_price = $total;
        $isAvailDisc=false;
        if (is_null($booking)){
            $total = $total - $total/10;
            $isAvailDisc = true;
        }

        $cart = [
            "product_id" =>$request->product_id,
            "vendor_id" =>$request->vendor_id,
            "product_price" =>$request->product_price,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "adults" => $request->adults,
            "childs" => $request->childs,
            "infants" => $request->infants,
            "pets" => $request->pets,
            "total_guests"=>$request->adults+$request->childs+$request->infants+$request->pets,
            'total_days'=>$differenceInDays,
            'total_amount'=> $total,
            'is_avail_discount'=>$isAvailDisc,
            'original_price'=>$original_price,
        ];

        Session::put('cart',$cart);
        return view('frontend/book-room',compact('cart'));
    }

    public function createOrder(){
        $cart = Session::get('cart');

        if ($cart['is_avail_discount']) {
            $vendor = User::where('id',$cart['vendor_id'])->first();
            Mail::to($vendor->email)->send(new FirstOrderDiscountMail());
        }
        $oldBooking = Booking::where('product_id',$cart['product_id'])
            ->where('start_date','>=',$cart['start_date'])
            ->where('end_date','<=',$cart['end_date'])->first();

        $this->sendMailsOnOrder($cart);

        $booking = Booking::create([
            'user_id'=>auth()->id(),
            'vendor_id'=>$cart['vendor_id'],
            'product_id'=>$cart['product_id'],
            'product_price'=>$cart['product_price'],
            'number_of_guests'=>$cart['total_guests'],
//            'tax'=>$cart->tax,
//            'platform_charges'=>$cart->platform_charges,
            'total'=>$cart['total_amount'],
            'start_date'=>$cart['start_date'],
            'end_date'=>$cart['end_date'],
            'booked_days'=>$cart['total_days'],
            'adults'=>$cart['adults'],
            'childs'=>$cart['childs'],
            'infants'=>$cart['infants'],
            'pets'=>$cart['pets'],
        ]);
        return [
            'status'=>false,
            'data'=>$booking
        ];
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
