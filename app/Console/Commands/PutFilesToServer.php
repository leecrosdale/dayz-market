<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PutFilesToServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dayz:put-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Put re-processed files back into DayZ Server';

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
        $marketFiles = Storage::disk('local')->files('reprocess/market');
        $tradersFiles = Storage::disk('local')->files('reprocess/traders');

        foreach($marketFiles as $marketFile) {
            $filename = Str::of($marketFile)->basename();
            $contents = Storage::disk('local')->get($marketFile);
            $this->comment("Pushing: " . $filename);
            Storage::disk('ftp')->put("dayzstandalone/config/ExpansionMod/Market/{$filename}", $contents);
        }

        foreach($tradersFiles as $tradersFile) {
            $filename = Str::of($tradersFile)->basename();
            $contents = Storage::disk('local')->get($tradersFile);
            $this->comment("Pushing: " . $filename);
            Storage::disk('ftp')->put("dayzstandalone/config/ExpansionMod/Traders/{$filename}", $contents);
        }
    }
}
