<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(
        private readonly Collection $users,
        private readonly string $type
    ) {
    }

    public function collection(): Collection
    {
        return $this->users;
    }

    public function headings(): array
    {
        return [
            'ID',
            'UUID',
            'Type',
            'Name',
            'Email',
            'Phone',
            'Role',
            'Governorate',
            'National ID',

            'Member Status',
            'Account Status',
            'Created At',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->uuid,
            $this->type,
            $user->name,
            $user->email,
            $user->phone,
            $user->roles->first()?->name ?? $user->role,
            $user->governorate?->name,
            $user->national_id,
            $user->member_status,
            $user->status ? 'active' : 'inactive',
            optional($user->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
