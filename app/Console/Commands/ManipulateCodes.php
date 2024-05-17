<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

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

        $search = 'buttons: dtButtons,';
        $replace = '// buttons: dtButtons,';
        $this->replaceAll(resource_path('views/admin'), $search, $replace);

        $this->info('Done processing files.');
        return true;
    }

    protected function replaceAll($directory, $search, $replace)
    {

        $files = File::allFiles($directory);
        
        foreach ($files as $file) {
            $this->info('Processing: ' . $file->getRelativePathname());
                $contents = File::get($file->getPathname());
                $newContents = $this->removeLine($contents, $search, $replace);
                File::put($file->getPathname(), $newContents);
        }
        //return str_replace($search, $replace, $contents);
    }

    protected function replaceLine($contents, $search, $replace)
    {
        $lines = explode(PHP_EOL, $contents);
        
        foreach ($lines as &$line) {
            if (strpos($line, $search) !== false) {
                $line = str_replace($search, $replace, $line);
            }
        }
        
        return implode(PHP_EOL, $lines);
    }    
}
