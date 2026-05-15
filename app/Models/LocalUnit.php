<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocalUnit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['district_id', 'name', 'status', 'sort_order'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function partyUnits()
    {
        return $this->hasMany(PartyUnit::class);
    }
}
