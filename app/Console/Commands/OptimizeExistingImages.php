<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class OptimizeExistingImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optimize:existing-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 1. Define the directory within storage/app
        $directory = 'images'; 
        $fullPath = storage_path();
        //$fullPath = storage_path('app/images');

        // 2. Use the File facade to get all files recursively
        // Change File::allFiles to File::files if you only want files in the top 'images' folder
        $files = File::allFiles($fullPath); 
        var_dump($files);
        // dd($files);

        $optimizerChain = OptimizerChainFactory::create();

        foreach ($files as $file) {
            // Get the absolute path for optimization
            $path = $file->getRealPath();

            // 3. Optional: Skip files without common image extensions
            if (!in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif'])) {
                $this->warn("Skipping non-image file: " . basename($path));
                continue;
            }
            if(basename($path) == "2F1zWg9SZYkVEPOKtnI3Ba5Jiyns8XUIMR6MWfCW.png"){
                $this->info("Optimizing: " . basename($path));
                $optimizerChain->optimize($path); 
            }
            $this->info("Optimizing: " . basename($path));
            // $optimizerChain->optimize($path); 
        }

        $this->comment("Optimization complete!");

        
        // $optimizerChain = OptimizerChainFactory::create();
        // $imagePaths = glob(public_path('images/*.*')); // Adjust path as needed

        // foreach ($imagePaths as $path) {
        //     $this->info("Optimizing: " . basename($path));
        //     // The optimize method replaces the original image with the optimized version.
        //     $optimizerChain->optimize($path); 
        // }

        return Command::SUCCESS;
    }
}
