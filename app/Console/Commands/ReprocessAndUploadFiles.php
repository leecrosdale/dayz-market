<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ReprocessAndUploadFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dayz:reprocess-upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reprocess and Upload Files';

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
        Artisan::call('reprocess:market');
        Artisan::call('reprocess:traders');
        Artisan::call('dayz:put-files');
    }
}
