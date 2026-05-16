<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SystemLogController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'action' => ['nullable', 'string', 'max:255'],
            'status_code' => ['nullable', 'integer'],
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date'],
        ]);

        $logs = LogSystem::query()
            ->with('user:id,name,email')
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = (string) $request->input('q');
                $query->where(function ($inner) use ($q) {
                    $inner->where('description', 'like', "%{$q}%")
                        ->orWhere('url', 'like', "%{$q}%")
                        ->orWhere('route_name', 'like', "%{$q}%");
                });
            })
            ->when($request->filled('category'), fn ($q) => $q->where('category', $request->input('category')))
            ->when($request->filled('action'), fn ($q) => $q->where('action', $request->input('action')))
            ->when($request->filled('status_code'), fn ($q) => $q->where('status_code', (int) $request->input('status_code')))
            ->when($request->filled('date_from'), fn ($q) => $q->whereDate('created_at', '>=', $request->input('date_from')))
            ->when($request->filled('date_to'), fn ($q) => $q->whereDate('created_at', '<=', $request->input('date_to')))
            ->orderByDesc('id')
            ->paginate(50)
            ->withQueryString();

        $breadcrumbs = [
            ['name' => __('messages.system_logs'), 'url' => route('admin.system-logs.index')],
        ];

        return view('admin.system-logs.index', compact('logs', 'breadcrumbs'));
    }

    public function show(LogSystem $systemLog)
    {
        $systemLog->load('user:id,name,email');

        $breadcrumbs = [
            ['name' => __('messages.system_logs'), 'url' => route('admin.system-logs.index')],
            ['name' => __('messages.show'), 'url' => null],
        ];

        return view('admin.system-logs.show', compact('systemLog', 'breadcrumbs'));
    }

    public function destroyAll(): RedirectResponse
    {
        LogSystem::query()->delete();

        return redirect()->route('admin.system-logs.index')->with('success', __('messages.deleted_successfully'));
    }

    public function destroyRange(Request $request): RedirectResponse
    {
        $request->validate([
            'date_from' => ['required', 'date'],
            'date_to' => ['required', 'date', 'after_or_equal:date_from'],
        ]);

        LogSystem::query()
            ->whereDate('created_at', '>=', $request->input('date_from'))
            ->whereDate('created_at', '<=', $request->input('date_to'))
            ->delete();

        return redirect()->route('admin.system-logs.index')->with('success', __('messages.deleted_successfully'));
    }
}
