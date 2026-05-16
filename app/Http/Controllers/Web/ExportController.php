<?php

namespace App\Http\Controllers\Web;

use App\Exports\CandidatesExport;
use App\Exports\ComplaintsExport;
use App\Exports\EventUsersExport;
use App\Exports\EventsExport;
use App\Exports\NewsExport;
use App\Exports\ParliamentaryBodiesExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Complaint;
use App\Models\Event;
use App\Models\ExportLog;
use App\Models\News;
use App\Models\ParliamentaryBody;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    public function users(Request $request): BinaryFileResponse
    {
        $request->validate([
            'type' => ['nullable', 'in:admins,active-members,pending-members'],
            'national_id' => ['nullable', 'string', 'max:50'],
            'membership_id' => ['nullable', 'string', 'max:50'],
            'format' => ['nullable', 'in:csv,xlsx'],
        ]);

        $type = (string) $request->input('type', 'active-members');
        $format = (string) $request->input('format', 'xlsx');

        $users = $this->usersQuery($request, $type)
            ->with(['member:id,membership_number', 'governorate:id,name', 'roles:id,name'])
            ->orderByDesc('created_at')
            ->get();

        $this->logExport($request, 'users', $format, $users->count());

        $fileName = sprintf('users-%s-%s.%s', $type, now()->format('Ymd_His'), $format);

        return Excel::download(new UsersExport($users, $type), $fileName);
    }

    public function complaints(Request $request): BinaryFileResponse
    {
        $request->validate([
            'status' => ['nullable', 'in:new,in_progress,resolved,closed'],
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date'],
            'format' => ['nullable', 'in:csv,xlsx'],
        ]);

        $format = (string) $request->input('format', 'xlsx');

        $complaints = Complaint::query()
            ->when($request->filled('status'), fn (Builder $query) => $query->where('status', $request->input('status')))
            ->when($request->filled('date_from'), fn (Builder $query) => $query->whereDate('created_at', '>=', $request->input('date_from')))
            ->when($request->filled('date_to'), fn (Builder $query) => $query->whereDate('created_at', '<=', $request->input('date_to')))
            ->latest()
            ->get();

        $this->logExport($request, 'complaints', $format, $complaints->count());

        $fileName = sprintf('complaints-%s.%s', now()->format('Ymd_His'), $format);

        return Excel::download(new ComplaintsExport($complaints), $fileName);
    }

    public function events(Request $request): BinaryFileResponse
    {
        $request->validate([
            'status' => ['nullable', 'in:0,1'],
            'is_private' => ['nullable', 'in:0,1'],
            'format' => ['nullable', 'in:csv,xlsx'],
        ]);

        $format = (string) $request->input('format', 'xlsx');

        $events = Event::query()
            ->with(['user:id,name,email'])
            ->withCount(['organizers', 'sponsors', 'allowedUsers'])
            ->when($request->filled('status'), fn (Builder $q) => $q->where('status', (int) $request->input('status')))
            ->when($request->filled('is_private'), fn (Builder $q) => $q->where('is_private', (int) $request->input('is_private')))
            ->latest()
            ->get();

        $this->logExport($request, 'events', $format, $events->count());

        $fileName = sprintf('events-%s.%s', now()->format('Ymd_His'), $format);

        return Excel::download(new EventsExport($events), $fileName);
    }

    public function eventUsers(Request $request): BinaryFileResponse
    {
        $request->validate([
            'event_id' => ['nullable', 'integer', 'exists:events,id'],
            'format' => ['nullable', 'in:csv,xlsx'],
        ]);

        $format = (string) $request->input('format', 'xlsx');

        $events = Event::query()
            ->with(['allowedUsers:id,uuid,name,phone,email'])
            ->when($request->filled('event_id'), fn (Builder $q) => $q->where('id', (int) $request->input('event_id')))
            ->latest()
            ->get();

        $recordsCount = $events->sum(fn (Event $event) => $event->allowedUsers->count());
        $this->logExport($request, 'event-users', $format, $recordsCount);

        $fileName = sprintf('event-users-%s.%s', now()->format('Ymd_His'), $format);

        return Excel::download(new EventUsersExport($events), $fileName);
    }

    public function news(Request $request): BinaryFileResponse
    {
        $request->validate([
            'status' => ['nullable', 'in:0,1'],
            'format' => ['nullable', 'in:csv,xlsx'],
        ]);

        $format = (string) $request->input('format', 'xlsx');

        $news = News::query()
            ->with(['user:id,name,email'])
            ->when($request->filled('status'), fn (Builder $q) => $q->where('status', (int) $request->input('status')))
            ->latest()
            ->get();

        $this->logExport($request, 'news', $format, $news->count());

        $fileName = sprintf('news-%s.%s', now()->format('Ymd_His'), $format);

        return Excel::download(new NewsExport($news), $fileName);
    }

    public function candidates(Request $request): BinaryFileResponse
    {
        $request->validate([
            'status' => ['nullable', 'in:0,1'],
            'format' => ['nullable', 'in:csv,xlsx'],
        ]);

        $format = (string) $request->input('format', 'xlsx');

        $candidates = Candidate::query()
            ->when($request->filled('status'), fn (Builder $q) => $q->where('status', (int) $request->input('status')))
            ->latest()
            ->get();

        $this->logExport($request, 'candidates', $format, $candidates->count());

        $fileName = sprintf('candidates-%s.%s', now()->format('Ymd_His'), $format);

        return Excel::download(new CandidatesExport($candidates), $fileName);
    }

    public function parliamentaryBodies(Request $request): BinaryFileResponse
    {
        $request->validate([
            'status' => ['nullable', 'in:0,1'],
            'format' => ['nullable', 'in:csv,xlsx'],
        ]);

        $format = (string) $request->input('format', 'xlsx');

        $items = ParliamentaryBody::query()
            ->when($request->filled('status'), fn (Builder $q) => $q->where('status', (int) $request->input('status')))
            ->latest()
            ->get();

        $this->logExport($request, 'parliamentary-bodies', $format, $items->count());

        $fileName = sprintf('parliamentary-bodies-%s.%s', now()->format('Ymd_His'), $format);

        return Excel::download(new ParliamentaryBodiesExport($items), $fileName);
    }

    private function usersQuery(Request $request, string $type): Builder
    {
        $nationalId = $request->input('national_id');
        $membershipId = $request->input('membership_id');

        if ($type === 'admins') {
            return User::query()
                ->where('role', 'admin')
                ->when($nationalId, fn (Builder $query) => $query->where('national_id', 'like', '%' . $nationalId . '%'));
        }

        if ($type === 'pending-members') {
            return User::query()->hasMemberStatus('pending');
        }

        return User::query()
            ->hasMemberStatus('active')
            ->when($nationalId, function (Builder $query) use ($nationalId) {
                $query->where(function (Builder $innerQuery) use ($nationalId) {
                    $innerQuery->where('national_id', 'like', '%' . $nationalId . '%')
                        ->orWhereHas('member', function (Builder $memberQuery) use ($nationalId) {
                            $memberQuery->where('national_id', 'like', '%' . $nationalId . '%');
                        });
                });
            })
            ->when($membershipId, function (Builder $query) use ($membershipId) {
                $query->whereHas('member', function (Builder $memberQuery) use ($membershipId) {
                    $memberQuery->where('membership_number', 'like', '%' . $membershipId . '%');
                });
            });
    }

    private function logExport(Request $request, string $exportType, string $format, int $recordsCount): void
    {
        ExportLog::create([
            'user_id' => $request->user()?->id,
            'export_type' => $exportType,
            'format' => $format,
            'records_count' => $recordsCount,
            'filters' => $request->except(['_token']),
        ]);
    }
}
