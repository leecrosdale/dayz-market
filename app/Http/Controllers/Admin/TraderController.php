<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Trader;
use App\Models\TraderItem;
use Illuminate\Http\Request;

class TraderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traders = Trader::paginate(50);

        return view('admin.traders.index', compact('traders'));
    }

    public function items(Trader $trader)
    {
        $items = $trader->trader_items()->with('item')->get();
        return view('admin.traders.items.index', compact('trader', 'items'));
    }

    public function removeItem(Trader $trader, TraderItem $item)
    {
        $itemName = $item->item->class_name;
        $trader->trader_items()->where('item_id', $item->id)->delete();
        return redirect()->back()->with('status', 'Removed ' . $itemName);
    }

    public function missingItems(Trader $trader)
    {
        $missingItems = $trader->missing_items;

        return view('admin.traders.items.missing.index', compact('missingItems', 'trader'));
    }

    public function showMissingItemCreate(Trader $trader, $missing)
    {
        return view('admin.traders.items.missing.create', compact('trader', 'missing'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trader  $trader
     * @return \Illuminate\Http\Response
     */
    public function show(Trader $trader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trader  $trader
     * @return \Illuminate\Http\Response
     */
    public function edit(Trader $trader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trader  $trader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trader $trader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trader  $trader
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trader $trader)
    {
        //
    }
}
