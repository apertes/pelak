<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'parent_id',
        'national_code',
        'phone',
        'type',
    ];

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
        ];
    }

    /**
     * والد کاربر
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    /**
     * زیرمجموعه‌های کاربر
     */
    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    /**
     * والدین کاربر (کاربرانی که این کاربر زیرمجموعه آن‌هاست)
     */
    public function parents()
    {
        return $this->belongsToMany(User::class, 'user_hierarchy', 'child_user_id', 'parent_user_id');
    }

    /**
     * زیرمجموعه‌های کاربر (کاربرانی که زیرمجموعه این کاربر هستند)
     */
    public function childrenHierarchy()
    {
        return $this->belongsToMany(User::class, 'user_hierarchy', 'parent_user_id', 'child_user_id');
    }

    /**
     * سمت‌های کاربر
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'user_post');
    }

    /**
     * آیا کاربر کارمند است؟
     */
    public function isEmployee()
    {
        return $this->type === 'employee';
    }

    /**
     * آیا کاربر شهروند است؟
     */
    public function isCitizen()
    {
        return $this->type === 'citizen';
    }
}
