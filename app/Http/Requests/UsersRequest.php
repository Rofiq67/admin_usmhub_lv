<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'username' => 'required|string|min:6|unique:users',
            'email' => 'required|email|unique:users',
            'img_profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|min:6',
            'tgl_lahir' => 'nullable|date',
            'progdi' => 'nullable|string',
            'gender' => 'nullable|string|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
        ];
    }
}
