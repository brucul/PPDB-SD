<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GuardianRequest extends FormRequest
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
            'name_3'            => 'nullable',
            'pob_3'             => 'nullable',
            'dob_3'             => 'nullable',
            'religion_3'        => 'nullable',
            'last_education_3'  => 'nullable',
            'job_3'             => 'nullable',
            'monthly_income_3'  => 'nullable',
            'citizenship_3'     => 'nullable',
            'phone_3'           => 'nullable|min:8',
            'address_3'         => 'nullable',
            'relationship_3'    => 'nullable',
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
            'name_3'            => 'Nama Ayah',
            'pob_3'             => 'Tempat Lahir',
            'dob_3'             => 'Tanggal Lahir',
            'religion_3'        => 'Agama',
            'last_education_3'  => 'Ijazah Tertinggi',
            'job_3'             => 'Pekerjaan',
            'monthly_income_3'  => 'Penghasilan per Bulan',
            'citizenship_3'     => 'Kewarganegaraan',
            'phone_3'           => 'No. Telepon (HP)',
            'address_3'         => 'Alamat',
            'relationship_3'    => 'Hubungan Keluarga',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'monthly_income_3' => str_replace('.', '', $this->monthly_income_3),
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
            'step' => 3,
            'message' => 'Oops, Something bad happened.',
            'errors' => $errors,
        ]));
    }
}
