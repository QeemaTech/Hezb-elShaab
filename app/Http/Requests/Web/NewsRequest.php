<?php
namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'        => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'description'  => 'nullable|string',
            'status'       => 'boolean',
            'read_minutes' => 'required|numeric|min:0'
        ];
    }
}
