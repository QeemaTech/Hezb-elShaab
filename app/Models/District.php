<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['governorate_id', 'name', 'status', 'sort_order'];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function localUnits()
    {
        return $this->hasMany(LocalUnit::class);
    }
}
