<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\AppSetting;
use App\Services\SliderService;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    protected $slidersService;

    public function __construct(SliderService $slidersService)
    {
        $this->slidersService = $slidersService;
    }
    public function index(){
        $settings = AppSetting::pluck('value', 'key');

        $banner_image   = $settings['banner_image'] ?? null;
        $show_elections = isset($settings['show_elections']) ? (bool) $settings['show_elections'] : false;
        return response()->json([
            'banner_image' => asset($banner_image),
            'show_elections' => $show_elections,
        ]);
    }

}
