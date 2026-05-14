<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\EventRequest;
use App\Models\Event;
use App\Models\User;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $events = $this->eventService->getAllEvents();
        $breadcrumbs = [
            ['name' => __('messages.events'), 'url' => route('admin.events.index')],
        ];
        return view('admin.events.index', compact('events', 'breadcrumbs'));
    }

    public function show($slug)
    {
        $event = $this->eventService->getEventBySlug($slug);
        $breadcrumbs = [
            ['name' => __('messages.events'), 'url' => route('admin.events.index')],
            ['name' => __('messages.show'), 'url' => null]
        ];
        return view('admin.events.show', compact('event', 'breadcrumbs'));
    }
    public function create()
    {
        $breadcrumbs = [
            ['name' => __('messages.events'), 'url' => route('admin.events.index')],
            ['name' => __('messages.create'), 'url' => null]
        ];
        return view('admin.events.create', compact('breadcrumbs'));
    }

    public function store(EventRequest $request)
    {
        $this->eventService->createEvent($request->validated() + [
            'image' => $request->file('image'),
            'video' => $request->file('video')
        ]);
        return redirect()->route('admin.events.index')->with('success', 'Event created!');
    }

    public function edit($slug)
    {
        $event = $this->eventService->getEventBySlug($slug);
        $breadcrumbs = [
            ['name' => __('messages.events'), 'url' => route('admin.events.index')],
            ['name' => __('messages.update'), 'url' => null]
        ];
        return view('admin.events.edit', compact('event', 'breadcrumbs'));
    }
    public function update(EventRequest $request, Event $event)
    {
        $this->eventService->updateEvent($event, $request->validated() + [
            'image' => $request->file('image'),
            'video' => $request->file('video')
        ]);
        return redirect()->route('admin.events.index')->with('success', 'Event updated!');
    }

    public function destroy($slug)
    {
        $event =  $this->eventService->getEventBySlug($slug);

        if (!$event) {
            return response()->json(['error' => 'event not found']);
        }

        $this->eventService->deleteEvent($event);
        return response()->json(['success' => false], 404);
    }
    public function removeUser(Event $event, User $user)
    {
        $this->eventService->removeUser($event, $user);
        return response()->json(['success' => true], 200);
    }
    public function addUser(Request $request, Event $event)
    {
        $request->validate([
            'users' => 'required|array',
            'users.*' => 'exists:users,id',
        ]);

        $event->allowedUsers()->syncWithoutDetaching($request->users);

        return response()->json(['success' => true, 'message' => 'Users added successfully'], 200);
    }
}
