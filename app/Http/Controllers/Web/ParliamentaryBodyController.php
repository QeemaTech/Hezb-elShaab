<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ParliamentaryBodyRequest;
use App\Models\ParliamentaryBody;
use App\Services\ParliamentaryBodyService;

class ParliamentaryBodyController extends Controller
{
    protected $service;

    public function __construct(ParliamentaryBodyService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $parliamentaryBodies = $this->service->getAllParliamentaryBodies();
        $breadcrumbs = [
            ['name' => __('messages.parliamentary_bodies'), 'url' => route('admin.parliamentary-bodies.index')],
        ];

        return view('admin.parliamentary-bodies.index', compact('parliamentaryBodies', 'breadcrumbs'));
    }

    public function show($slug)
    {
        $parliamentaryBody = $this->service->getParliamentaryBodyBySlug($slug);
        $breadcrumbs = [
            ['name' => __('messages.parliamentary_bodies'), 'url' => route('admin.parliamentary-bodies.index')],
            ['name' => __('messages.show'), 'url' => null],
        ];

        return view('admin.parliamentary-bodies.show', compact('parliamentaryBody', 'breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['name' => __('messages.parliamentary_bodies'), 'url' => route('admin.parliamentary-bodies.index')],
            ['name' => __('messages.create'), 'url' => null],
        ];

        return view('admin.parliamentary-bodies.create', compact('breadcrumbs'));
    }

    public function store(ParliamentaryBodyRequest $request)
    {
        $this->service->createParliamentaryBody($request->validated() + [
            'image' => $request->file('image'),
        ]);

        return redirect()->route('admin.parliamentary-bodies.index')->with('success', 'Parliamentary body created!');
    }

    public function edit($slug)
    {
        $parliamentaryBody = $this->service->getParliamentaryBodyBySlug($slug);
        $breadcrumbs = [
            ['name' => __('messages.parliamentary_bodies'), 'url' => route('admin.parliamentary-bodies.index')],
            ['name' => __('messages.update'), 'url' => null],
        ];

        return view('admin.parliamentary-bodies.edit', compact('parliamentaryBody', 'breadcrumbs'));
    }

    public function update(ParliamentaryBodyRequest $request, ParliamentaryBody $parliamentary_body)
    {
        $this->service->updateParliamentaryBody($parliamentary_body, $request->validated() + [
            'image' => $request->file('image'),
        ]);

        return redirect()->route('admin.parliamentary-bodies.index')->with('success', 'Parliamentary body updated!');
    }

    public function destroy($slug)
    {
        $parliamentaryBody = $this->service->getParliamentaryBodyBySlug($slug);

        if ($parliamentaryBody) {
            $parliamentaryBody->delete();
            return response()->json(['success' => true]);
        }

        $this->service->deleteParliamentaryBody($parliamentaryBody);
        return response()->json(['success' => false], 404);
    }
}
