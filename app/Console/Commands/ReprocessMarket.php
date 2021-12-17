<?php

namespace App\Console\Commands;

use App\Models\ItemType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ReprocessMarket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reprocess:market';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reprocesses Market back to JSON files';

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

        foreach (ItemType::with('items')->get() as $itemType)
        {

            $content = [
                'm_version' => $itemType->m_version,
                'DisplayName' => $itemType->name,
                'Icon' => $itemType->icon,
                'Color' => $itemType->color,
                'InitStockPercent' => $itemType->init_stock_percent,
                'Items' => $itemType->itemsToJson()
            ];

            Storage::put('reprocess/market/' . $itemType->filename, json_encode($content, JSON_PRETTY_PRINT));

        }
    }
}
