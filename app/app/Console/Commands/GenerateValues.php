<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateValues extends Command
{
    public function __construct()
    {
        if (!Storage::disk('public')->exists('results.json'))
        {
            Storage::disk('public')->put('results.json',json_encode([]));
        }
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:values';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generuje wartości temperatury i wilgotności.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (Storage::disk('public')->exists('results.json'))
        {
            $currentContent = json_decode(Storage::disk('public')->get('results.json'), true);
        }

        $result = [];

        for ($i=0; $i<15; $i++)
        {
            $temperature = random_int(10,40);
            $humidity = random_int(10,70);
            $time = date('y-m-d H:i:s');

            $result[] = [
                'temperature' => $temperature,
                'humidity' => $humidity,
                'time' => $time
            ];
        }

        if ($currentContent) $result = array_merge($currentContent, $result);
        Storage::disk('public')->put('results.json',json_encode($result));

        return 0;
    }
}
