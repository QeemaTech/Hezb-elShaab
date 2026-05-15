<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ParliamentaryBody extends Model
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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $item->slug = Str::slug($item->name, '-');
        });

        static::updating(function ($item) {
            $item->slug = Str::slug($item->name, '-');
        });
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
