<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderMap extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'wearing_items' => 'array'
    ];
}
