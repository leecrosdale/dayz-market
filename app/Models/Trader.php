<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'missing_items' => 'array'
    ];

    public function getRouteKeyName()
    {
        return 'filename';
    }

    public function currencies()
    {
        return $this->belongsToMany(Currency::class, 'trader_currency');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'trader_category');
    }

    public function items()
    {
        return $this->hasManyThrough(Item::class, TraderItem::class);
    }

    public function trader_items()
    {
        return $this->hasMany(TraderItem::class);
    }

    public function currenciesToJson()
    {

        $data = [];

        foreach ($this->currencies as $currency)
        {
            $data[] = $currency->name;
        }

        return $data;
    }


    public function categoriesToJson()
    {

        $data = [];

        foreach ($this->categories()->orderBy('name')->get() as $category)
        {
            $data[] = $category->name;
        }

        return $data;
    }

    public function itemsToJson()
    {

        $data = [];

        $traderItems = $this->trader_items()->with('item')->get();

        foreach ($traderItems as $item)
        {
            $data[$item->item->class_name] = $item->status;
        }

        return $data;
    }


    public function removeMissingItem($name)
    {
        $missingItems = array_filter($this->missing_items, function($item) use ($name) {
            return $item !== $name;
        });

        $this->missing_items = array_values($missingItems);

        return $this->save();
    }


}
