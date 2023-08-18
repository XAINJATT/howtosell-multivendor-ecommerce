<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\SiteHelper;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = "permission";
        return view('admin.permission.index', compact('page'));
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
            $fetch_data = DB::table('permissions')
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = DB::table('permissions')
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        } else {
            $fetch_data = DB::table('permissions')
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = DB::table('permissions')
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        }

        $data = array();
        $SrNo = $start + 1;
        foreach ($fetch_data as $row => $item) {
            $Edit = route('permission.edit', array($item->id));
            $sub_array = array();
            $sub_array['id'] = $SrNo;
            $sub_array['name'] = $item->name;
            $sub_array['guard_name'] = $item->guard_name;
            $sub_array['action'] = '<a href="' . $Edit . '" class="text-primary fs-5"><i class="fas fa-edit"></i></a><span><i id="delete||' . $item->id . '" onclick="deletePermission(this.id);" class="fas fa-trash-alt fs-5 ml-2 text-danger cursor-pointer"></i></span>';
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
        $page = "add";
    
        try {
            $permissions = DB::table('permissions')->get();
    
            return view('admin.Permission.add', compact('page', 'permissions'));
        } catch (\Exception $e) {
            return redirect()->route('permission')->with('error-message', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,' . $request['name'] . ',id',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            try {
                DB::beginTransaction();
    
                $affected = DB::table('permissions')->insert([
                    'name' => $request['name'],
                    'guard_name' => $request['guard_name'],
                    'created_at' => Carbon::now(),
                ]);
    
                if ($affected) {
                    DB::commit();
                    return redirect()->route('permission')->with('success-message', 'Permission added successfully');
                } else {
                    DB::rollBack();
                    return redirect()->route('permission')->with('error-message', 'An unhandled error occurred');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('permission')->with('error-message', 'An error occurred: ' . $e->getMessage());
            }
        }
    }
    

    public function edit($id)
    {
        $page = 'edit';
        
        try {
            $permission = DB::table('permissions')->where('id', $id)->first();
    
            if (!$permission) {
                return redirect()->route('permission')->with('error-message', 'Permission not found');
            }
    
            return view('admin.Permission.edit', compact('page', 'permission'));
        } catch (\Exception $e) {
            return redirect()->route('permission')->with('error-message', 'An error occurred: ' . $e->getMessage());
        }
    }
    

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,' . $request['id'] . ',id',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            try {
                DB::beginTransaction();
    
                $affected = DB::table('permissions')->where('id', $request['id'])->update([
                    'name' => $request['name'],
                    'guard_name' => $request['guard_name'],
                    'updated_at' => Carbon::now(),
                ]);
    
                if ($affected !== false) {
                    DB::commit();
                    return redirect()->route('permission')->with('success-message', 'Permission updated successfully');
                } else {
                    DB::rollBack();
                    return redirect()->route('permission')->with('error-message', 'An unhandled error occurred');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('permission')->with('error-message', 'An error occurred: ' . $e->getMessage());
            }
        }
    }
    

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
    
            $affected = DB::table('permissions')->where('id', $request['id'])->delete();
    
            if ($affected) {
                DB::commit();
                return redirect()->route('permission')->with('success-message', 'Permission deleted successfully');
            } else {
                DB::rollBack();
                return redirect()->route('permission')->with('error-message', 'An unhandled error occurred');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('permission')->with('error-message', 'An error occurred: ' . $e->getMessage());
        }
    }    
}
