<?php

namespace App\Services;

use App\Repositories\CandidateRepository;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CandidateService
{
    protected $candidateRepo;

    public function __construct(CandidateRepository $candidateRepo)
    {
        $this->candidateRepo = $candidateRepo;
    }

    public function getAllCandidates()
    {
        return $this->candidateRepo->getAll();
    }

    public function getCandidateBySlug(string $slug)
    {
        return $this->candidateRepo->findBySlug($slug);
    }

    public function createCandidate(array $data)
    {
        // Store image if uploaded
        if (isset($data['image']) && $data['image']->isValid()) {
            $data['image'] = $data['image']->store('candidate/images', 'public');
        }

        // Add creator
        $data['user_id'] = Auth::id();

        // Create the candidate
        return $this->candidateRepo->create($data);
    }

    public function updateCandidate(Candidate $candidate, array $data)
    {
        // Replace image if new one uploaded
        if (isset($data['image']) && $data['image']->isValid()) {
            // Delete old image if exists
            if ($candidate->image && Storage::disk('public')->exists($candidate->image)) {
                Storage::disk('public')->delete($candidate->image);
            }
            $data['image'] = $data['image']->store('candidate/images', 'public');
        }else{
            unset($data['image']);
        }

        return $this->candidateRepo->update($candidate, $data);
    }

    public function deleteCandidate(Candidate $candidate)
    {
        return $this->candidateRepo->delete($candidate);
    }

    public function index(){
        $limit =  request()->input('limit', 15);
        return $this->candidateRepo->index($limit);
    }
    public function show($id){
        return $this->candidateRepo->find($id);
    }
}
