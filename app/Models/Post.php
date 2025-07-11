<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'parent_id',
    ];

    // والد سمت
    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    // زیرمجموعه‌های سمت
    public function children()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }

    // کاربران این سمت
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_post');
    }
} 