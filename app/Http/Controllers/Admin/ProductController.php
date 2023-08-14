<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Storage;
use App\Models\Size;
use Illuminate\Support\Str;
use App\Helpers\SiteHelper;
use App\Models\Color;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = "product";
        return view('admin.product.index', compact('page'));
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
            $sub_array['action'] = '<a href="' . $Edit . '" class="text-primary fs-5"><i class="fas fa-edit"></i></a><span><i id="delete||' . $item->id . '" onclick="deleteProduct(this.id);" class="fas fa-trash-alt fs-5 ml-2 text-danger cursor-pointer"></i></span>';
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

    public function add()
    {
        $page = "product";
        $categories = Category::all();
        $Colors = Color::all();
        $Sizes = Size::all();
        return view('admin.product.add', compact('page', 'Colors', 'Sizes', 'categories'));
    }

    public function store(Request $request)
    {
        /* 1 - Image */
        $FileImage = "";
        if ($request->has('image')) {
            $FileImage = 'Image-' . Carbon::now()->format('Ymd-His') . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/product/', $FileImage);
        }

        $Affected = Product::create([
            'name' => $request['name'],
            'category_id' => $request['category'],
            'price' => $request['price'],
            'discounted_price' => $request['discounted_price'],
            'short_description' => $request['short_description'],
            'long_description' => $request['long_description'],
            'soh' => $request['soh'],
            'product_image' => $FileImage,
            'created_at' => Carbon::now()
        ]);

        $stock = new Stock();
        $stock->product_id = $Affected->id;
        $stock->qty = $Affected->soh;
        $stock->type = 0;
        $stock->save();

        foreach ($request->other_images as $image) {
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('product'), $imageName);
            ProductImage::create([
                'product_id' => $Affected->id,
                'image' => 'public/product/' . $imageName
            ]);
        }

        foreach ($request->Colors as $color) {
            $pF = ProductColor::create([
                "product_id" => $Affected->id,
                "color_id" => $color,
            ]);
        }
        
        foreach ($request->Sizes as $size) {
            $pF = ProductSize::create([
                "product_id" => $Affected->id,
                "size_id" => $size,
            ]);
        }

        if ($Affected) {
            return redirect()->route('product')->with('success-message', 'Product added successfully');
        } else {
            return redirect()->route('product')->with('error-message', 'An unhandled error occurred');
        }
    }

    public function edit($id)
    {
        $page = "product";
        $product = Product::with(['ProductColors', 'ProductSizes', 'ProductImages'])->where('id', $id)->first();
        $categories = Category::all();
        $Colors = Color::all();
        $Sizes = Size::all();

        return view('admin.product.edit', compact('page', 'product', 'Colors', 'Sizes', 'categories'));
    }

    public function update(Request $request)
    {
        /* 1 - Image */
        $FileImage = "";
        if ($request->has('image')) {
            if ($request['old_product_image'] != "") {
                $Path = public_path('storage/product') . '/' . $request['old_product_image'];
                if (file_exists($Path)) {
                    unlink($Path);
                }
            }
            $FileImage = 'Image-' . Carbon::now()->format('Ymd-His') . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/product/', $FileImage);
        } else {
            $FileProfile = $request['old_product_image'];
        }

        $product = Product::findOrFail($request['id']);

        $product->update([
            'name' => $request['name'],
            'category_id' => $request['category'],
            'price' => $request['price'],
            'discounted_price' => $request['discounted_price'],
            'short_description' => $request['short_description'],
            'long_description' => $request['long_description'],
            'soh' => $request['soh'],
            'product_image' => $FileImage ?: $product->product_image,
        ]);

        // Update other images
        if ($request['other_images']) {
            // Delete existing other images
            foreach ($product->ProductImages as $image) {
                $imagePath = $image->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image->delete();
            }
            foreach ($request->other_images as $image) {
                $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('product'), $imageName);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'public/product/' . $imageName
                ]);
            }
        }

        // Update colors
        $product->ProductColors()->delete();
        foreach ($request->Colors as $color) {
            ProductColor::create([
                "product_id" => $product->id,
                "color_id" => $color,
            ]);
        }

        // Update sizes
        $product->ProductSizes()->delete();
        foreach ($request->Sizes as $size) {
            ProductSize::create([
                "product_id" => $product->id,
                "size_id" => $size,
            ]);
        }

        return redirect()->route('product')->with('success-message', 'Product updated successfully');
    }

    public function delete(Request $request)
    {
        $product = Product::findOrFail($request['id']);

        // Delete associated images
        foreach ($product->ProductImages as $image) {
            $imagePath = $image->image;
            // Delete image file from public directory
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            // Delete image record from database
            $image->delete();
        }

        // Delete associated colors
        $product->ProductColors()->delete();

        // Delete associated sizes
        $product->ProductSizes()->delete();

        // Delete the main product image from storage
        $Path = public_path('storage/product') . '/' . $product->product_image;
        if (file_exists($Path)) {
            unlink($Path);
        }

        // Delete the product itself
        $product->delete();

        return redirect()->route('product')->with('success-message', 'Product deleted successfully');
    }

}
