<?php

use App\Models\Event;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('events:mark-past-as-draft', function () {
    $updated = Event::query()
        ->whereNotNull('date')
        ->where('date', '<', now())
        ->where('publish_status', '!=', 'draft')
        ->update(['publish_status' => 'draft']);

    Log::info('events:mark-past-as-draft executed', [
        'updated_count' => $updated,
        'executed_at' => now()->toDateTimeString(),
    ]);

    $this->info("Updated {$updated} events to draft.");
})->purpose('Mark past events as draft based on event date');

Schedule::command('events:mark-past-as-draft')->daily();
