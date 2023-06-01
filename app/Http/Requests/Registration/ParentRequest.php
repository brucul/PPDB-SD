<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ParentRequest extends FormRequest
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
            'name_1'            => 'required',
            'pob_1'             => 'required',
            'dob_1'             => 'required',
            'religion_1'        => 'required',
            'last_education_1'  => 'required',
            'job_1'             => 'required',
            'monthly_income_1'  => 'required',
            'citizenship_1'     => 'required',
            'phone_1'           => 'required|min:8',
            'address_1'         => 'required',
            'is_alive_1'        => 'required',
            'name_2'            => 'required',
            'pob_2'             => 'required',
            'dob_2'             => 'required',
            'religion_2'        => 'required',
            'last_education_2'  => 'required',
            'job_2'             => 'required',
            'monthly_income_2'  => 'required',
            'citizenship_2'     => 'required',
            'phone_2'           => 'required|min:8',
            'address_2'         => 'required',
            'is_alive_2'        => 'required',
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
            'name_1'            => 'Nama Ayah',
            'pob_1'             => 'Tempat Lahir',
            'dob_1'             => 'Tanggal Lahir',
            'religion_1'        => 'Agama',
            'last_education_1'  => 'Ijazah Tertinggi',
            'job_1'             => 'Pekerjaan',
            'monthly_income_1'  => 'Penghasilan per Bulan',
            'citizenship_1'     => 'Kewarganegaraan',
            'phone_1'           => 'No. Telepon (HP)',
            'address_1'         => 'Alamat',
            'is_alive_1'        => 'Masih Hidup?',
            'name_2'            => 'Nama Ibu',
            'pob_2'             => 'Tempat Lahir',
            'dob_2'             => 'Tanggal Lahir',
            'religion_2'        => 'Agama',
            'last_education_2'  => 'Ijazah Tertinggi',
            'job_2'             => 'Pekerjaan',
            'monthly_income_2'  => 'Penghasilan per Bulan',
            'citizenship_2'     => 'Kewarganegaraan',
            'phone_2'           => 'No. Telepon (HP)',
            'address_2'         => 'Alamat',
            'is_alive_2'        => 'Masih Hidup?',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'monthly_income_1' => str_replace('.', '', $this->monthly_income_1),
            'monthly_income_2' => str_replace('.', '', $this->monthly_income_2),
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
            'step' => 2,
            'message' => 'Oops, Something bad happened.',
            'errors' => $errors,
        ]));
    }
}
