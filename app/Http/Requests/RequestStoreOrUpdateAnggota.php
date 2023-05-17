<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateAnggota extends FormRequest
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
        $rules =  [
            'nis' => 'required|numeric|',
            'nama_anggota' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|digits_between:10,12',
            'tgl_lahir' => 'required|date|before:today',
        ];

        if($this->isMethod('POST')){
            $rules['nis'] .= '|unique:anggotas,nis';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'nama_anggota.required' => 'Nama Anggota harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'no_telp.required' => 'No. Telp harus diisi',
            'tgl_lahir.required' => 'Tanggal Lahir harus diisi',
            'tgl_lahir.before' => 'Tanggal Lahir harus sebelum hari ini',
            'no_telp.digits_between' => 'No. Telp harus berupa angka dan 10-12 digit',
            'tgl_lair.date' => 'Tanggal Lahir harus berupa tanggal',
            'nis.required' => 'NIS harus diisi',
            'nis.unique' => 'NIS sudah terdaftar',
            'nis.numeric' => 'NIS harus berupa angka',
        ];
    }
}
