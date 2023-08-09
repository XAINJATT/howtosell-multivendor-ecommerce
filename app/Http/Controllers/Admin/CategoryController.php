<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\SiteHelper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = "category";
        return view('admin.category.index', compact('page'));
    }

    public function add()
    {
        $page = "add";
        $Categories = Category::all();
        return view('admin.category.add', compact('page', 'Categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,' . $request['name'] . ',id,deleted_at,NULL',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {

            /* 1 - Image */
            $FileImage = "";
            if ($request->has('image')) {
                $FileImage = 'Image-' . Carbon::now()->format('Ymd-His') . '.' . $request->file('image')->extension();
                $request->file('image')->storeAs('public/category/', $FileImage);
            }

            // Create a slug from the category name
            $slug = Str::slug($request['name']);

            $Affected = Category::create([
                'name' => $request['name'],
                'slug' => $slug,
                'image' => $FileImage,
                'parent_id' => $request['parent_id'],
                'created_at' => Carbon::now()
            ]);
            if ($Affected) {
                return redirect()->route('category')->with('success-message', 'Category added successfully');
            } else {
                return redirect()->route('category')->with('error-message', 'An unhandled error occurred');
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
            $fetch_data = DB::table('categories')
                ->where('deleted_at', '=', null)
                ->select('categories.*')
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
            $recordsFiltered = DB::table('categories')
                ->where('deleted_at', '=', null)
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        } else {
            $fetch_data = DB::table('categories')
                ->where('deleted_at', '=', null)
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->select('categories.*')
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = DB::table('categories')
                ->where('deleted_at', '=', null)
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        }

        $data = array();
        $SrNo = $start + 1;
        foreach ($fetch_data as $row => $item) {
            $Edit = route('category.edit', array($item->id));
            $Image = asset('public/storage/category/' . $item->image);
            $sub_array = array();
            $sub_array['id'] = $SrNo;
            $sub_array['image'] = '<img src="' . $Image . '" class="img-fluid rounded-circle productImageSetting" alt="Category Image" />';
            $sub_array['name'] = $item->name;
            $sub_array['action'] = '<a href="' . $Edit . '" class="text-primary fs-5"><i class="fas fa-edit"></i></a><span><i id="delete||' . $item->id . '" onclick="deleteCategory(this.id);" class="fas fa-trash-alt fs-5 ml-2 text-danger cursor-pointer"></i></span>';
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
        $category = Category::findOrFail($id);
        $Categories = Category::where('id', '!=', $id)->get();
        return view('admin.category.edit', compact('page', 'category', 'Categories'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        // exit();
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,' . $request['id'] . ',id,deleted_at,NULL',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {

            /* 1 - Image */
            $FileImage = "";
            if ($request->has('image')) {
                if ($request['old_image'] != "") {
                    $Path = public_path('storage/category') . '/' . $request['old_image'];
                    if (file_exists($Path)) {
                        unlink($Path);
                    }
                }
                $FileImage = 'Image-' . Carbon::now()->format('Ymd-His') . '.' . $request->file('image')->extension();
                $request->file('image')->storeAs('public/category/', $FileImage);
            } else {
                $FileImage = $request['old_image'];
            }

            // Create a slug from the category name
            $slug = Str::slug($request['name']);

            $Affected = Category::where('id', $request['id'])
                ->update([
                    'name' => $request['name'],
                    'slug' => $slug,
                    'image' => $FileImage,
                    'parent_id' => $request['parent_id'],
                    'updated_at' => Carbon::now()
                ]);
            if ($Affected) {
                return redirect()->route('category')->with('success-message', 'Category updated successfully');
            } else {
                return redirect()->route('category')->with('error-message', 'An unhandled error occurred');
            }
        }
    }

    public function delete(Request $request)
    {
        $category = Category::findOrFail($request['id']);

        //Profile Image
        $FileImage = public_path('storage/category') . '/' . $category->image;
        if (file_exists($FileImage)) {
            unlink($FileImage);
        }

        $Affected = Category::where('id', $request['id'])
            ->update([
                'deleted_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        if ($Affected) {
            return redirect()->route('category')->with('success-message', 'Category deleted successfully');
        } else {
            return redirect()->route('category')->with('error-message', 'An unhandled error occurred');
        }
    }

    public function getDriver(Request $request)
    {
        $drivers = User::join('drivers', 'users.id','=','drivers.user_id')
            ->where('users.deleted_at', null)
            ->where('users.role', 1)
            ->where('drivers.job_category', $request['CategoryId'])
            ->select('users.id','drivers.first_name','drivers.last_name')
            ->get();

        $option = '<option value="">Select Driver</option>';
        foreach ($drivers as $index => $value) {
            $option .= '<option value="'. $value->id .'">'. $value->first_name . ' ' . $value->last_name .'</option>';
        }
        echo json_encode($option);
    }

    public function CheckForDuplicateCategory(Request $request)
    {
        $id = $request['Id'];
        $value = $request['Value'];
        $count = Category::where('id', '<>', $id)
            ->where('category', $value)
            ->count();

        if ($count > 0) {
            return 'Failed';
        } else {
            return 'Success';
        }
    }
}
