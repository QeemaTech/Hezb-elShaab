<?php

namespace App\Repositories;

use App\Models\Slider;

class SliderRepository
{
    public function getAll()
    {
        return Slider::latest()->get();
    }

    public function create(array $data)
    {
        return Slider::create($data);
    }

    public function delete(Slider $event)
    {
        return $event->delete();
    }

    public function index($limit)
    {
        return Slider::paginate($limit);
    }


    public function find($id)
    {
        return Slider::find($id);
    }

}
