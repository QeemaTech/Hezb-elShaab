<?php

namespace App\Services;

use App\Repositories\EventRepository;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventService
{
    protected $eventRepo;

    public function __construct(EventRepository $eventRepo)
    {
        $this->eventRepo = $eventRepo;
    }

    public function getAllEvents()
    {
        return $this->eventRepo->getAll();
    }

    public function getEventBySlug(string $slug)
    {
        return $this->eventRepo->findBySlug($slug);
    }

    public function createEvent(array $data)
    {
        DB::transaction(function () use ($data) {
            // Store image if uploaded
            if (isset($data['image']) && $data['image']->isValid()) {
                $data['image'] = $data['image']->store('events/images', 'public');
            }

            // Store video if uploaded
            if (isset($data['video']) && $data['video']->isValid()) {
                $data['video'] = $data['video']->store('events/videos', 'public');
            }

            // Add creator
            $data['user_id'] = Auth::id();

            // Create the event
            $event = $this->eventRepo->create($data);

            // Attach organizers if provided
            if (!empty($data['organizers']) && is_array($data['organizers'])) {
                $event->organizers()->attach($data['organizers']);
            }

            // Save Sponsors
            if (!empty($data['sponsors'])) {
                foreach ($data['sponsors'] as $sponsor) {
                    if (!empty($sponsor['name'])) {
                        $imagePath = null;
                        if (isset($sponsor['image']) && $sponsor['image']->isValid()) {
                            $imagePath = $sponsor['image']->store('events/sponsors', 'public');
                        }
                        $event->sponsors()->create([
                            'name'  => $sponsor['name'],
                            'image' => $imagePath,
                        ]);
                    }
                }
            }

            // Attach users if provided
            if ($data['is_private'] == 1 && !empty($data['event_users']) && is_array($data['event_users'])) {
                $event->allowedUsers()->attach($data['event_users'] );
            }
        });
    }

    public function updateEvent(Event $event, array $data)
    {
        // Replace image if new one uploaded
        if (isset($data['image']) && $data['image']->isValid()) {
            // Delete old image if exists
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $data['image']->store('events/images', 'public');
        }else{
            unset($data['image']);
        }

        // Replace video if new one uploaded
        if (isset($data['video']) && $data['video']->isValid()) {
            // Delete old video if exists
            if ($event->video && Storage::disk('public')->exists($event->video)) {
                Storage::disk('public')->delete($event->video);
            }
            $data['video'] = $data['video']->store('events/videos', 'public');
        }else{
            unset($data['video']);
        }

        // Attach organizers if provided
        $event->organizers()->sync($data['organizers'] ?? []);

        // Sync Sponsors
        if (isset($data['sponsors'])) {
            // IDs from the request
            $requestSponsorIds = collect($data['sponsors'])->pluck('id')->filter()->toArray();

            // Delete sponsors removed from request
            $event->sponsors()->whereNotIn('id', $requestSponsorIds)->delete();

            foreach ($data['sponsors'] as $sponsor) {
                if (isset($sponsor['image']) && $sponsor['image']->isValid()) {
                    $imagePath = $sponsor['image']->store('events/sponsors', 'public');
                }

                if (!empty($sponsor['id'])) {
                    // Update existing sponsor
                    $existing = $event->sponsors()->find($sponsor['id']);
                    if ($existing) {
                        $existing->update([
                            'name'  => $sponsor['name'],
                            'image' => $imagePath ?? $existing->image,
                        ]);
                    }
                } elseif (!empty($sponsor['name'])) {
                    // Create new sponsor
                    $event->sponsors()->create([
                        'name'  => $sponsor['name'],
                        'image' => $imagePath,
                    ]);
                }
            }
        }

        return $this->eventRepo->update($event, $data);
    }

    public function deleteEvent(Event $event)
    {
        return $this->eventRepo->delete($event);
    }

    public function index(){
        
        $id = Auth::user()->id;
       
        $limit =  request()->input('limit', 15);
        return $this->eventRepo->index($id,$limit);
    }
    public function show($id){
        return $this->eventRepo->find($id);
    }
    public function removeUser(Event $event, User $user){
        return $this->eventRepo->removeUser($event, $user);
    }
}
