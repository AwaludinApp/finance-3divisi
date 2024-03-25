<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTransaksiBukuKecilRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (in_array(Auth::user()->role, [1, 3])) {
            return true;
        }
        
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'tanggal_transaksi' => 'required',
            'akun_id' => 'required',
            'tipe' => 'required',
            'nilai' => 'required',
            'keterangan' => 'nullable'
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal_transaksi.required' => 'Tanggal Transaksi tidak boleh kosong',
            'nilai.required' => 'Nilai Transaksi tidak boleh kosong',
            'akun_id.required' => 'Akun tidak boleh kosong'
        ];
    }
}
