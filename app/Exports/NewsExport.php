<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NewsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private readonly Collection $news)
    {
    }

    public function collection(): Collection
    {
        return $this->news;
    }

    public function headings(): array
    {
        return ['ID', 'Title', 'Slug', 'Read Minutes', 'Status', 'Created By', 'Created By Email', 'Created At'];
    }

    public function map($item): array
    {
        return [
            $item->id,
            $item->title,
            $item->slug,
            $item->read_minutes,
            $item->status ? 'active' : 'inactive',
            $item->user?->name,
            $item->user?->email,
            optional($item->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
