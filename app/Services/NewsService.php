<?php

namespace App\Services;

use App\Repositories\NewsRepository;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    protected $newsRepo;

    public function __construct(NewsRepository $newsRepo)
    {
        $this->newsRepo = $newsRepo;
    }

    public function getAllNewss()
    {
        return $this->newsRepo->getAll();
    }

    public function getNewsBySlug(string $slug)
    {
        return $this->newsRepo->findBySlug($slug);
    }

    public function createNews(array $data)
    {
        // Store image if uploaded
        if (isset($data['image']) && $data['image']->isValid()) {
            $data['image'] = $data['image']->store('news/images', 'public');
        }

        // Add creator
        $data['user_id'] = Auth::id();

        // Create the event
        return $this->newsRepo->create($data);
    }

    public function updateNews(News $event, array $data)
    {
        // Replace image if new one uploaded
        if (isset($data['image']) && $data['image']->isValid()) {
            // Delete old image if exists
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $data['image']->store('news/images', 'public');
        }else{
            unset($data['image']);
        }

        return $this->newsRepo->update($event, $data);
    }

    public function deleteNews(News $event)
    {
        return $this->newsRepo->delete($event);
    }

    public function index(){
        $limit =  request()->input('limit', 15);
        return $this->newsRepo->index($limit);
    }
    public function show($id){
        return $this->newsRepo->find($id);
    }
}
