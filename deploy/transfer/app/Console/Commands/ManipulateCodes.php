<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ManipulateCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manipulate:codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Done processing files.');
        return true;
    }
}
