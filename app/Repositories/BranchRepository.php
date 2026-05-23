<?php

namespace App\Repositories;

use App\Models\Branch;

class BranchRepository
{
    public function index($limit)
    {
        return Branch::latest()->paginate($limit);
    }
}
