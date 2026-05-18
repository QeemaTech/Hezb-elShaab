<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\NewsRequest;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index()
    {
        $news = $this->newsService->getAllNewss();
        $breadcrumbs = [
            ['name' => __('messages.news'), 'url' => route('admin.news.index')],
        ];
        return view('admin.news.index', compact('news', 'breadcrumbs'));
    }

    public function show($slug)
    {
        $news = $this->newsService->getNewsBySlug($slug);
        $breadcrumbs = [
            ['name' => __('messages.news'), 'url' => route('admin.news.index')],
            ['name' => __('messages.show'), 'url' => null]
        ];
        return view('admin.news.show', compact('news', 'breadcrumbs'));
    }
    public function create()
    {
        $breadcrumbs = [
            ['name' => __('messages.news'), 'url' => route('admin.news.index')],
            ['name' => __('messages.create'), 'url' => null]
        ];
        return view('admin.news.create', compact('breadcrumbs'));
    }

    public function store(NewsRequest $request)
    {
        $this->newsService->createNews($request->validated() + [
            'status' => (bool) $request->boolean('status'),
            'image' => $request->file('image'),
            'video' => $request->file('video')
        ]);
        return redirect()->route('admin.news.index')->with('success', 'News created!');
    }

    public function edit($slug)
    {
        $news = $this->newsService->getNewsBySlug($slug);
        $breadcrumbs = [
            ['name' => __('messages.news'), 'url' => route('admin.news.index')],
            ['name' => __('messages.update'), 'url' => null]
        ];
        return view('admin.news.edit', compact('news', 'breadcrumbs'));
    }
    public function update(NewsRequest $request, News $news)
    {
        $this->newsService->updateNews($news, $request->validated() + [
            'status' => (bool) $request->boolean('status'),
            'image' => $request->file('image'),
            'video' => $request->file('video')
        ]);
        return redirect()->route('admin.news.index')->with('success', 'News updated!');
    }

    public function destroy($slug)
    {
        $news =  $this->newsService->getNewsBySlug($slug);

        if ($news) {
            $news->delete();
            return response()->json(['success' => true]);
        }

        $this->newsService->deleteNews($news);
        return response()->json(['success' => false], 404);
    }
}
