<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\SiteHelper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = "company";
        return view('admin.company.index', compact('page'));
    }

    public function add()
    {
        $page = "add";
        $Companies = Company::all();
        return view('admin.company.add', compact('page', 'Companies'));
    }

    public function store(Request $request)
    {
        /* 1 - Image */
        $FileImage = "";
        if ($request->has('image')) {
            $FileImage = 'Image-' . Carbon::now()->format('Ymd-His') . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/company/', $FileImage);
        }

        $Affected = Company::create([
            'image' => $FileImage,
            'link' => $request['link'],
            'created_at' => Carbon::now()
        ]);
        if ($Affected) {
            return redirect()->route('company')->with('success-message', 'Company added successfully');
        } else {
            return redirect()->route('company')->with('error-message', 'An unhandled error occurred');
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
            $fetch_data = DB::table('companies')
                ->select('companies.*')
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
            $recordsFiltered = DB::table('companies')
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        } else {
            $fetch_data = DB::table('companies')
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('image', 'LIKE', '%' . $searchTerm . '%');
                })
                ->select('companies.*')
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = DB::table('companies')
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('image', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        }

        $data = array();
        $SrNo = $start + 1;
        foreach ($fetch_data as $row => $item) {
            $Edit = route('company.edit', array($item->id));
            $Image = asset('public/storage/company/' . $item->image);
            $sub_array = array();
            $sub_array['id'] = $SrNo;
            $sub_array['image'] = '<img src="' . $Image . '" class="img-fluid rounded-circle productImageSetting" alt="Company Image" />';
            $sub_array['action'] = '<a href="' . $Edit . '" class="text-primary fs-5"><i class="fas fa-edit"></i></a><span><i id="delete||' . $item->id . '" onclick="deleteCompany(this.id);" class="fas fa-trash-alt fs-5 ml-2 text-danger cursor-pointer"></i></span>';
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
        $company = Company::findOrFail($id);
        $Companies = Company::where('id', '!=', $id)->get();
        return view('admin.company.edit', compact('page', 'company', 'Companies'));
    }

    public function update(Request $request)
    {
        /* 1 - Image */
        $FileImage = "";
        if ($request->has('image')) {
            if ($request['old_image'] != "") {
                $Path = public_path('storage/company') . '/' . $request['old_image'];
                if (file_exists($Path)) {
                    unlink($Path);
                }
            }
            $FileImage = 'Image-' . Carbon::now()->format('Ymd-His') . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/company/', $FileImage);
        } else {
            $FileImage = $request['old_image'];
        }

        $Affected = Company::where('id', $request['id'])
            ->update([
                'image' => $FileImage,
                'link' => $request['link'],
                'updated_at' => Carbon::now()
            ]);
        if ($Affected) {
            return redirect()->route('company')->with('success-message', 'Company updated successfully');
        } else {
            return redirect()->route('company')->with('error-message', 'An unhandled error occurred');
        }
    }

    public function delete(Request $request)
    {
        $company = Company::findOrFail($request['id']);

        //Profile Image
        $FileImage = public_path('storage/company') . '/' . $company->image;
        if (file_exists($FileImage)) {
            unlink($FileImage);
        }

        $Affected = Company::where('id', $request['id'])->delete();
        if ($Affected) {
            return redirect()->route('company')->with('success-message', 'Company deleted successfully');
        } else {
            return redirect()->route('company')->with('error-message', 'An unhandled error occurred');
        }
    }
}
