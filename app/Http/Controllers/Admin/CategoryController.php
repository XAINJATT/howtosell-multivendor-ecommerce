<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
                'name' => 'required',
                'icon' => 'required',
        ], [
                'name.required' => 'Category name is required',
                'icon.required' => 'Icon field is required',
        ]);
       $cat = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon,
       ]);

        return back()->with(['success' => 'Category added successfully.']);
    }
    public function editcategory(Request $request, $id)
    {
        // dd($id);
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'icon' => 'required',
            ],
            [
                'name.required' => 'Category name is required',
                'icon.required' => 'Icon field is required',
            ]
        );
        $editcategory = Category::where('id', $id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon,
        ]);
        return back()->with(['success' => 'Category updated successfully.']);
    }

    public function deletecategory(Request $request, $id)
    {
        //  dd($id);

        Category::find($id)->delete();
        return back()->with(['success' => 'Category deleted successfully.']);
    }


    public function subcategoryList()
    {
        $all_categories = Category::whereNull('parent_id')->get();
        $categories = Category::with(['Parent'])->whereNotNull('parent_id')->get();
        return view('admin.category.sub_categories', compact('categories', 'all_categories'));
    }
    public function addsubcategory(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'icon' => 'required',
                'parent' => 'required',

            ],
            [
                'name.required' => 'Category name is required',
                'icon.required' => 'Icon field is required',
                'parent.required' => 'Parent field is required',

            ]
        );
        $cat = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon,
            'parent_id' => $request->parent,
        ]);

        return back()->with(['success' => 'Category added successfully.']);
    }

    public function Updatesubcategory(Request $request, $id)
    {

        // dd($id);
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'icon' => 'required',
                'parent' => 'required',

            ],
            [
                'name.required' => 'Category name is required',
                'icon.required' => 'Icon field is required',
                'parent.required' => 'Parent field is required',

            ]
        );
        Category::where('id', $id)->update([
            'name' => $request->name,
            'slug' => $request->name,
            'icon' => $request->icon,
            'parent_id' => $request->parent,
        ]);
        return back()->with(['success' => 'Category updated successfully.']);
    }
    public function deleteSubcategory(Request $request, $id)
    {
        //  dd($id);

        Category::find($id)->delete();
        return back()->with(['success' => 'Category deleted successfully.']);
    }
}
