<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'profile_picture',
        'password',
        'role',
        'permissions',
        'is_active',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'permissions' => 'array',
        'last_login_at' => 'datetime',
    ];

    /**
     * Mutator to hash password when setting it
     */
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is editor
     */
    public function isEditor()
    {
        return $this->role === 'editor' || $this->isAdmin();
    }

    /**
     * Check if user is active
     */
    public function isActive()
    {
        return $this->is_active === true;
    }

    /**
     * Get user's activity logs
     */
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    /**
     * Check if user has a specific permission
     */
    public function hasPermission($permission)
    {
        // Admin has all permissions
        if ($this->isAdmin()) {
            return true;
        }

        // Check if permission exists in user's permissions array
        $permissions = $this->permissions ?? [];
        return in_array($permission, $permissions);
    }

    /**
     * Get all available permissions
     */
    public static function getAvailablePermissions()
    {
        return [
            'manage_blog' => 'Manage Blog Posts',
            'manage_sermons' => 'Manage Sermons',
            'manage_videos' => 'Manage Videos',
            'manage_gallery' => 'Manage Gallery',
            'manage_ministries' => 'Manage Ministries',
            'manage_leadership' => 'Manage Leadership',
            'manage_events' => 'Manage Events',
            'manage_prayers' => 'Manage Prayer Requests',
            'manage_contact' => 'Manage Contact Messages',
            'manage_users' => 'Manage Users',
            'view_logs' => 'View Activity Logs',
        ];
    }

    /**
     * Get role badge color
     */
    public function getRoleBadgeColor()
    {
        return match($this->role) {
            'admin' => 'red',
            'editor' => 'blue',
            'viewer' => 'gray',
            default => 'gray',
        };
    }

    /**
     * Record login activity
     */
    public function recordLogin()
    {
        $this->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->ip(),
        ]);

        ActivityLog::log('logged_in', 'User logged in');
    }
}
