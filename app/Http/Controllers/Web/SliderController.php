<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SliderRequest;
use App\Models\Slider;
use App\Services\SliderService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $slidersService;

    public function __construct(SliderService $slidersService)
    {
        $this->slidersService = $slidersService;
    }

    public function index()
    {
        $sliders = $this->slidersService->getAllSliders();
        $breadcrumbs = [
            ['name' => __('messages.sliders'), 'url' => route('admin.sliders.index')],
        ];
        return view('admin.sliders.index', compact('sliders', 'breadcrumbs'));
    }


    public function create()
    {
        $breadcrumbs = [
            ['name' => __('messages.sliders'), 'url' => route('admin.sliders.index')],
            ['name' => __('messages.create'), 'url' => null]
        ];
        return view('admin.sliders.create', compact('breadcrumbs'));
    }

    public function store(SliderRequest $request)
    {
        $this->slidersService->createSlider($request->validated() + [
            'image' => $request->file('image'),
        ]);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider created!');
    }

    public function edit($id)
    {
        $slider = $this->slidersService->find($id);
        $breadcrumbs = [
            ['name' => __('messages.sliders'), 'url' => route('admin.sliders.index')],
            ['name' => __('messages.update'), 'url' => null]
        ];
        return view('admin.sliders.edit', compact('slider', 'breadcrumbs'));
    }

    public function update(SliderRequest $request, Slider $slider)
    {
        $this->slidersService->updateSlider($slider, $request->validated() + [
            'image' => $request->file('image'),
        ]);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated!');
    }

    public function destroy($id)
    {
        $sliders =  $this->slidersService->find($id);

        if ($sliders) {
            $sliders->delete();
            return response()->json(['success' => true]);
        }

        $this->slidersService->deleteSlider($sliders);
        return response()->json(['success' => false], 404);
    }
}
