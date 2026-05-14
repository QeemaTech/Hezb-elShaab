<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAdmins()
    {
        return User::where('role', 'admin')->latest()->get();
    }
    public function getPendingMembers()
    {
        return User::hasMemberStatus('pending')->latest()->get();
    }

    public function getRejectedMembers()
    {
        return User::hasMemberStatus('rejected')->latest()->get();
    }

    public function getActiveMembers()
    {
        return User::hasMemberStatus('active')->latest()->get();
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
