<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GetFilesFromServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dayz:get-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get files from Dayz Server';

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
        $marketFiles = Storage::disk('ftp')->files('dayzstandalone/config/ExpansionMod/Market');
        $tradersFiles = Storage::disk('ftp')->files('dayzstandalone/config/ExpansionMod/Traders');

        foreach($marketFiles as $marketFile) {
            $filename = Str::of($marketFile)->basename();
            $contents = Storage::disk('ftp')->get($marketFile);
            $this->comment("Storing: " . $filename);
            Storage::disk('local')->put("market/{$filename}", $contents);
        }

        foreach($tradersFiles as $tradersFile) {
            $filename = Str::of($tradersFile)->basename();
            $contents = Storage::disk('ftp')->get($tradersFile);
            $this->comment("Storing: " . $filename);
            Storage::disk('local')->put("traders/{$filename}", $contents);
        }
    }
}
