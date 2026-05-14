<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Member extends Model
{
    protected $fillable = [
        'national_id',
        'membership_number',
    ];

    protected $hidden = ['membership_number'];

    protected $appends = ['member_id'];

    public function getMemberIdAttribute(): ?string
    {
        return $this->attributes['membership_number'] ?? null;
    }

    protected static function booted()
    {
        static::creating(function ($member) {
            $member->uuid = Str::uuid();
        });
    }
}
