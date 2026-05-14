<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\User;

class EventRepository
{
    public function getAll()
    {
        return Event::latest()->get();
    }

    public function findBySlug(string $slug)
    {
        return Event::where('slug', $slug)->firstOrFail();
    }

    public function create(array $data)
    {
        return Event::create($data);
    }

    public function update(Event $event, array $data)
    {
        $event->update($data);
        return $event;
    }

    public function delete(Event $event)
    {
        return $event->delete();
    }

    public function index($id,$limit)
    {
        return Event::where(function ($query) use ($id) {
            $query->where('is_private', 0)
              ->orWhereHas('allowedUsers', function ($subQuery) use ($id) {
              $subQuery->where('users.id', $id);
        });
    })
    ->paginate($limit);
    }
    public function find($id)
    {
        return Event::with('sponsors','organizers')->find($id);
    }
    public function removeUser(Event $event, User $user)
    {
        return $event->allowedUsers()->detach($user->id);
    }
}
