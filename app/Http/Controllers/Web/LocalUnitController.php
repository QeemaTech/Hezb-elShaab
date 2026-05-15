<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LocalUnitRequest;
use App\Models\District;
use App\Models\Governorate;
use App\Models\LocalUnit;

class LocalUnitController extends Controller
{
    public function index()
    {
        $query = LocalUnit::with('district.governorate');

        if ($name = request('name')) {
            $query->where('name', 'like', "%{$name}%");
        }

        if ($districtId = request('district_id')) {
            $query->where('district_id', $districtId);
        }

        if ($governorateId = request('governorate_id')) {
            $query->whereHas('district', fn($q) => $q->where('governorate_id', $governorateId));
        }

        if (request()->filled('status')) {
            $query->where('status', (bool) request('status'));
        }

        $localUnits = $query->orderBy('sort_order')->orderBy('name')->paginate(20)->withQueryString();
        $governorates = Governorate::orderBy('sort_order')->orderBy('name')->get();
        $districts = District::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.local-units.index', compact('localUnits', 'governorates', 'districts'));
    }

        public function show(LocalUnit $localUnit)
    {
        $localUnit->load(['district.governorate', 'partyUnits']);

        return view('admin.local-units.show', compact('localUnit'));
    }

    public function create()
    {
        $governorates = Governorate::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.local-units.create', compact('governorates'));
    }

    public function store(LocalUnitRequest $request)
    {
        LocalUnit::create($request->validated() + ['status' => (bool) $request->boolean('status')]);

        return redirect()->route('admin.local-units.index')->with('success', __('messages.created_successfully'));
    }

    public function edit(LocalUnit $localUnit)
    {
        $localUnit->load('district.governorate');
        $governorates = Governorate::orderBy('sort_order')->orderBy('name')->get();
        $districts = District::where('governorate_id', $localUnit->district->governorate_id)
            ->orderBy('sort_order')->orderBy('name')->get();

        return view('admin.local-units.edit', compact('localUnit', 'governorates', 'districts'));
    }

    public function update(LocalUnitRequest $request, LocalUnit $localUnit)
    {
        $localUnit->update($request->validated() + ['status' => (bool) $request->boolean('status')]);

        return redirect()->route('admin.local-units.index')->with('success', __('messages.updated_successfully'));
    }

    public function destroy(LocalUnit $localUnit)
    {
        $localUnit->delete();

        return response()->json(['success' => true, 'message' => __('messages.deleted_successfully')]);
    }
}

