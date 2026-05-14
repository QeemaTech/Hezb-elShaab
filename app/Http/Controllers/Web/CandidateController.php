<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CandidateRequest;
use App\Models\Candidate;
use App\Services\CandidateService;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    protected $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function index()
    {
        $candidates = $this->candidateService->getAllCandidates();
        $breadcrumbs = [
            ['name' => __('messages.candidates'), 'url' => route('admin.candidates.index')],
        ];
        return view('admin.candidates.index', compact('candidates', 'breadcrumbs'));
    }

    public function show($slug)
    {
        $candidate = $this->candidateService->getCandidateBySlug($slug);
        $breadcrumbs = [
            ['name' => __('messages.candidates'), 'url' => route('admin.candidates.index')],
            ['name' => __('messages.show'), 'url' => null]
        ];
        return view('admin.candidates.show', compact('candidate', 'breadcrumbs'));
    }
    public function create()
    {
        $breadcrumbs = [
            ['name' => __('messages.candidates'), 'url' => route('admin.candidates.index')],
            ['name' => __('messages.create'), 'url' => null]
        ];
        return view('admin.candidates.create', compact('breadcrumbs'));
    }

    public function store(CandidateRequest $request)
    {
        $this->candidateService->createCandidate($request->validated() + [
            'image' => $request->file('image'),
        ]);
        return redirect()->route('admin.candidates.index')->with('success', 'Candidate created!');
    }

    public function edit($slug)
    {
        $candidate = $this->candidateService->getCandidateBySlug($slug);
        $breadcrumbs = [
            ['name' => __('messages.candidates'), 'url' => route('admin.candidates.index')],
            ['name' => __('messages.update'), 'url' => null]
        ];
        return view('admin.candidates.edit', compact('candidate', 'breadcrumbs'));
    }
    public function update(CandidateRequest $request, Candidate $candidate)
    {

        $this->candidateService->updateCandidate($candidate, $request->validated() + [
            'image' => $request->file('image'),
        ]);
        return redirect()->route('admin.candidates.index')->with('success', 'Candidate updated!');
    }

    public function destroy($slug)
    {
        $candidates =  $this->candidateService->getCandidateBySlug($slug);

        if ($candidates) {
            $candidates->delete();
            return response()->json(['success' => true]);
        }

        $this->candidateService->deleteCandidate($candidates);
        return response()->json(['success' => false], 404);
    }
}
