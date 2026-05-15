<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartyUnit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['local_unit_id', 'name', 'status', 'sort_order'];

    public function localUnit()
    {
        return $this->belongsTo(LocalUnit::class);
    }
}
