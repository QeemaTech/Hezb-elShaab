<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository
{
    public function getAll()
    {
        return News::latest()->get();
    }

    public function findBySlug(string $slug)
    {
        return News::where('slug', $slug)->firstOrFail();
    }

    public function create(array $data)
    {
        return News::create($data);
    }

    public function update(News $event, array $data)
    {
        $event->update($data);
        return $event;
    }

    public function delete(News $event)
    {
        return $event->delete();
    }

    public function index($limit)
    {
        return News::where('status',"1")->paginate($limit);
    }
    public function find($id)
    {
        return News::find($id);
    }
}
