<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Mobile-app account. Separate from App\Models\User (dashboard staff) and from Member (church record).
 */
class AppUser extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'language', 'profile_picture', 'congregation',
        'notification_settings',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'deletion_requested_at' => 'datetime',
        'notification_settings' => 'array',
        'password' => 'hashed',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function membershipApplications()
    {
        return $this->hasMany(MembershipApplication::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /** none | applicant | member */
    public function membershipStatus(): string
    {
        if ($this->member_id) {
            return 'member';
        }
        return $this->membershipApplications()->where('status', 'pending')->exists() ? 'applicant' : 'none';
    }
}
