<?php

namespace App\Repositories;

use App\Models\Slider;

class SliderRepository
{
    public function getAll()
    {
        return Slider::orderBy('sort_order')->orderByDesc('id')->get();
    }

    public function create(array $data)
    {
        return Slider::create($data);
    }

    public function update(Slider $slider, array $data)
    {
        $slider->update($data);
        return $slider;
    }

    public function delete(Slider $event)
    {
        return $event->delete();
    }

    public function index($limit)
    {
        return Slider::orderBy('sort_order')->orderByDesc('id')->paginate($limit);
    }


    public function find($id)
    {
        return Slider::find($id);
    }

}
