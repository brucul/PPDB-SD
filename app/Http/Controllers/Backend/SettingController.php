<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $title = "Pengaturan";
        $sub_title = '
            <div class="breadcrumb-item">Pengaturan</div>
        ';

        $setting = Setting::find(1);

        return view('backend.setting.index', compact('title', 'sub_title', 'setting'));
    }

    public function update(Request $request)
    {
        $rules = [
            'school_name' => 'required',
            'school_year' => 'required',
            'school_address' => 'required',
            'zonasi_quota' => 'required|integer',
            'prestasi_quota' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
        $validator = Validator::make($request->all(), $rules);

        $input = array_fill_keys(array_keys($rules), null);
        $errors = array_merge($input, $validator->errors()->toArray());

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $errors,
            ]);
        }

        $setting = Setting::updateOrCreate([
            'id' => 1
        ], [
            'school_name' => $request->school_name,
            'school_year' => $request->school_year,
            'school_address' => $request->school_address,
            'zonasi_quota' => $request->zonasi_quota,
            'prestasi_quota' => $request->prestasi_quota,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Updated',
            'data' => $setting,
        ]);
    }

    public function updateInstruction(Request $request)
    {
        $setting = Setting::updateOrCreate([
            'id' => 1
        ], [
            'instruction' => $request->instruction,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Updated',
            'data' => $setting,
        ]);
    }
}
