<?php

namespace App\Console\Commands;

use App\Models\TraderItem;
use Illuminate\Console\Command;

class StripTradersItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'traders:strip-items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes all traders items';

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
        TraderItem::query()->delete();
    }
}
