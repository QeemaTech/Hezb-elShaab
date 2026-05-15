<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\BranchRequest;
use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::latest()->get();
        $breadcrumbs = [
            ['name' => __('messages.branches'), 'url' => route('admin.branches.index')],
        ];

        return view('admin.branches.index', compact('branches', 'breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['name' => __('messages.branches'), 'url' => route('admin.branches.index')],
            ['name' => __('messages.create'), 'url' => null],
        ];

        return view('admin.branches.create', compact('breadcrumbs'));
    }

    public function store(BranchRequest $request)
    {
        Branch::create($request->validated());

        return redirect()->route('admin.branches.index')->with('success', __('messages.branch_created'));
    }

    public function edit(Branch $branch)
    {
        $breadcrumbs = [
            ['name' => __('messages.branches'), 'url' => route('admin.branches.index')],
            ['name' => __('messages.update'), 'url' => null],
        ];

        return view('admin.branches.edit', compact('branch', 'breadcrumbs'));
    }

    public function update(BranchRequest $request, Branch $branch)
    {
        $branch->update($request->validated());

        return redirect()->route('admin.branches.index')->with('success', __('messages.branch_updated'));
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();

        return response()->json([
            'success' => true,
            'message' => __('messages.branch_deleted'),
        ]);
    }
}
