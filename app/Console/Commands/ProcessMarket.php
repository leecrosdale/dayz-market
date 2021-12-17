<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Models\ItemType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessMarket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:market';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes Market Files';

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
        $files = Storage::files('market');

        foreach ($files as $file)
        {
            $items = json_decode(Storage::get($file));

            $itemType = ItemType::firstOrCreate([
                'm_version' => $items->m_Version,
                'name' => $items->DisplayName,
                'icon' => $items->Icon,
                'color' => $items->Color,
                'init_stock_percent' => $items->InitStockPercent,
                'filename' => Str::of($file)->basename()
            ]);


            foreach ($items->Items as $item) {
                Item::firstOrCreate([
                    'item_type_id' => $itemType->id,
                    'class_name' => $item->ClassName,
                    'max_price_threshold' => $item->MaxPriceThreshold,
                    'min_price_threshold' => $item->MinPriceThreshold,
                    'sell_price_percent' => $item->SellPricePercent,
                    'max_stock_threshold' => $item->MaxStockThreshold,
                    'min_stock_threshold' => $item->MinStockThreshold,
                    'spawn_attachments' => $item->SpawnAttachments,
                    'variants' => $item->Variants
                ]);
            }

        }

    }
}
