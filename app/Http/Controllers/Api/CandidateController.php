<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateResource;
use App\Services\CandidateService;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    protected $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }
    public function index(){
        return  CandidateResource::collection($this->candidateService->index());
    }
    public function show($id){
        return  new CandidateResource($this->candidateService->show($id));
    }
}
