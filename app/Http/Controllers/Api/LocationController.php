<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Governorate;
use App\Models\LocalUnit;
use App\Models\PartyUnit;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function governorates()
    {
        $governorates = Governorate::query()
            ->where('status', 1)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json(['data' => $governorates]);
    }

    public function districts(Request $request)
    {
        $request->validate([
            'governorate_id' => ['nullable', 'integer', 'exists:governorates,id'],
        ]);

        $query = District::query()
            ->where('status', 1);

        if ($request->filled('governorate_id')) {
            $query->where('governorate_id', $request->integer('governorate_id'));
        }

        $districts = $query->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'governorate_id', 'name']);

        return response()->json(['data' => $districts]);
    }

    public function localUnits(Request $request)
    {
        $request->validate([
            'governorate_id' => ['nullable', 'integer', 'exists:governorates,id'],
            'district_id' => ['nullable', 'integer', 'exists:districts,id'],
        ]);

        $query = LocalUnit::query()
            ->with('district:id,governorate_id')
            ->where('status', 1);

        if ($request->filled('district_id')) {
            $query->where('district_id', $request->integer('district_id'));
        }

        if ($request->filled('governorate_id')) {
            $query->whereHas('district', function ($districtQuery) use ($request) {
                $districtQuery->where('governorate_id', $request->integer('governorate_id'));
            });
        }

        $localUnits = $query->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'district_id', 'name'])
            ->map(function (LocalUnit $localUnit) {
                return [
                    'id' => $localUnit->id,
                    'district_id' => $localUnit->district_id,
                    'governorate_id' => optional($localUnit->district)->governorate_id,
                    'name' => $localUnit->name,
                ];
            });

        return response()->json(['data' => $localUnits]);
    }

    public function partyUnits(Request $request)
    {
        $request->validate([
            'governorate_id' => ['nullable', 'integer', 'exists:governorates,id'],
            'district_id' => ['nullable', 'integer', 'exists:districts,id'],
            'local_unit_id' => ['nullable', 'integer', 'exists:local_units,id'],
        ]);

        $query = PartyUnit::query()
            ->with('localUnit.district:id,governorate_id')
            ->where('status', 1);

        if ($request->filled('local_unit_id')) {
            $query->where('local_unit_id', $request->integer('local_unit_id'));
        }

        if ($request->filled('district_id')) {
            $query->whereHas('localUnit', function ($localUnitQuery) use ($request) {
                $localUnitQuery->where('district_id', $request->integer('district_id'));
            });
        }

        if ($request->filled('governorate_id')) {
            $query->whereHas('localUnit.district', function ($districtQuery) use ($request) {
                $districtQuery->where('governorate_id', $request->integer('governorate_id'));
            });
        }

        $partyUnits = $query->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'local_unit_id', 'name'])
            ->map(function (PartyUnit $partyUnit) {
                return [
                    'id' => $partyUnit->id,
                    'local_unit_id' => $partyUnit->local_unit_id,
                    'district_id' => optional($partyUnit->localUnit)->district_id,
                    'governorate_id' => optional(optional($partyUnit->localUnit)->district)->governorate_id,
                    'name' => $partyUnit->name,
                ];
            });

        return response()->json(['data' => $partyUnits]);
    }
}
