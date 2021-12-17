<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{
    use HasFactory;

    protected $guarded = [];


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

        foreach ($this->categories as $category)
        {
            $data[] = $category->name;
        }

        return $data;
    }

    public function itemsToJson()
    {

        $data = [];

        foreach ($this->trader_items()->with('item')->get() as $item)
        {
            $data[$item->item->class_name] = $item->status;
        }

        return $data;
    }



}
