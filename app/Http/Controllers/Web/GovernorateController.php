<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\GovernorateRequest;
use App\Models\Governorate;

class GovernorateController extends Controller
{
    public function index()
    {
        $query = Governorate::query();

        if ($name = request('name')) {
            $query->where('name', 'like', "%{$name}%");
        }

        if (request()->filled('status')) {
            $query->where('status', (bool) request('status'));
        }

        $governorates = $query->orderBy('sort_order')->orderBy('name')->paginate(20)->withQueryString();

        return view('admin.governorates.index', compact('governorates'));
    }

        public function show(Governorate $governorate)
    {
        $governorate->load(['districts.localUnits.partyUnits']);

        return view('admin.governorates.show', compact('governorate'));
    }

    public function create()
    {
        return view('admin.governorates.create');
    }

    public function store(GovernorateRequest $request)
    {
        Governorate::create($request->validated() + ['status' => (bool) $request->boolean('status')]);

        return redirect()->route('admin.governorates.index')->with('success', __('messages.created_successfully'));
    }

    public function edit(Governorate $governorate)
    {
        return view('admin.governorates.edit', compact('governorate'));
    }

    public function update(GovernorateRequest $request, Governorate $governorate)
    {
        $governorate->update($request->validated() + ['status' => (bool) $request->boolean('status')]);

        return redirect()->route('admin.governorates.index')->with('success', __('messages.updated_successfully'));
    }

    public function destroy(Governorate $governorate)
    {
        $governorate->delete();

        return response()->json(['success' => true, 'message' => __('messages.deleted_successfully')]);
    }
}

