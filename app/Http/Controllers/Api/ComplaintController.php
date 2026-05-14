<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreComplaintRequest;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    public function store(StoreComplaintRequest $request)
    {
        $validated = $request->validated();

        $complaint = Complaint::create([
            'user_id' => auth('sanctum')->id(),
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'],
            'description' => $validated['description'],
            'status' => 'new',
            'source' => $request->ip(),
        ]);

        return response()->json([
            'message' => __('messages.complaint_submitted_successfully'),
            'id' => $complaint->id,
        ], 201);
    }
}

