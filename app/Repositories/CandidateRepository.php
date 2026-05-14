<?php

namespace App\Repositories;

use App\Models\Candidate;

class CandidateRepository
{
    public function getAll()
    {
        return Candidate::latest()->get();
    }

    public function findBySlug(string $slug)
    {
        return Candidate::where('slug', $slug)->firstOrFail();
    }

    public function create(array $data)
    {
        return Candidate::create($data);
    }

    public function update(Candidate $candidate, array $data)
    {
        $candidate->update($data);
        return $candidate;
    }

    public function delete(Candidate $candidate)
    {
        return $candidate->delete();
    }

    public function index($limit)
    {
        return Candidate::paginate($limit);
    }
    public function find($id)
    {
        return Candidate::find($id);
    }
}
