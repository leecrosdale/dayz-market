<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'spawn_attachments' => 'object',
        'variants' => 'object'
    ];

    public function item_type()
    {
        return $this->belongsTo(ItemType::class);
    }
}
