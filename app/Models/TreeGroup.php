<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Tree;

class TreeGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function trees()
    {
        return $this->hasMany(Tree::class);
    }
}
