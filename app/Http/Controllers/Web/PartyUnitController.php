<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PartyUnitRequest;
use App\Models\District;
use App\Models\Governorate;
use App\Models\LocalUnit;
use App\Models\PartyUnit;

class PartyUnitController extends Controller
{
    public function index()
    {
        $query = PartyUnit::with('localUnit.district.governorate');

        if ($name = request('name')) {
            $query->where('name', 'like', "%{$name}%");
        }

        if ($localUnitId = request('local_unit_id')) {
            $query->where('local_unit_id', $localUnitId);
        }

        if ($districtId = request('district_id')) {
            $query->whereHas('localUnit', fn($q) => $q->where('district_id', $districtId));
        }

        if ($governorateId = request('governorate_id')) {
            $query->whereHas('localUnit.district', fn($q) => $q->where('governorate_id', $governorateId));
        }

        if (request()->filled('status')) {
            $query->where('status', (bool) request('status'));
        }

        $partyUnits = $query->orderBy('sort_order')->orderBy('name')->paginate(20)->withQueryString();
        $governorates = Governorate::orderBy('sort_order')->orderBy('name')->get();
        $districts = District::orderBy('sort_order')->orderBy('name')->get();
        $localUnits = LocalUnit::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.party-units.index', compact('partyUnits', 'governorates', 'districts', 'localUnits'));
    }

        public function show(PartyUnit $partyUnit)
    {
        $partyUnit->load(['localUnit.district.governorate']);

        return view('admin.party-units.show', compact('partyUnit'));
    }

    public function create()
    {
        $governorates = Governorate::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.party-units.create', compact('governorates'));
    }

    public function store(PartyUnitRequest $request)
    {
        PartyUnit::create($request->validated() + ['status' => (bool) $request->boolean('status')]);

        return redirect()->route('admin.party-units.index')->with('success', __('messages.created_successfully'));
    }

    public function edit(PartyUnit $partyUnit)
    {
        $partyUnit->load('localUnit.district.governorate');
        $governorates = Governorate::orderBy('sort_order')->orderBy('name')->get();
        $districts = District::where('governorate_id', $partyUnit->localUnit->district->governorate_id)
            ->orderBy('sort_order')->orderBy('name')->get();
        $localUnits = LocalUnit::where('district_id', $partyUnit->localUnit->district_id)
            ->orderBy('sort_order')->orderBy('name')->get();

        return view('admin.party-units.edit', compact('partyUnit', 'governorates', 'districts', 'localUnits'));
    }

    public function update(PartyUnitRequest $request, PartyUnit $partyUnit)
    {
        $partyUnit->update($request->validated() + ['status' => (bool) $request->boolean('status')]);

        return redirect()->route('admin.party-units.index')->with('success', __('messages.updated_successfully'));
    }

    public function destroy(PartyUnit $partyUnit)
    {
        $partyUnit->delete();

        return response()->json(['success' => true, 'message' => __('messages.deleted_successfully')]);
    }
}

