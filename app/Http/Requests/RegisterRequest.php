<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'username' => 'required|string|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:Superadmin,Admin',
            'tgl_lahir' => 'nullable|date',
            'progdi' => 'required|in:Teknik Informatika,Sistem Informasi,Ilmu Komunikasi,Pariwisata,Dekan FTIK',
            'gender' => 'required|in:Laki-laki,Perempuan'
        ];
    }
}
