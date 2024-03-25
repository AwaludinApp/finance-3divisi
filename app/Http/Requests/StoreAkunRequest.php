<?php

namespace App\Http\Requests;

use App\Models\Akun;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAkunRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (in_array(Auth::user()->role, [1])) {
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
        $exists = Akun::where('kode_akun', $this->kode_akun)
            ->where('is_deleted', 1)
            ->exists();

        if ($exists) {
            return [
                //
                'kode_akun' => 'required',
                'nama_akun' => 'required',
                'level' => 'required',
                'parent_id' => 'required'
            ];

        } else {

            return [
                //
                'kode_akun' => 'required|unique:App\Models\Akun,kode_akun',
                'nama_akun' => 'required',
                'level' => 'required',
                'parent_id' => 'required'
            ];
        }
    }

    public function messages(): array
    {
        $exists = Akun::where('kode_akun', $this->kode_akun)
            ->where('is_deleted', 1)
            ->exists();

        if ($exists) {
            return [
                'kode_akun.required' => 'Kode Akun tidak boleh kosong',
                'nama_akun.required' => 'Akun tidak boleh kosong',
            ];
        } else {
            $akun = Akun::where('kode_akun', $this->kode_akun)->first();

            if ($akun != null) {
                return [
                    'kode_akun.required' => 'Kode Akun tidak boleh kosong',
                    'nama_akun.required' => 'Akun tidak boleh kosong',
                    'kode_akun.unique' => 'Kode Akun <strong>' . $this->kode_akun . '</strong> telah digunakan oleh <strong>' . $akun->nama_akun . '</strong>',
                ];
            } else {
                return [
                    'kode_akun.required' => 'Kode Akun tidak boleh kosong',
                    'nama_akun.required' => 'Akun tidak boleh kosong',
                    'kode_akun.unique' => 'Kode Akun telah digunakan oleh',
                ];
            }
        }
    }
}
