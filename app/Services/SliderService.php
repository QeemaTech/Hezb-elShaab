<?php

namespace App\Services;

use App\Repositories\SliderRepository;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    protected $sliderRepo;

    public function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepo = $sliderRepo;
    }

    public function getAllSliders()
    {
        return $this->sliderRepo->getAll();
    }

    public function find($id){
        return $this->sliderRepo->find($id);
    }

    public function createSlider(array $data)
    {
        // Store image if uploaded
        if (isset($data['image']) && $data['image']->isValid()) {
            $data['path'] = $data['image']->store('slider/images', 'public');
        }

        // Create the event
        return $this->sliderRepo->create($data);
    }

    public function deleteSlider(Slider $event)
    {
        return $this->sliderRepo->delete($event);
    }

    public function index(){
        $limit =  request()->input('limit', 15);
        return $this->sliderRepo->index($limit);
    }

}
