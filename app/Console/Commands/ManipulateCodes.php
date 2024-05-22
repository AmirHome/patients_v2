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
        $this->initHelperComposer();

        $search = ['dtButtons.push(deleteButton)',
            '<a class="nav-link" href="#travel_travel_treatment_activities" role="tab" data-toggle="tab">',
            '<div class="tab-pane" role="tabpanel" id="travel_travel_treatment_activities">',
        ];
        $replace = ['// dtButtons.push(deleteButton)',
            '<a class="nav-link active" href="#travel_travel_treatment_activities" role="tab" data-toggle="tab">',
            '<div class="tab-pane show active" role="tabpanel" id="travel_travel_treatment_activities">',
        ];


        $this->replaceAll(resource_path('views/admin'), $search, $replace);
    
        $this->info('Done processing files.');
        return true;
    }
    
    protected function replaceAll($directory, $searchArray, $replaceArray)
    {
        $files = File::allFiles($directory);
        
        foreach ($files as $file) {
            $this->info('Processing: ' . $file->getRelativePathname());
            $contents = File::get($file->getPathname());
            $newContents = $this->replaceLines($contents, $searchArray, $replaceArray);
            File::put($file->getPathname(), $newContents);
        }
    }
    
    protected function replaceLines($contents, $searchArray, $replaceArray)
    {
        foreach ($searchArray as $key => $search) {
            $contents = $this->replaceLine($contents, $search, $replaceArray[$key]);
        }
        
        return $contents;
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

    protected function initHelperComposer()
    {
        $composer = 'composer.json';
        $composerContents = json_decode(file_get_contents($composer), true);
        $composerContents['autoload']['files'] = ['app/Helpers/Init.php'];
        file_put_contents($composer, json_encode($composerContents, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
