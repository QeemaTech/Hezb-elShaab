<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'national_id',
        'birth_date',
        'governorate_id',
        'email',
        'phone',
        'password',
        'status',
        'role',
        'member_id',
        'member_status',
        'member_reviewed_by',
        'code',
        'image'
    ];

    protected $appends = ['image_url','is_active_member'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'boolean',
            'birth_date' => 'date',
        ];
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('dashboard/img/team-3.jpg');
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            $user->uuid = Str::uuid();
        });
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function memberReviewedBy()
    {
        return $this->belongsTo(User::class, 'member_reviewed_by');
    }

    public function scopeHasMemberStatus($query, $status)
    {
        return $query->whereNotNull('member_id')->where('member_status', $status);
    }

    public function getIsActiveMemberAttribute()
    {
        if ($this->member_id === null || $this->member_status !== 'active' || empty($this->national_id)) {
            return false;
        }

        if ($this->relationLoaded('member')) {
            return $this->member !== null && $this->member->national_id === $this->national_id;
        }

        return Member::query()
            ->whereKey($this->member_id)
            ->where('national_id', $this->national_id)
            ->exists();
    }

}
