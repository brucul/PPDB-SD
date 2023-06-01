<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use ZipArchive;

class RegistrationController extends Controller
{
    public function json() {
        $data = Student::latest();

        return datatables()->of($data)
            ->addColumn(
                'action',
                function ($row) {
                    $btn = '
                        <a href="'.route('be.ppdb.show', $row->id).'" class="btn btn-info btn-edit">Detail</a> 
                    ';
                    return $btn;
                }
            )
            ->editColumn('status', function ($row) {
                switch ($row->status) {
                    case '1':
                        return '<span class="badge badge-success">Lulus</span>';
                        break;

                    case '2':
                        return '<span class="badge badge-danger">Tidak Lolos</span>';
                        break;
                    
                    default:
                        return '<span class="badge badge-warning">Ditinjau</span>';
                        break;
                }
            })
            ->editColumn('gender', function ($row) {
                return $row->gender == 1 ? 'Laki-laki' : 'Perempuan';
            })
            ->editColumn('dob', function ($row) {
                return $row->pob.', '.$row->dob->format('d F Y');
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d F Y - H:i:s');
            })
            ->rawColumns(['status', 'action'])
            ->addIndexColumn()
            ->make();
    }

    public function index()
    {
        $title = "Calon Peserta Didik Baru";
        $sub_title = '
            <div class="breadcrumb-item">List Calon Peserta Didik Baru</div>
        ';
        
        return view('backend.ppdb.index', compact('title', 'sub_title'));
    }

    public function show($id)
    {
        $title = "Calon Peserta Didik Baru";
        $sub_title = '
            <div class="breadcrumb-item"><a href="'.route('be.ppdb.index').'">List Calon Peserta Didik Baru</a></div>
            <div class="breadcrumb-item">Detail</div>
        ';

        $student = Student::findOrFail($id);
        
        return view('backend.ppdb.show', compact('title', 'sub_title', 'student'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $student = Student::find($request->id);
        $update = $student->update(['status' => $request->status]);

        if ($request->status == 1) {
            $badge = '<span class="badge badge-success">Lolos</span>';
        } else {
            $badge = '<span class="badge badge-danger">Tidak Lolos</span>';
        }

        if ($update) {
            return response()->json([
                'status' => true,
                'message' => 'Data Updated',
                'badge' => $badge,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed Update',
            ], 422);
        }
    }

    public function download(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $id = $request->id;

        $student = Student::find(1);
        view()->share('student',$student);
        return view('pdf.student');
        $pdf = Pdf::loadView('pdf.student');
        $fileName = $student->registration_number.'.pdf';
        return $pdf->download($fileName);
    }
}
