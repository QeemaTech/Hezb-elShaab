<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Services\SliderService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $slidersService;

    public function __construct(SliderService $slidersService)
    {
        $this->slidersService = $slidersService;
    }
    public function index(){
        return  SliderResource::collection($this->slidersService->index());
    }

}
