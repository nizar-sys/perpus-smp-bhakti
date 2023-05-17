<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateBook extends FormRequest
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
            'judul_buku' => 'required|string|max:255',
            'nama_pengarang' => 'required|string|max:255',
            'nama_penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|numeric|digits:4',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'judul_buku.required' => 'Judul buku harus diisi.',
            'nama_pengarang.required' => 'Nama pengarang harus diisi.',
            'nama_penerbit.required' => 'Nama penerbit harus diisi.',
            'tahun_terbit.required' => 'Tahun terbit harus diisi.',
            'tahun_terbit.numeric' => 'Tahun terbit harus berupa angka.',
            'tahun_terbit.digits' => 'Tahun terbit harus berupa 4 digit angka.',
        ];
    }
}
