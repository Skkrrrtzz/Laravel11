<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Generate3DArray extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:3darray {num1} {num2} {num3}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a 3D array based on three input numbers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $num1 = $this->argument('num1');
        $num2 = $this->argument('num2');
        $num3 = $this->argument('num3');

        $array = [];

        for ($i = 0; $i < $num1; $i++) {
            for ($j = 0; $j < $num2; $j++) {
                for ($k = 0; $k < $num3; $k++) {
                    $array[$i][$j][$k] = $i * $j * $k;
                }
            }
        }

        $this->info("Generated 3D array:");
        $this->info(json_encode($array, JSON_PRETTY_PRINT));

        return 0;
    }
}
