<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParliamentaryBodyResource;
use App\Services\ParliamentaryBodyService;

class ParliamentaryBodyController extends Controller
{
    protected $parliamentaryBodyService;

    public function __construct(ParliamentaryBodyService $parliamentaryBodyService)
    {
        $this->parliamentaryBodyService = $parliamentaryBodyService;
    }

    public function index()
    {
        return ParliamentaryBodyResource::collection($this->parliamentaryBodyService->index());
    }
}
