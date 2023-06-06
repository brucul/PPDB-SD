<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Registration\StudentRequest;
use App\Http\Requests\Registration\ParentRequest;
use App\Http\Requests\Registration\GuardianRequest;
use App\Http\Requests\Registration\DocumentRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use DB;

class RegistrationController extends Controller
{
    public function zonasi()
    {
        ((date('Y-m-d') >= getSetting()->start_date) && (date('Y-m-d') <= getSetting()->end_date)) ?: abort(419);

        return view('frontend.registration.index');
    }

    public function prestasi()
    {
        ((date('Y-m-d') >= getSetting()->start_date) && (date('Y-m-d') <= getSetting()->end_date)) ?: abort(419);

        return view('frontend.registration.index');
    }

    public function store(StudentRequest $student_request, ParentRequest $parent_request, GuardianRequest $guardian_request, DocumentRequest $doc_request)
    {
        DB::beginTransaction();
        try {
            $student = Student::create($student_request->validated());

            if ($student) {
                for ($i=1; $i <= 2; $i++) { 
                    $student->parents()->create([
                        'type'              => $i,
                        'name'              => $parent_request['name_'.$i],
                        'pob'               => $parent_request['pob_'.$i],
                        'dob'               => $parent_request['dob_'.$i],
                        'religion'          => $parent_request['religion_'.$i],
                        'last_education'    => $parent_request['last_education_'.$i],
                        'job'               => $parent_request['job_'.$i],
                        'monthly_income'    => $parent_request['monthly_income_'.$i],
                        'citizenship'       => $parent_request['citizenship_'.$i],
                        'phone'             => $parent_request['phone_'.$i],
                        'address'           => $parent_request['address_'.$i],
                        'is_alive'          => $parent_request['is_alive_'.$i],
                    ]);
                }

                if (!$parent_request->is_alive_1 && !$parent_request->is_alive_2) {
                    $student->parents()->create([
                        'type'              => 3,
                        'name'              => $guardian_request->name_3,
                        'pob'               => $guardian_request->pob_3,
                        'dob'               => $guardian_request->dob_3,
                        'religion'          => $guardian_request->religion_3,
                        'last_education'    => $guardian_request->last_education_3,
                        'job'               => $guardian_request->job_3,
                        'monthly_income'    => $guardian_request->monthly_income_3,
                        'citizenship'       => $guardian_request->citizenship_3,
                        'phone'             => $guardian_request->phone_3,
                        'address'           => $guardian_request->address_3,
                        'relationship'      => $guardian_request->relationship_3,
                        'is_alive'          => 1,
                    ]);
                }

                $docs = $doc_request->validated();
                foreach ($docs as $key => $value) {
                    if ($doc_request->file($key)) {
                        $file = $doc_request->file($key);
                        if (is_array($file)) {
                            for ($i=0; $i < count($file); $i++) { 
                                if ($file[$i]) {
                                    $doc_name = str_slug($doc_request->certificate_name[$i]).'-'.time().".".$file[$i]->extension();
                                    $file[$i]->storeAs('public/documents/'.$student->id.'/', $doc_name);
                                    $student->otherDocuments()->create([
                                        'name' => $doc_request->certificate_name[$i],
                                        'file' => $doc_name,
                                    ]);
                                }
                            }
                        } else {
                            $doc_name = $key.'-'.time().".".$file->extension();
                            $file->storeAs('public/documents/'.$student->id.'/', $doc_name);
                            $documents[$key] = $doc_name;
                        }
                    }
                }

                $student->document()->create($documents);
                activity('registration')->causedBy($student)->withProperties(['user_agent' => $request->header('User-Agent')])->log('student registration');
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Pendaftaran berhasil, silakan cek status pendaftaran Anda.',
                    'data' => $student,
                ]);
            }
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'errors' => ['Oops, something bad happened!'],
            ], 500);
        }
    }

    public function search(Request $request)
    {
        $student = Student::where('registration_number', $request->registration_number)->first();

        if ($student) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $student,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Nomor pendaftaran tidak ditemukan',
        ]);
    }

    public function show($id)
    {
        $student = Student::where('registration_number', $id)->first();

        if ($student) {
            return view('frontend.registration.show', compact('student'));
        } else {
            abort(404);
        }

    }
}
