<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use ZipArchive;
use Storage;

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
            ->editColumn('type', function ($row) {
                return $row->type == 1 ? 'Zonasi' : 'Prestasi';
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

        if ($request->status == 1) {
            $badge = '<span class="badge badge-success">Lolos</span>';
            $count_student = Student::where('type', $student->type)->where('status', 1)->whereYear('created_at', substr(getSetting()->school_year, 0, 4))->count();
            switch ($student->type) {
                case '1':
                    $quota = getSetting()->zonasi_quota;
                    break;
                
                default:
                    $quota = getSetting()->prestasi_quota;
                    break;
            }
            if ($count_student >= $quota) {
                return response()->json([
                    'status' => false,
                    'message' => 'Kuota '.($student->type == 1 ? 'Zonasi' : 'Prestasi').' Penuh',
                ], 422);
            }
        } else {
            $badge = '<span class="badge badge-danger">Tidak Lolos</span>';
        }

        $update = $student->update(['status' => $request->status]);
        if ($update) {
            activity('update')->performedOn($student)->withProperties(['user_agent' => $request->header('User-Agent')])->log('update status siswa ke '.($request->status == 1 ? 'lolos' : 'tidak lolos'));
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

    public function makeZip(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $id = $request->id;
        $student = Student::find($id);
        $zip = new ZipArchive();
        $dir = public_path('storage/documents/'.$id);
        // make_directory($dir);
        $zip_name = $student->registration_number.'.zip';

        if (Storage::disk('public')->missing('documents/'.$zip_name)) {
            view()->share('student',$student);
            $pdf = Pdf::loadView('pdf.student');
            $pdf_name = 'FORM-'.$student->registration_number.'.pdf';
            $pdf->save($dir.'/'.$pdf_name);

            if ($zip->open(public_path('storage/documents/').$zip_name, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
                $path = storage_path('app/public/documents/'.$id);
                
                $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
                foreach ($files as $name => $file)
                {
                    // We're skipping all subfolders
                    if (!$file->isDir()) {
                        $filePath     = $file->getRealPath();

                        // extracting filename with substr/strlen
                        $relativePath = 'documents/' . substr($filePath, strlen($path) + 1);

                        $zip->addFile($filePath, $relativePath);
                    }
                }
            }
            $zip->close();
        }

        return response()->json([
            'status' => true,
            'message' => 'Download Success',
            'download_url' => route('be.ppdb.download', $student->registration_number),
        ]);
    }

    public function download($file)
    {
        return Storage::disk('public')->download('documents/'.$file.'.zip');
    }
}
