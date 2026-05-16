<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParliamentaryBodiesExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private readonly Collection $items)
    {
    }

    public function collection(): Collection
    {
        return $this->items;
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Slug', 'Brief', 'Status', 'Created At'];
    }

    public function map($item): array
    {
        return [
            $item->id,
            $item->name,
            $item->slug,
            strip_tags((string) $item->brief),
            $item->status ? 'active' : 'inactive',
            optional($item->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
