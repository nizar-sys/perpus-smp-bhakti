<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateStockOpname extends FormRequest
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
            'buku_id' => 'required|exists:books,id',
            'keterangan' => 'required|string',
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
            'buku_id.required' => 'Buku harus dipilih.',
            'buku_id.exists' => 'Buku tidak ditemukan.',
            'keterangan.required' => 'Keterangan harus diisi.',
            'keterangan.string' => 'Keterangan harus berupa string.',
        ];
    }
}
