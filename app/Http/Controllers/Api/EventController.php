<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }
    public function index(){
        return  EventResource::collection($this->eventService->index());
    }

    public function drafts()
    {
        return EventResource::collection($this->eventService->draftIndex());
    }

    public function show($id){
        return  new EventResource($this->eventService->show($id));
    }
}
