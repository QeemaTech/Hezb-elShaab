<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSponsor extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'image',
    ];
    public function getImageUrlAttribute(){
        return $this->image ? asset('storage/'. $this->image) : null;
    }
    public function event(){
        return $this->belongsTo(Event::class);
    }
}
