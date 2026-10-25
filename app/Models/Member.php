<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'legacy_id', 'member_number', 'first_name', 'last_name', 'other_names', 'email',
        'phone', 'gender', 'date_of_birth', 'congregation', 'society', 'status',
    ];

    protected $casts = ['date_of_birth' => 'date'];

    public function appUser()
    {
        return $this->hasOne(AppUser::class);
    }
}
