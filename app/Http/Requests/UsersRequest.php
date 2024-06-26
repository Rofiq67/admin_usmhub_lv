<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->user()->id,
            'img_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tgl_lahir' => 'nullable|date',
        ];
    }
}
