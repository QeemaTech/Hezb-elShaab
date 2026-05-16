<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogSystem extends Model
{
    public $timestamps = false;

    protected $table = 'log_system';

    protected $fillable = [
        'user_id',
        'action',
        'category',
        'description',
        'method',
        'url',
        'route_name',
        'status_code',
        'ip_address',
        'user_agent',
        'target_id',
        'target_type',
        'payload',
        'created_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
