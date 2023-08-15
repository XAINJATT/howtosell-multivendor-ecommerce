<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\SiteHelper;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\RoleHasPermission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = "role";
        return view('admin.role.index', compact('page'));
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
            $fetch_data = DB::table('roles')
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = DB::table('roles')
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        } else {
            $fetch_data = DB::table('roles')
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = DB::table('roles')
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        }

        $data = array();
        $SrNo = $start + 1;
        foreach ($fetch_data as $row => $item) {
            $Edit = route('role.edit', array($item->id));
            $sub_array = array();
            $sub_array['id'] = $SrNo;
            $sub_array['name'] = $item->name;
            $sub_array['action'] = '<a href="' . $Edit . '" class="text-primary fs-5"><i class="fas fa-edit"></i></a><span><i id="delete||' . $item->id . '" onclick="deleteRole(this.id);" class="fas fa-trash-alt fs-5 ml-2 text-danger cursor-pointer"></i></span>';
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
        $Roles = Role::all();
        $Permissions = Permission::all();
        return view('admin.role.add', compact('page', 'Roles', 'Permissions'));
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request['name']]);
        $permissions = $request['permission'];
        $role->syncPermissions($permissions);

        if ($role) {
            return redirect()->route('role')->with('success-message', 'Role added successfully');
        } else {
            return redirect()->route('role')->with('error-message', 'An unhandled error occurred');
        }
    }

    public function edit($id)
    {
        $page = 'edit';
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        
        return view('admin.role.edit', compact('page', 'role', 'permissions'));
    }

    public function update(Request $request)
    {
        $role = Role::findOrFail($request['id']);
        $role->update(['name' => $request['name']]);
        $permissions = $request['permission'];
        $role->syncPermissions($permissions);

        return redirect()->route('role')->with('success-message', 'Role updated successfully');
    }

    public function delete(Request $request)
    {
        $Affected = Role::where('id', $request['id'])->delete();
        if ($Affected) {
            return redirect()->route('role')->with('success-message', 'Role deleted successfully');
        } else {
            return redirect()->route('role')->with('error-message', 'An unhandled error occurred');
        }
    }
}
