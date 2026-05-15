<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PartyUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $partyUnitId = $this->route('party_unit')?->id;

        return [
            'local_unit_id' => ['required', 'exists:local_units,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('party_units', 'name')
                    ->where(fn($query) => $query->where('local_unit_id', $this->input('local_unit_id')))
                    ->ignore($partyUnitId),
            ],
            'status' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
