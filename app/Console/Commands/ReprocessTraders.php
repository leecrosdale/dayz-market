<?php

namespace App\Console\Commands;

use App\Models\ItemType;
use App\Models\Trader;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ReprocessTraders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reprocess:traders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reprocesses Traders back to JSON files';

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

        foreach (Trader::all() as $trader)
        {

            $content = [
                'm_version' => $trader->m_version,
                'TraderName' => $trader->trader_name,
                'DisplayName' => $trader->display_name,
                'Icon' => $trader->icon,
                'Currencies' => $trader->currenciesToJson(),
                'Categories' => $trader->categoriesToJson(),
                'Items' => $trader->itemsToJson()
            ];

            Storage::put('reprocess/traders/' . $trader->filename, json_encode($content, JSON_PRETTY_PRINT));

        }
    }
}
