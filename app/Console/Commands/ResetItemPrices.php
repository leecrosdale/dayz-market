<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Models\TraderItem;
use Illuminate\Console\Command;

class ResetItemPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets all item prices to 0 and unlimited stock';

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
        Item::query()->update(['min_price_threshold' => 0, 'max_price_threshold' => 0]);
        Item::query()->update(['min_stock_threshold' => 1, 'max_stock_threshold' => 1]);
    }
}
