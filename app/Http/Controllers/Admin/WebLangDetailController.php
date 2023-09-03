<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\SiteHelper;
use App\Models\Language;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\WebLangDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class WebLangDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = "website_extra_localization";
        $webDetails = WebLangDetail::with(['Language'])->get();
        return view('admin.website_extra_localization.index', compact('page', 'webDetails'));
    }

    public function add()
    {
        $page = "add";
        $languages = Language::all();
        return view('admin.website_extra_localization.add', compact('page', 'languages'));
    }

    public function store(Request $request)
    {
        $det = json_encode($request->all());
        $Affected = WebLangDetail::create([
            'language_id' => $request->language,
            'detail' => $det
        ]);
        if ($Affected) {
            return redirect()->route('website_extra_localization')->with('success-message', 'WebLangDetail added successfully');
        } else {
            return redirect()->route('website_extra_localization')->with('error-message', 'An unhandled error occurred');
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
            $fetch_data = WebLangDetail::with(['Language'])
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = WebLangDetail::with(['Language'])
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        } else {
            $fetch_data = WebLangDetail::with(['Language'])
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('detail', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->offset($start)
                ->limit($limit)
                ->get();
            $recordsTotal = sizeof($fetch_data);
            $recordsFiltered = WebLangDetail::with(['Language'])
                ->where(function ($query) use ($searchTerm) {
                    $query->orWhere('detail', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orderBy($columnName, $columnSortOrder)
                ->count();
        }

        $data = array();
        $SrNo = $start + 1;
        foreach ($fetch_data as $row => $item) {
            $sub_array = array();
            $sub_array['id'] = $SrNo;
            $sub_array['name'] = $item->Language->name;
            $sub_array['detail'] = wordwrap($item->detail,30,"<br>\n");
            $sub_array['action'] = '<span><i id="delete||' . $item->id . '" onclick="deleteWebLangDetail(this.id);" class="fas fa-trash-alt fs-5 ml-2 text-danger cursor-pointer"></i></span>';
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
        $color = WebLangDetail::where('id', $id)->First();
        $WebsiteExtraLocalizations = WebLangDetail::all();
        return view('admin.website_extra_localization.edit', compact('page', 'color', 'WebsiteExtraLocalizations'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:web_lang_details,name,' . $request['id'] . ',id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $Affected = WebLangDetail::where('id', $request['id'])
                ->update([
                    'name' => $request['name'],
                    'updated_at' => Carbon::now()
                ]);
            if ($Affected) {
                return redirect()->route('website_extra_localization')->with('success-message', 'WebLangDetail updated successfully');
            } else {
                return redirect()->route('website_extra_localization')->with('error-message', 'An unhandled error occurred');
            }
        }
    }

    public function delete(Request $request)
    {
        $Affected = WebLangDetail::where('id', $request['id'])->delete();
        if ($Affected) {
            return redirect()->route('website_extra_localization')->with('success-message', 'WebLangDetail deleted successfully');
        } else {
            return redirect()->route('website_extra_localization')->with('error-message', 'An unhandled error occurred');
        }
    }
}
