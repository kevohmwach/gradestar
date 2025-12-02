<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class ProductImage extends Component
{
    // Public properties passed to the view
    public $imageTitle;
    public $webpSrcset;
    public $originalSrcset;
    public $fallbackUrl;
    public $width = 1200;
    public $height = 800;

    public function __construct(array $promotion)
    {
        // Image logic from the original code
        $dynamicImagePath = $promotion['prod_image'] ?? 'images/placeholder-product.jpg';
        $this->imageTitle = $promotion['prod_title'] ?? 'Product Placeholder Image';

        $parts = pathinfo($dynamicImagePath);
        $directory = $parts['dirname'] === '.' ? '' : $parts['dirname'] . '/';
        $filename = $parts['filename'];
        $extension = $parts['extension'] ?? 'jpg';

        $sizes = [
            300 => ['original' => asset("storage/{$directory}{$filename}-300w.{$extension}"), 'webp' => asset("storage/{$directory}{$filename}-300w.webp")],
            400 => ['original' => asset("storage/{$directory}{$filename}-400w.{$extension}"), 'webp' => asset("storage/{$directory}{$filename}-400w.webp")],
            800 => ['original' => asset("storage/{$directory}{$filename}-800w.{$extension}"), 'webp' => asset("storage/{$directory}{$filename}-800w.webp")],
        ];

        $this->webpSrcset = Collection::make($sizes)->map(fn ($urls, $width) => "{$urls['webp']} {$width}w")->implode(', ');
        $this->originalSrcset = Collection::make($sizes)->map(fn ($urls, $width) => "{$urls['original']} {$width}w")->implode(', ');
        $this->fallbackUrl = $sizes[300]['original'];
    }

    public function render()
    {
        return view('components.product-image');
    }
}