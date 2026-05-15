<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DistrictRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $districtId = $this->route('district')?->id;

        return [
            'governorate_id' => ['required', 'exists:governorates,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('districts', 'name')
                    ->where(fn($query) => $query->where('governorate_id', $this->input('governorate_id')))
                    ->ignore($districtId),
            ],
            'status' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
