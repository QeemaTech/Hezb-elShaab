<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventUsersExport implements FromCollection, WithHeadings
{
    public function __construct(private readonly Collection $events)
    {
    }

    public function collection(): Collection
    {
        return $this->events->flatMap(function ($event) {
            return $event->allowedUsers->map(function ($user) use ($event) {
                return [
                    $event->id,
                    $event->title,
                    $event->is_private ? 'private' : 'public',
                    $user->id,
                    $user->uuid,
                    $user->name,
                    $user->phone,
                    $user->email,
                ];
            });
        })->values();
    }

    public function headings(): array
    {
        return [
            'Event ID', 'Event Title', 'Event Privacy', 'User ID', 'User UUID', 'User Name', 'User Phone', 'User Email'
        ];
    }
}
