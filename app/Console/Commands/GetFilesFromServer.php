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
    protected $description = 'Get files from DayZ Server';

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
        $traderObjectMapFiles = Storage::disk('ftp')->files('dayzstandalone/mpmissions/regular.namalsk/expansion/objects');
        $traderMapFiles = Storage::disk('ftp')->files('dayzstandalone/mpmissions/regular.namalsk/expansion/traders');

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

        foreach($traderMapFiles as $traderMapFile) {
            $filename = Str::of($traderMapFile)->basename();
            $contents = Storage::disk('ftp')->get($traderMapFile);
            $this->comment("Storing: " . $filename);
            Storage::disk('local')->put("trader-maps/{$filename}", $contents);
        }

        foreach($traderObjectMapFiles as $traderObjectMapFile) {
            $filename = Str::of($traderObjectMapFile)->basename();
            $contents = Storage::disk('ftp')->get($traderObjectMapFile);
            $this->comment("Storing: " . $filename);
            Storage::disk('local')->put("trader-objects/{$filename}", $contents);
        }
    }
}
