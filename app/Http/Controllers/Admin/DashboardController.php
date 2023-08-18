<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = "dashboard";
        $Role = Session::get('user_role');
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCategories = Category::where('deleted_at', null)->count();
        return view('admin.index', compact('page', 'Role', 'totalProducts', 'totalCategories', 'totalOrders'));
    }

    public function changePassword(){
        $page = "dashboard";
        return view('admin.change-password',compact('page'));
    }

    public function updatePassword(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        } else {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request['password']);
            $saved = $user->save();
            if ($saved) {
                return redirect()->back()->with('success-message', 'Password updated successfully');
            } else {
                return redirect()->back()->with('error-message', 'An unhandled error occurred');
            }
        }
    }
}
