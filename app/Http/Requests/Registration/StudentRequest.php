<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StudentRequest extends FormRequest
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
            'type'                  => 'required',
            'registration_number'   => 'nullable',
            'fullname'              => 'required',
            'nickname'              => 'required',
            'gender'                => 'required',
            'pob'                   => 'required',
            'dob'                   => 'required',
            'religion'              => 'required',
            'citizenship'           => 'required',
            'birth_order'           => 'required|integer',
            'total_sibling'         => 'nullable|integer',
            'total_step_sibling'    => 'nullable|integer',
            'total_foster_sibling'  => 'nullable|integer',
            'blood_type'            => 'nullable',
            'language'              => 'required',
            'address'               => 'required',
            'phone'                 => 'required|integer',
            'residence'             => 'required',
            'distance_in_meters'    => 'required|integer',
            'distance_in_minutes'   => 'required|integer',
            'transportation'        => 'required',
            'weight_in_kg'          => 'nullable|integer',
            'height_in_cm'          => 'nullable|integer',
            'disease_history'       => 'nullable',
            'kindergarten_name'     => 'nullable',
            'kindergarten_address'  => 'nullable',
            'certificate_number'    => 'nullable',
            'long_study'            => 'nullable|integer',
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
            'name'                  => 'Nama',
            'fullname'              => 'Nama Lengkap',
            'nickname'              => 'Nama Panggilan',
            'dob'                   => 'Tanggal Lahir',
            'pob'                   => 'Tempat Lahir',
            'job'                   => 'Pekerjaan',
            'monthly_income'        => 'Penghasilan per Bulan',
            'gender'                => 'Jenis Kelamin',
            'religion'              => 'Agama',
            'citizenship'           => 'Kewarganegaraan',
            'birth_order'           => 'Anak Keberapa',
            'total_sibling'         => 'Jummlah Saudara Kandung',
            'total_step_sibling'    => 'Jummlah Saudara Tiri',
            'total_foster_sibling'  => 'Jummlah Saudara Angkat',
            'blood_type'            => 'Golongan Darah',
            'language'              => 'Bahasa',
            'address'               => 'Alamat',
            'phone'                 => 'No. Telepon (HP)',
            'residence'             => 'Tempat Tinggal',
            'distance_in_meters'    => 'Jarak',
            'distance_in_minutes'   => 'Waktu Tempuh',
            'transportation'        => 'Transportasi',
            'weight_in_kg'          => 'Berat Badan',
            'height_in_cm'          => 'Tinggi Badan',
            'disease_history'       => 'Riwayat Penyakit',
            'kindergarten_name'     => 'Nama TK',
            'kindergarten_address'  => 'Alamat TK',
            'certificate_number'    => 'Ijazah TK',
            'long_study'            => 'Lama Belajar',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
           'registration_number' => time(),
           'disease_history' => $this->disease_history ? implode(',', $this->disease_history) : '',
        ]);
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
            'step' => 1,
            'message' => 'Oops, Something bad happened.',
            'errors' => $errors,
        ]));
    }
}
