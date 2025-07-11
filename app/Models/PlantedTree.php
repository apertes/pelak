<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantedTree extends Model
{
    protected $fillable = [
        'tree_group_id',
        'tree_id',
        'location_id',
        'position_id',
        'latitude',
        'longitude',
        'image',
        'qr_code',
        'status',
        'description',
    ];

    public function group()
    {
        return $this->belongsTo(TreeGroup::class, 'tree_group_id');
    }

    public function tree()
    {
        return $this->belongsTo(Tree::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
