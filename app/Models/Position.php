<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location_id','parent_id'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function parent()
    {
        return $this->belongsTo(Position::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Position::class, 'parent_id');
    }
}
