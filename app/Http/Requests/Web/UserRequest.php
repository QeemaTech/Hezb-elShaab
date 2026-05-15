<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('user')?->id;

        return [
            'name'      => ['required', 'string', 'max:255'],
            'national_id' => ['nullable', 'string', 'max:14', 'unique:users,national_id,' . $userId],
            'email'     => ['required', 'email', 'max:255', 'unique:users,email,' . $userId],
            'phone'     => ['nullable', 'string', 'max:20', 'unique:users,phone,' . $userId],
            'password'  => [$this->isMethod('post') ? 'required' : 'nullable', 'string', 'min:8'],
            'status'    => ['required', 'boolean'],
            'role'      => ['required', 'in:user,admin'],
            'image'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
