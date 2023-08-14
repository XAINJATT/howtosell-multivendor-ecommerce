<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\SiteHelper;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = "coupon";
        return view('admin.coupon.index', compact('page'));
    }

    public function add()
    {
        $page = "add";
        $Coupons = Coupon::all();
        return view('admin.coupon.add', compact('page', 'Coupons'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required|unique:coupons,coupon_code',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $Affected = Coupon::create([
                'coupon_code' => $request['coupon_code'],
                'discount_amount' => $request['discount_amount'],
                'start_date' => Carbon::parse($request['start_date'])->format('Y-m-d'),
                'end_date' => Carbon::parse($request['end_date'])->format('Y-m-d'),
                'created_at' => Carbon::now()
            ]);
            if ($Affected) {
                return redirect()->route('coupon')->with('success-message', 'Coupon added successfully');
            } else {
                return redirect()->route('coupon')->with('error-message', 'An unhandled error occurred');
            }
        }
    }

    public function load(Request $request)
    {
        $limit = $request->post('length');
        $start = $request->post('start');
        $searchTerm = $request->post('search')['value'];

        $columnIndex = $request->post('order')[0]['column']; // Column index
        $columnName = $request->post('columns')[$columnIndex]['data']; // Column name
        $columnSortOrder = $request->post('order')[0]['dir']; // asc or desc

        $fetch_data = null;
        $recordsTotal = null;
        $recordsFiltered = null;
        if ($searchTerm == '') {
            $fetch_data = DB::table('coupons')
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = DB::table('coupons')
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        } else {
            $fetch_data = DB::table('coupons')
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('coupon_code', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = DB::table('coupons')
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('coupon_code', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        }

        $data = array();
        $SrNo = $start + 1;
        foreach ($fetch_data as $row => $item) {
            $Edit = route('coupon.edit', array($item->id));
            $sub_array = array();
            $sub_array['id'] = $SrNo;
            $sub_array['coupon_code'] = $item->coupon_code;
            $sub_array['discount_amount'] = $item->discount_amount;
            $sub_array['start_date'] = Carbon::parse($item->start_date)->format('d-m-Y');
            $sub_array['end_date'] = Carbon::parse($item->end_date)->format('d-m-Y');
            $sub_array['action'] = '<a href="' . $Edit . '" class="text-primary fs-5"><i class="fas fa-edit"></i></a><span><i id="delete||' . $item->id . '" onclick="deleteCoupon(this.id);" class="fas fa-trash-alt fs-5 ml-2 text-danger cursor-pointer"></i></span>';
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

    public function edit($id)
    {
        $page = 'edit';
        $coupon = Coupon::where('id', $id)->First();
        $Coupons = Coupon::all();
        return view('admin.coupon.edit', compact('page', 'coupon', 'Coupons'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required|unique:coupons,coupon_code,' . $request['id'] . ',id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $Affected = Coupon::where('id', $request['id'])
                ->update([
                    'coupon_code' => $request['coupon_code'],
                    'discount_amount' => $request['discount_amount'],
                    'start_date' => Carbon::parse($request['start_date'])->format('Y-m-d'),
                    'end_date' => Carbon::parse($request['end_date'])->format('Y-m-d'),
                    'updated_at' => Carbon::now()
                ]);
            if ($Affected) {
                return redirect()->route('coupon')->with('success-message', 'Coupon updated successfully');
            } else {
                return redirect()->route('coupon')->with('error-message', 'An unhandled error occurred');
            }
        }
    }

    public function delete(Request $request)
    {
        $Affected = Coupon::where('id', $request['id'])->delete();
        if ($Affected) {
            return redirect()->route('coupon')->with('success-message', 'Coupon deleted successfully');
        } else {
            return redirect()->route('coupon')->with('error-message', 'An unhandled error occurred');
        }
    }
}
