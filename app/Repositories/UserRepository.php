<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAdmins(?string $nationalId = null)
    {
        return User::where('role', 'admin')
            ->when($nationalId, function ($query) use ($nationalId) {
                $query->where('national_id', 'like', '%' . $nationalId . '%');
            })
            ->latest()
            ->get();
    }
    public function getPendingMembers()
    {
        return User::hasMemberStatus('pending')->latest()->get();
    }

    public function getRejectedMembers()
    {
        return User::hasMemberStatus('rejected')->latest()->get();
    }

    public function getActiveMembers(?string $nationalId = null, ?string $membershipId = null)
    {
        return User::hasMemberStatus('active')
            ->when($nationalId, function ($query) use ($nationalId) {
                $query->where(function ($innerQuery) use ($nationalId) {
                    $innerQuery->where('national_id', 'like', '%' . $nationalId . '%')
                        ->orWhereHas('member', function ($memberQuery) use ($nationalId) {
                            $memberQuery->where('national_id', 'like', '%' . $nationalId . '%');
                        });
                });
            })
            ->when($membershipId, function ($query) use ($membershipId) {
                $query->whereHas('member', function ($memberQuery) use ($membershipId) {
                    $memberQuery->where('membership_number', 'like', '%' . $membershipId . '%');
                });
            })
            ->latest()
            ->get();
    }

    public function getAll()
    {
        return User::latest()->get();
    }

    public function findByuuid(string $uuid)
    {
        return User::where('uuid', $uuid)->firstOrFail();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(User $event, array $data)
    {
        $event->update($data);
        return $event;
    }

    public function delete(User $event)
    {
        return $event->delete();
    }
}
