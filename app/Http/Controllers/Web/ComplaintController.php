<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::latest()->get();
        $breadcrumbs = [
            ['name' => __('messages.complaints'), 'url' => route('admin.complaints.index')],
        ];

        return view('admin.complaints.index', compact('complaints', 'breadcrumbs'));
    }

    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);
        $breadcrumbs = [
            ['name' => __('messages.complaints'), 'url' => route('admin.complaints.index')],
            ['name' => __('messages.show'), 'url' => null],
        ];

        return view('admin.complaints.show', compact('complaint', 'breadcrumbs'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,in_progress,resolved,closed',
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.complaints.index', $complaint->id)
            ->with('success', __('messages.settings_updated'));
    }
}

