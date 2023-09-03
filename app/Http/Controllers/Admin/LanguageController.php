<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\SiteHelper;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = "language";
        return view('admin.language.index', compact('page'));
    }

    public function add()
    {
        $page = "add";
        $Languages = Language::all();
        return view('admin.language.add', compact('page', 'Languages'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:languages,name,' . $request['id'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {

        // Get the language name from the request
        $name = $request['name'];
        // Get the first two characters of the name in lowercase
        $slug = strtolower(substr($name, 0, 2));

            $Affected = Language::create([
                'name' => $name,
                'slug' => $slug,
                'created_at' => Carbon::now()
            ]);
            if ($Affected) {
                return redirect()->route('language')->with('success-message', 'Language added successfully');
            } else {
                return redirect()->route('language')->with('error-message', 'An unhandled error occurred');
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
            $fetch_data = DB::table('languages')
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = DB::table('languages')
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        } else {
            $fetch_data = DB::table('languages')
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = DB::table('languages')
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        }

        $data = array();
        $SrNo = $start + 1;
        foreach ($fetch_data as $row => $item) {
            $Edit = route('language.edit', array($item->id));
            $sub_array = array();
            $sub_array['id'] = $SrNo;
            $sub_array['name'] = $item->name;
            $sub_array['action'] = '<a href="' . $Edit . '" class="text-primary fs-5"><i class="fas fa-edit"></i></a><span><i id="delete||' . $item->id . '" onclick="deleteLanguage(this.id);" class="fas fa-trash-alt fs-5 ml-2 text-danger cursor-pointer"></i></span>';
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
        $language = Language::where('id', $id)->First();
        $Languages = Language::all();
        return view('admin.language.edit', compact('page', 'language', 'Languages'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:languages,name,' . $request['id'] . ',id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {

            // Get the language name from the request
            $name = $request['name'];
            // Get the first two characters of the name in lowercase
            $slug = strtolower(substr($name, 0, 2));
            $Affected = Language::where('id', $request['id'])
                ->update([
                    'name' => $name,
                    'slug' => $slug,
                    'updated_at' => Carbon::now()
                ]);
            if ($Affected) {
                return redirect()->route('language')->with('success-message', 'Language updated successfully');
            } else {
                return redirect()->route('language')->with('error-message', 'An unhandled error occurred');
            }
        }
    }

    public function delete(Request $request)
    {
        $Affected = Language::where('id', $request['id'])->delete();
        if ($Affected) {
            return redirect()->route('language')->with('success-message', 'Language deleted successfully');
        } else {
            return redirect()->route('language')->with('error-message', 'An unhandled error occurred');
        }
    }
}
