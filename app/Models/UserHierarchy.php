<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHierarchy extends Model
{
    use HasFactory;

    protected $table = 'user_hierarchy';

    protected $fillable = [
        'parent_user_id',
        'child_user_id',
    ];

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_user_id');
    }

    public function child()
    {
        return $this->belongsTo(User::class, 'child_user_id');
    }
} 