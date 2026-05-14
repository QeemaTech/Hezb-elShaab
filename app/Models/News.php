<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class News extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'image',
        'description',
        'status',
        'read_minutes',
        'user_id',
    ];
    protected $appends = ['image_url'];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            $news->slug = Str::slug($news->title, '-');
        });

        static::updating(function ($news) {
            $news->slug = Str::slug($news->title, '-');
        });
    }
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
