<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateBorrow extends FormRequest
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
            'buku_id' => 'required|numeric|exists:books,id',
            'peminjam_id' => 'required|numeric|exists:anggotas,id',
            'tanggal_pinjam' => 'required|date',
        ];
    }
}
