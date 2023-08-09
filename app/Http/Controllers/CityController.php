<?php

namespace App\Http\Controllers;

use App\Helpers\SiteHelper;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = "city";
        return view('admin.city.index', compact('page'));
    }

    public function add()
    {
        $page = "add";
        $Cities = City::all();
        return view('admin.city.add', compact('page', 'Cities'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city' => 'required|unique:cities,city,' . $request['city'] . ',id,deleted_at,NULL',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $Affected = City::create([
                'city' => $request['city'],
                'sub_cities' => $request['sub_cities'] != "" && count($request['sub_cities']) != '' ? implode(',', $request['sub_cities']) : null,
                'created_at' => Carbon::now()
            ]);
            if ($Affected) {
                return redirect()->route('city')->with('success-message', 'City added successfully');
            } else {
                return redirect()->route('city')->with('error-message', 'An unhandled error occurred');
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
            $fetch_data = DB::table('cities')
                ->where('deleted_at', '=', null)
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = DB::table('cities')
                ->where('deleted_at', '=', null)
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        } else {
            $fetch_data = DB::table('cities')
                ->where('deleted_at', '=', null)
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('city', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = DB::table('cities')
                ->where('deleted_at', '=', null)
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('city', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        }

        $data = array();
        $SrNo = $start + 1;
        foreach ($fetch_data as $row => $item) {
            $Edit = route('city.edit', array($item->id));
            $sub_array = array();
            $sub_array['id'] = $SrNo;
            $sub_array['city'] = $item->city;
            $sub_array['action'] = '<a href="' . $Edit . '" class="text-primary fs-5"><i class="fas fa-edit"></i></a><span><i id="delete||' . $item->id . '" onclick="deleteCity(this.id);" class="fas fa-trash-alt fs-5 ml-2 text-danger cursor-pointer"></i></span>';
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
        $city = City::where('id', $id)->get();
        $Cities = City::all();
        return view('admin.city.edit', compact('page', 'city', 'Cities'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city' => 'required|unique:cities,city,' . $request['id'] . ',id,deleted_at,NULL',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $Affected = City::where('id', $request['id'])
                ->update([
                    'city' => $request['city'],
                    'sub_cities' => $request['sub_cities'] != "" && count($request['sub_cities']) != '' ? implode(',', $request['sub_cities']) : null,
                    'updated_at' => Carbon::now()
                ]);
            if ($Affected) {
                return redirect()->route('city')->with('success-message', 'City updated successfully');
            } else {
                return redirect()->route('city')->with('error-message', 'An unhandled error occurred');
            }
        }
    }

    public function delete(Request $request)
    {
        $Affected = City::where('id', $request['id'])
            ->update([
                'deleted_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        if ($Affected) {
            return redirect()->route('city')->with('success-message', 'City deleted successfully');
        } else {
            return redirect()->route('city')->with('error-message', 'An unhandled error occurred');
        }
    }

    public function getDriver(Request $request)
    {
        $drivers = User::join('drivers', 'users.id','=','drivers.user_id')
            ->where('users.deleted_at', null)
            ->where('users.role', 1)
            ->where('drivers.job_city', $request['CityId'])
            ->select('users.id','drivers.first_name','drivers.last_name')
            ->get();

        $option = '<option value="">Select Driver</option>';
        foreach ($drivers as $index => $value) {
            $option .= '<option value="'. $value->id .'">'. $value->first_name . ' ' . $value->last_name .'</option>';
        }
        echo json_encode($option);
    }

    public function CheckForDuplicateCity(Request $request)
    {
        $id = $request['Id'];
        $value = $request['Value'];
        $count = City::where('id', '<>', $id)
            ->where('city', $value)
            ->count();

        if ($count > 0) {
            return 'Failed';
        } else {
            return 'Success';
        }
    }
}
