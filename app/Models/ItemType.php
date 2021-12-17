<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function itemsToJson()
    {
        $data = [];

        foreach ($this->items()->orderBy('class_name')->get() as $item)
        {
            $data[] = [
                'ClassName' => $item->class_name,
                'MaxPriceThreshold' => $item->max_price_threshold,
                'MinPriceThreshold' => $item->min_price_threshold,
                'SellPricePrecent' => $item->sell_price_percent,
                'MaxStockThreshold' => $item->max_stock_threshold,
                'MinStockThreshold' => $item->min_stock_threshold,
                'SpawnAttachments' => $item->spawn_attachments,
                'Variants' => $item->variants
            ];
        }

        return $data;
    }
}
