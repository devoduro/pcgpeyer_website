<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipApplication extends Model
{
    protected $fillable = [
        'app_user_id', 'member_id', 'status', 'congregation', 'notes',
        'rejection_reason', 'reviewed_by', 'reviewed_at',
    ];

    protected $casts = ['reviewed_at' => 'datetime'];

    public function appUser()
    {
        return $this->belongsTo(AppUser::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
