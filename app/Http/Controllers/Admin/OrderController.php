<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BillingInfo;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Helpers\SiteHelper;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Stripe;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = "order";
        return view('admin.order.index', compact('page'));
    }

    public function load(Request $request)
    {
        $limit = $request->post('length');
        $start = $request->post('start');
        $searchTerm = $request->post('search')['value'];

        $columnIndex = $request->post('order')[0]['column']; // Column index
        $columnName = $request->post('columns')[$columnIndex]['data']; // Column name
        $columnSortOrder = $request->post('order')[0]['dir']; // asc or desc

        $user = Auth::user(); // Get the authenticated user

        $query = DB::table('orders');

        // Filter orders based on user role
        if (!$user->hasRole('admin')) {
            $query->where('user_id', $user->id);
        }

        if ($searchTerm != '') {
            $query->where(function ($query) use ($searchTerm) {
                $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $totalRecords = $query->count();

        $fetch_data = null;
        $recordsTotal = null;
        $recordsFiltered = null;
        if ($searchTerm == '') {
            $fetch_data = $query
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = $query
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        } else {
            $fetch_data = $query
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = $query
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        }

        $data = array();
        $SrNo = $start + 1;
        foreach ($fetch_data as $row => $item) {
            $Edit = route('order.edit', array($item->id));
            $sub_array = array();
            $sub_array['id'] = $SrNo;
            $sub_array['order_status'] = $item->order_status;
            $sub_array['subtotal'] = $item->subtotal;
            $sub_array['shipping_amount'] = $item->shipping_amount;
            $sub_array['total'] = $item->total;
            $sub_array['order_description'] = $item->order_description;
            $sub_array['payment_status'] = $item->payment_status;
            $sub_array['delivery_note'] = $item->delivery_note;
            $sub_array['action'] = '<a href="' . $Edit . '" class="text-primary fs-5"><i class="fas fa-edit"></i></a><span><i id="delete||' . $item->id . '" onclick="deleteOrder(this.id);" class="fas fa-trash-alt fs-5 ml-2 text-danger cursor-pointer"></i></span>';
            $SrNo++;
            $data[] = $sub_array;
        }

        $json_data = array(
            "draw" => intval($request->post('draw')),
            "iTotalRecords" => $recordsTotal,
            "iTotalDisplayRecords" => $recordsFiltered,
            "aaData" => $data
        );

        echo json_encode($json_data);
    }

    public function checkout(){
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
        return view('frontend.checkout',compact('cart','total','coupon_amount','coupon_code','shipping_amount'));
    }

    public function saveOrderDetails(Request $request){
        Session::put('orderRequest',$request->all());
        $total = $request->total;
        return view('stripe',compact('total'));
    }

    public function stripe(Request $request)
    {
        $total = $request->total;
        return view('stripe',compact('total'));
    }

    public function stripePost(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));


        $totalAmount = $request->total_amount;

        // Calculate commission
        $commission = $totalAmount * 0.05;

        // Charge the customer
        $customerCharge = Charge::create([
            "amount" => $totalAmount * 100, // Convert to cents
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test Payment"
        ]);

        if ($customerCharge->status == 'succeeded') {
            // Create the booking
            $this->createOrder($commission);
            return redirect('/')->with(['success' => 'Order Created successfully']);
        }

        Session::flash('error', 'Something went wrong');
        return back();
    }

    public function createOrder($commission){

        $orderRequest =  Session::get('orderRequest');
        $coupon=null;
        if (Session::has('Coupon')) {
            $coupon = Session::get('Coupon');
        }


        BillingInfo::create([
            "first_name" => $orderRequest['first_name'],
            "last_name" => $orderRequest['last_name'],
            "email" => $orderRequest['email'],
            "phone" => $orderRequest['phone'],
            "address" => $orderRequest['address'],
            "country" => $orderRequest['country'],
            "city" => $orderRequest['city'],
            "province" => $orderRequest['state'],
            "zip" => $orderRequest['zip_code'],
        ]);
        $cart = Cart::Content();
        $subtotal=0;
        foreach ($cart as $item){
            $subtotal +=$item->price*$item->qty;
        }

       $order = Order::create([
            'user_id'=>auth()->id(),
            'coupon_id'=>$coupon ? $coupon->id : null,
            'subtotal'=>$subtotal,
            'total'=>$subtotal - ($coupon ? $coupon->discount_amount : 0),
            'payment_status'=>'paid',
            'paid_at'=>now(),
       ]);

       foreach ($cart as $item) {
           $product =
            OrderItem::create([
                'order_id'=>$order->id,
               'product_id' => $item->id,
               'quantity'=>$item->qty,
               'color_id'=>$item->options->color_id,
               'size_id'=>$item->options->size_id,
                'name'=>$item->name,
                'product_price'=>$item->price,
                'subtotal'=>$item->price * $item->qty

            ]);
       }

        return back()->with(['success'=>'Order Created Successfully']);

    }
}
