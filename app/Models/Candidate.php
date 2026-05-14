<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Candidate extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'brief',
        'image',
        'description',
        'status',
    ];
    protected $appends = ['image_url'];

    // Automatically create slug when setting title
    public static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            $event->slug = Str::slug($event->name, '-');
        });

        static::updating(function ($event) {
            $event->slug = Str::slug($event->name, '-');
        });
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
