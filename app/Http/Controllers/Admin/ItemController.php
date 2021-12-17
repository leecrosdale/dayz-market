<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\Trader;
use App\Models\TraderItem;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $search = request()->search;

        if ($search)
        {
            $items = Item::where('class_name', 'LIKE', '%' . $search .'%');
        } else {
            $items = Item::query();
        }


        $items = $items->paginate(100);


        return view('admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeWithTrader(Request $request)
    {

        $trader = Trader::find($request->trader_id);
        $itemType = ItemType::find($request->item_type_id);
        $className = $request->class_name;
        $minPrice = $request->min_price;
        $maxPrice = $request->max_price;
        $minStock = $request->min_stock;
        $maxStock = $request->max_stock;
        $sellPricePercent = $request->sell_price_percent;


        $item = Item::firstOrCreate([
            'class_name' => $className,
            'item_type_id' => $itemType->id,
            'min_price_threshold' => $minPrice,
            'max_price_threshold' => $maxPrice,
            'min_stock_threshold' => $minStock,
            'max_stock_threshold' => $maxStock,
            'sell_price_percent' => $sellPricePercent,
            'spawn_attachments' => [],
            'variants' => []
        ]);

        TraderItem::firstOrCreate([
            'trader_id' => $trader->id,
            'item_id' => $item->id
        ]);

        $trader->removeMissingItem($item->class_name);

        return redirect()->route('admin.traders.index', $trader)->with('status', 'Created ' . $item->class_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
