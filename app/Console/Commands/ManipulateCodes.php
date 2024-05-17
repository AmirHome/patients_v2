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

        $search = 'dtButtons.push(deleteButton)';
        $replace = '// dtButtons.push(deleteButton)';
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
                $newContents = $this->replaceLine($contents, $search, $replace);
                File::put($file->getPathname(), $newContents);
        }
        //return str_replace($search, $replace, $contents);
    }

    protected function replaceLine($contents, $search, $replace)
    {
        $lines = explode(PHP_EOL, $contents);
        $replaceExists = false;
        
        foreach ($lines as &$line) {
            if (strpos($line, $search) !== false) {
                if (strpos($line, $replace) !== false) {
                    $replaceExists = true;
                    break; // No need to continue, replace already exists
                }
                $line = str_replace($search, $replace, $line);
            }
        }
        
        if (!$replaceExists) {
            return implode(PHP_EOL, $lines);
        } else {
            return $contents; // Return original contents if replace already exists
        }
    }
     
}
