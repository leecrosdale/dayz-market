<?php

namespace App\Console\Commands;

use App\Models\Item;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ExportItemsToCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export items to CSV';

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
        $headers = [
            'class_name',
            'min_price_threshold',
            'max_price_threshold',
            'min_stock_threshold',
            'max_stock_threshold',
            'sell_price_percent',
        ];


        $items = [];


        foreach (Item::all() as $item)
        {
            $items[] = [
                $item->class_name,
                $item->min_price_threshold,
                $item->max_price_threshold,
                $item->min_stock_threshold,
                $item->max_stock_threshold,
                $item->sell_price_percent
            ];
        }


        $content = implode(',', $headers) . "\r\n";

        foreach ($items as $item)
        {
            $content .= implode(',', $item) . "\r\n";
        }


        Storage::put('export/items.csv', $content);



    }
}
