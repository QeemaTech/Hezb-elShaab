<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'video',
        'date',
        'address',
        'description',
        'rules',
        'status',
        'chat_available',
        'is_private',
        'latitude',
        'longitude',
        'user_id'
    ];

    protected $appends = ['image_url', 'video_url','location_url'];

    protected $casts = [
        'date' => 'datetime',
    ];

    // Automatically create slug when setting title
    public static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            $event->slug = Str::slug($event->title, '-');
        });

        static::updating(function ($event) {
            $event->slug = Str::slug($event->title, '-');
        });
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
    public function getVideoUrlAttribute()
    {
        return $this->video ? asset('storage/' . $this->video) : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'Deleted User', 'email' => 'Deleted User',]);
    }

    public function getLocationUrlAttribute()
    {
        return $this->latitude && $this->longitude ? "https://www.google.com/maps/search/?api=1&query={$this->latitude},{$this->longitude}" : null ;
    }

    public function organizers()
    {
        return $this->belongsToMany(User::class, 'event_organizers');
    }

    public function sponsors()
    {
        return $this->hasMany(EventSponsor::class);
    }

    public function allowedUsers()
    {
        return $this->belongsToMany(User::class, 'event_user')->withTimestamps();;
    }

    public function scopePublic($query)
    {
        return $query->where('is_private', 0);
    }
    public function scopePrivate($query)
    {
        return $query->where('is_private', 1);
    }
}
