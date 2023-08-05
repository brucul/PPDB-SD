<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function json(Request $request) {
        $data = ActivityLog::query();

        $limit = ($request->iDisplayLength) ? $request->iDisplayLength : $data->count();
        $start = ($request->iDisplayStart) ? $request->iDisplayStart : 0;

        if(isset($start) && $limit != '-1') {
            $data = $data->skip($start)->take($limit);
        }

        return datatables()->of($data)
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d F Y - H:i:s');
            })
            ->editColumn('causer', function ($row) {
                return $row->causer->name ?? null;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make();
    }

    public function index()
    {
        $title = "Activity Log";
        $sub_title = '
            <div class="breadcrumb-item">List Activity Log</div>
        ';
        
        return view('backend.activity.index', compact('title', 'sub_title'));
    }
}
