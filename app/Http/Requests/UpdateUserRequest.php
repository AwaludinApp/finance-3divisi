<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->id == 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        if ($this->password != '') {

            return [
                'email' => 'required|email|unique:App\Models\User,email,' . $this->id,
                'password' => 'required|confirmed|min:6',
                'role' => 'required',
                'name' => 'required',
            ];

        } else {
            
            return [
                'email' => 'required|email|unique:App\Models\User,email,' . $this->id,
                'role' => 'required',
                'name' => 'required',
            ];

        }
    }
}
