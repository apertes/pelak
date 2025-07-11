<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    protected $fillable = [
        'planted_tree_id',
        'qr_code',
        'qr_image',
    ];

    /**
     * رابطه با مدل PlantedTree
     */
    public function plantedTree()
    {
        return $this->belongsTo(PlantedTree::class, 'planted_tree_id');
    }
}
