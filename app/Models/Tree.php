<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tree extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'tree_group_id'];

    public function group()
    {
        return $this->belongsTo(TreeGroup::class, 'tree_group_id');
    }
}
