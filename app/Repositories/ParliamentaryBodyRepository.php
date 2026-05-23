<?php

namespace App\Repositories;

use App\Models\ParliamentaryBody;

class ParliamentaryBodyRepository
{
    public function getAll()
    {
        return ParliamentaryBody::latest()->get();
    }

    public function findBySlug(string $slug)
    {
        return ParliamentaryBody::where('slug', $slug)->firstOrFail();
    }

    public function create(array $data)
    {
        return ParliamentaryBody::create($data);
    }

    public function update(ParliamentaryBody $item, array $data)
    {
        $item->update($data);
        return $item;
    }

    public function delete(ParliamentaryBody $item)
    {
        return $item->delete();
    }

    public function index($limit)
    {
        return ParliamentaryBody::where('status', '1')->latest()->paginate($limit);
    }
}
