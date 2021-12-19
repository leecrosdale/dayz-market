<?php

namespace App\Console\Commands;

use App\Models\DayzObject;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\Trader;
use App\Models\TraderMap;
use App\Models\TraderObjectMap;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessTraderObjectMaps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:trader-objects';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes Trader .map files in the Traders folder';

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
        $files = Storage::files('trader-objects');

        foreach ($files as $file)
        {
            $filename = Str::of($file)->basename();

            $lines = explode("\n", Storage::get($file));

            $previousAreaName = null;

            foreach ($lines as $line) {

                $item = explode('|', $line);

                if (count($item) <= 1) {
                    continue;
                }

                $areaName = explode('_', $filename)[0];

                $object = $item[0];

                $coords = explode(' ', $item[1]);

                $x = $coords[0];
                $y = $coords[1];
                $z = $coords[2];

                $otherCoords = explode(' ', $item[2]);

                $yaw = $otherCoords[0];
                $pitch = $otherCoords[1];
                $roll = $otherCoords[2];

                $dayzObject = DayzObject::firstOrCreate([
                    'name' => $object,
                ]);

                TraderObjectMap::firstOrCreate([
                    'area' => $areaName,
                    'filename' => $filename,
                    'dayz_object_id' => $dayzObject->id,
                    'x' => $x,
                    'y' => $y,
                    'z' => $z,
                    'yaw' => $yaw,
                    'pitch' => $pitch,
                    'roll' => $roll
                ]);


            }
        }
    }
}
