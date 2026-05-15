<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocalUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $localUnitId = $this->route('local_unit')?->id;

        return [
            'district_id' => ['required', 'exists:districts,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('local_units', 'name')
                    ->where(fn($query) => $query->where('district_id', $this->input('district_id')))
                    ->ignore($localUnitId),
            ],
            'status' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
