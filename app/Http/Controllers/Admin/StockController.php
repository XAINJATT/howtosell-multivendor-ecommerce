<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\SiteHelper;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = "stock";
        return view('admin.stock.index', compact('page'));
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
            $fetch_data = Product::select('products.*')
                ->orderBy($columnName, $columnSortOrder);
                if ($limit == -1) {
                    $fetch_data = $fetch_data
                        ->get();
                } else {
                    $fetch_data = $fetch_data
                        ->offset($start)
                        ->limit($limit)
                        ->get();
                }
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = Product::orderBy($columnName, $columnSortOrder)
                ->count();
        } else {
            $fetch_data = Product::where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                    $query->orWhere('price', 'LIKE', '%' . $searchTerm . '%');
                })
                ->select('products.*')
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = Product::where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                    $query->orWhere('price', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        }

        $data = array();
        $SrNo = $start + 1;
        foreach ($fetch_data as $row => $item) {
            $Edit = route('product.edit', array($item->id));
            $Image = asset('public/storage/product/' . $item->product_image);
            $sub_array = array();
            $sub_array['id'] = $SrNo;
            $sub_array['image'] = '<img src="' . $Image . '" class="img-fluid rounded-circle productImageSetting" alt="Product Image" />';
            $sub_array['name'] = $item->name;
            $sub_array['price'] = $item->price;
            $sub_array['discounted_price'] = $item->discounted_price;
            $sub_array['short_description'] = $item->short_description;
            $sub_array['soh'] = $item->soh;
            $sub_array['input'] = '<input type="number" class="form-control" name="product['.$item->id.']"placeholder="Enter Product Stock" value="0">';
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

    public function store(Request $request)
    {
        $productData = $request->input('product');

        foreach ($productData as $productId => $quantity) {
            if ($quantity > 0) {
                $stock = new Stock();
                $stock->product_id = $productId;
                $stock->qty = $quantity;
                $stock->save();
            }
        }

        return redirect()->route('stock')->with('success-message', 'Stock added successfully');
    }

}
