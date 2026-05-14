<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }
    public function index(){
        return  NewsResource::collection($this->newsService->index());
    }
    public function show($id){
        return  new NewsResource($this->newsService->show($id));
    }
}
