<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private readonly Collection $events)
    {
    }

    public function collection(): Collection
    {
        return $this->events;
    }

    public function headings(): array
    {
        return [
            'ID', 'Title', 'Slug', 'Date', 'Status', 'Privacy', 'Created By', 'Created By Email',
            'Organizers Count', 'Sponsors Count', 'Allowed Users Count', 'Address', 'Created At'
        ];
    }

    public function map($event): array
    {
        return [
            $event->id,
            $event->title,
            $event->slug,
            optional($event->date)->format('Y-m-d H:i:s'),
            $event->status ? 'active' : 'inactive',
            $event->is_private ? 'private' : 'public',
            $event->user?->name,
            $event->user?->email,
            $event->organizers_count,
            $event->sponsors_count,
            $event->allowed_users_count,
            $event->address,
            optional($event->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
