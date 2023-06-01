<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'birth_certificate'         => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:2048',
            'family_certificate'        => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:2048',
            'kindergarten_certificate'  => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf|max:2048',
            'kia'                       => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:2048',
            'kip'                       => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf|max:2048',
            'kps'                       => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf|max:2048',
            'bpjs'                      => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf|max:2048',
            'father_id'                 => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:2048',
            'mother_id'                 => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:2048',
            'student_image'             => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:2048',
            'certificate_name'          => 'nullable|array',
            'certificate_file'          => 'array',
            'certificate_file.*'        => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf|max:2048',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'birth_certificate'         => 'Akta Kelahiran',
            'family_certificate'        => 'Kartu Keluarga',
            'kindergarten_certificate'  => 'Ijazah TK/PAUD',
            'kia'                       => 'Kartu Identitas Anak',
            'kip'                       => 'Kartu Indonesia Pintar',
            'kps'                       => 'Kartu Perlindungan Sosial',
            'bpjs'                      => 'BPJS',
            'father_id'                 => 'KTP Ayah',
            'mother_id'                 => 'KTP Ibu',
            'student_image'             => 'Pas Foto Siswa',
            'certificate_name.*'        => 'Nama Sertifikat',
            'certificate_file.*'        => 'File Sertifikat',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
    }

    /**
    * Get the error messages for the defined validation rules.*
    * @return array
    */
    protected function failedValidation(Validator $validator)
    {
        $input = array_fill_keys(array_keys($this->rules()), null);
        $errors = array_merge($input, $validator->errors()->toArray());

        throw new HttpResponseException(response()->json([
            'status' => false,
            'step' => 4,
            'message' => 'Oops, Something bad happened.',
            'errors' => $errors,
        ]));
    }
}
