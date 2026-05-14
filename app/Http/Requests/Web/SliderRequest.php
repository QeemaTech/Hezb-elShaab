<?php
namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SliderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $sliderId = $this->route('slider')?->id ?? $this->route('slider');

        return [
            'image'        => $this->isMethod('post')
                ? 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
                : 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'sort_order'   => [
                'required',
                'integer',
                'min:1',
                Rule::unique('sliders', 'sort_order')->ignore($sliderId),
            ],
        ];
    }
}
