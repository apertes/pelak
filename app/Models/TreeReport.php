<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreeReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'planted_tree_id',
        'title',
        'description',
        'image',
        'seen',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plantedTree()
    {
        return $this->belongsTo(PlantedTree::class);
    }
}
