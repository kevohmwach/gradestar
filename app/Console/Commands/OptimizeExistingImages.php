<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\ImageOptimizer\OptimizerChainFactory;

use Intervention\Image\Facades\Image;

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
        // 1. Setup the necessary tools
        $optimizerChain = OptimizerChainFactory::create();
        //$baseDir = storage_path('app/public/images'); // Adjust path as needed
        $baseDir = storage_path(); // Adjust path as needed

        if (!File::isDirectory($baseDir)) {
            $this->error("Image directory not found: {$baseDir}");
            return;
        }
        // dd("Directory confirmed");

        // $imageFiles = File::files($baseDir);
        $imageFiles = File::allFiles($baseDir);
        // var_dump($imageFiles);

        $this->info("Starting combined image optimization...");

        foreach ($imageFiles as $file) {
            $path = $file->getRealPath();
            $filename = $file->getFilename();

            // Check if the file is a PNG before processing
            if (strtolower($file->getExtension()) !== 'png') {
            //if (!in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif'])) {
                // $this->warn("Skipping: '{$filename}' (Not a PNG file).");
                continue;
            }

            if(basename($path) == "9dguqmydpYJB65aUSjSBljAvp0bh03xBAN7ThWHb.png"){//production
            //if(basename($path) == "RI8UCc3NZoD4n4ja1FFMslQ7QbMAIa0PfVO5zwuq.png"){

                // --- INTERVENTION/IMAGE (Lossy Resize & Color Limit) ---
                try {
                    $img = Image::make($path);
                    
                    $this->info("Processing: {$filename}");
                    $originalSize = File::size($path);

                    // 1. Resize and apply constraints
                    $this->info("Resizing: " . basename($path));
                    $img->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize(); 
                    });
                    
                    // 2. Reduce the color palette for smaller PNG files
                    $img->limitColors(256, 10); 

                    // 3. Save (overwrites the original, applying Intervention's optimization)
                    $img->save($path);
                    
                    $interventionSize = File::size($path);
                    $this->comment("   Intervention Step Complete. Size: " . round($interventionSize / 1024, 2) . " KB");

                    
                    // --- SPATIE/IMAGE-OPTIMIZER (Lossless Compression) ---

                    // 4. Run Spatie's lossless optimizer on the already resized file
                    $this->info("Optimizing: " . basename($path));
                    $optimizerChain->optimize($path); 

                    $finalSize = File::size($path);
                    
                    $this->comment("  Spatie Step Complete. Final Size: " . round($finalSize / 1024, 2) . " KB");
                    $reduction = ($originalSize - $finalSize) / $originalSize * 100;
                    $this->info("Total Reduction: " . round($reduction, 2) . "%");

                } catch (\Exception $e) {
                    $this->error("Error optimizing {$filename}: " . $e->getMessage());
                }

                // $this->info("✅ All image files processed.");
            }

        }

        $this->info("✅ All image files processed.");
        
        
        
        
        /*
        // 1. Define the directory within storage/app
        $directory = 'images'; 
        $fullPath = storage_path();
        //$fullPath = storage_path('app/images');

        // 2. Use the File facade to get all files recursively
        // Change File::allFiles to File::files if you only want files in the top 'images' folder
        $files = File::allFiles($fullPath); 
        // var_dump($files);
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
            if(basename($path) == "9dguqmydpYJB65aUSjSBljAvp0bh03xBAN7ThWHb.png"){
                $this->info("Optimizing: " . basename($path));
                $optimizerChain->optimize($path); 

                // Load the image
                $img = Image::make($path);
                // Resize to max width of 1000px and set JPEG quality to 80
                $img->resize(1000, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize(); // Prevent upsizing small images
                })->save($path, 80); // Overwrite the original with quality 80
            }

            // $this->info("Optimizing: " . basename($path));
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

        //*/

        return Command::SUCCESS;
    }



}
