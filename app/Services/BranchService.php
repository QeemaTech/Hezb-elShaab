<?php

namespace App\Services;

use App\Repositories\BranchRepository;

class BranchService
{
    protected $branchRepo;

    public function __construct(BranchRepository $branchRepo)
    {
        $this->branchRepo = $branchRepo;
    }

    public function index()
    {
        $limit = request()->input('limit', 15);

        return $this->branchRepo->index($limit);
    }
}
