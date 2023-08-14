<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\SiteHelper;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Color;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = "color";
        return view('admin.color.index', compact('page'));
    }

    public function add()
    {
        $page = "add";
        $Colors = Color::all();
        return view('admin.color.add', compact('page', 'Colors'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:colors,name,' . $request['name'] . ',id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $Affected = Color::create([
                'name' => $request['name'],
                'created_at' => Carbon::now()
            ]);
            if ($Affected) {
                return redirect()->route('color')->with('success-message', 'Color added successfully');
            } else {
                return redirect()->route('color')->with('error-message', 'An unhandled error occurred');
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
            $fetch_data = DB::table('colors')
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = DB::table('colors')
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        } else {
            $fetch_data = DB::table('colors')
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = DB::table('colors')
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        }

        $data = array();
        $SrNo = $start + 1;
        foreach ($fetch_data as $row => $item) {
            $Edit = route('color.edit', array($item->id));
            $sub_array = array();
            $sub_array['id'] = $SrNo;
            $sub_array['name'] = $item->name;
            $sub_array['action'] = '<a href="' . $Edit . '" class="text-primary fs-5"><i class="fas fa-edit"></i></a><span><i id="delete||' . $item->id . '" onclick="deleteColor(this.id);" class="fas fa-trash-alt fs-5 ml-2 text-danger cursor-pointer"></i></span>';
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
        $color = Color::where('id', $id)->First();
        $Colors = Color::all();
        return view('admin.color.edit', compact('page', 'color', 'Colors'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:colors,name,' . $request['id'] . ',id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $Affected = Color::where('id', $request['id'])
                ->update([
                    'name' => $request['name'],
                    'updated_at' => Carbon::now()
                ]);
            if ($Affected) {
                return redirect()->route('color')->with('success-message', 'Color updated successfully');
            } else {
                return redirect()->route('color')->with('error-message', 'An unhandled error occurred');
            }
        }
    }

    public function delete(Request $request)
    {
        $Affected = Color::where('id', $request['id'])->delete();
        if ($Affected) {
            return redirect()->route('color')->with('success-message', 'Color deleted successfully');
        } else {
            return redirect()->route('color')->with('error-message', 'An unhandled error occurred');
        }
    }
}
