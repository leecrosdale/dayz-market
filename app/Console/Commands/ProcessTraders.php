<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\Trader;
use App\Models\TraderItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessTraders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:traders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes Traders Files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $files = Storage::files('traders');

        $unknownItems = [];

        foreach ($files as $file)
        {
            $traders = json_decode(Storage::get($file));

            $traderCurrencies = [];

            foreach ($traders->Currencies as $currency)
            {
                $traderCurrency = Currency::firstOrCreate([
                    'name' => $currency
                ]);

                $traderCurrencies[] = $traderCurrency->id;
            }

            $traderCategories = [];

            foreach ($traders->Categories as $category)
            {
                $traderCategory = Category::firstOrCreate([
                    'name' => $category
                ]);

                $traderCategories[] = $traderCategory->id;
            }

            $this->comment("Creating Trader: {$traders->DisplayName}");

            $trader = Trader::updateOrCreate([
                'filename' => Str::of($file)->basename()
            ], [
                'm_version' => $traders->m_Version,
                'display_name' => $traders->DisplayName,
                'trader_name' => $traders->TraderName,
                'icon' => $traders->TraderIcon,
            ]);

            $trader->currencies()->sync($traderCurrencies);
            $trader->categories()->sync($traderCategories);

            foreach ($traders->Items as $item => $status)
            {
                $this->comment("Adding Item: {$item}");
                $xItem = Item::where('class_name', $item)->first();

                if (!$xItem) {

                    // Check item is not a variant

                    $variant = Item::whereJsonContains('variants', $item)->first();

                    if (!$variant) {
                        $unknownItems[$traders->DisplayName][] = $item;
                    } else {
                        $this->comment("Variant Found: " . $item);
                    }

                } else {
                    TraderItem::updateOrCreate([
                        'class_name' => $xItem->class_name,
                        'trader_id' => $trader->id,
                        'item_id' => $xItem->id,
                    ], [
                        'status' => $status
                    ]);
                }
            }

        }

        $this->comment("Unknown Items:");

        foreach (Trader::all() as $trader)
        {
            if (isset($unknownItems[$trader->display_name])) {
                $trader->missing_items = $unknownItems[$trader->display_name];
            } else {
                $trader->missing_items = [];
            }
            $trader->save();
        }
    }
}
