<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\DistrictRequest;
use App\Models\District;
use App\Models\Governorate;

class DistrictController extends Controller
{
    public function index()
    {
        $query = District::with('governorate');

        if ($name = request('name')) {
            $query->where('name', 'like', "%{$name}%");
        }

        if ($governorateId = request('governorate_id')) {
            $query->where('governorate_id', $governorateId);
        }

        if (request()->filled('status')) {
            $query->where('status', (bool) request('status'));
        }

        $districts = $query->orderBy('sort_order')->orderBy('name')->paginate(20)->withQueryString();
        $governorates = Governorate::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.districts.index', compact('districts', 'governorates'));
    }

        public function show(District $district)
    {
        $district->load(['governorate', 'localUnits.partyUnits']);

        return view('admin.districts.show', compact('district'));
    }

    public function create()
    {
        $governorates = Governorate::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.districts.create', compact('governorates'));
    }

    public function store(DistrictRequest $request)
    {
        District::create($request->validated() + ['status' => (bool) $request->boolean('status')]);

        return redirect()->route('admin.districts.index')->with('success', __('messages.created_successfully'));
    }

    public function edit(District $district)
    {
        $governorates = Governorate::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.districts.edit', compact('district', 'governorates'));
    }

    public function update(DistrictRequest $request, District $district)
    {
        $district->update($request->validated() + ['status' => (bool) $request->boolean('status')]);

        return redirect()->route('admin.districts.index')->with('success', __('messages.updated_successfully'));
    }

    public function destroy(District $district)
    {
        $district->delete();

        return response()->json(['success' => true, 'message' => __('messages.deleted_successfully')]);
    }
}

