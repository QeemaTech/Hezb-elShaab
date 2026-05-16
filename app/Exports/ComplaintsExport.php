<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ComplaintsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private readonly Collection $complaints)
    {
    }

    public function collection(): Collection
    {
        return $this->complaints;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Status',
            'Source',
            'Description',
            'Created At',
            'Updated At',
        ];
    }

    public function map($complaint): array
    {
        return [
            $complaint->id,
            $complaint->name,
            $complaint->email,
            $complaint->phone,
            $complaint->status,
            $complaint->source,
            $complaint->description,
            optional($complaint->created_at)->format('Y-m-d H:i:s'),
            optional($complaint->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
