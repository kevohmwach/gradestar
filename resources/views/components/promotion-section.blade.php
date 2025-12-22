{{-- <div class="promotion-content">
    <p class="hot-deals">Grab limited Hot deals now </p>

    @if (!empty($promotions))
        @foreach($promotions as $promotion)
            <div class="promotion-column">
                <a href="{{ url('/shop', $promotion['slug']) }}"> --}}
                    
                    {{-- USE THE PREVIOUSLY CREATED IMAGE COMPONENT --}}
                    {{-- <x-product-image :promotion="$promotion" />
                    
                    <div class="bk-title">
                        <p>{{ $promotion['prod_title'] }}</p>
                    </div>
                </a>

                <div class="bk-price">
                    <div class="discount">
                        <p class="actual-price actual-price-discounted"> --}}
                            {{-- Price display logic --}}
                            {{-- <s>${{ $promotion['prod_actualPrice'] }}</s>
                        </p>
                        <p class="discounted-price"> --}}
                            {{-- Discount calculation logic --}}
                            {{-- ${{ round($promotion['prod_actualPrice'] * (1 - ($promotion['prod_Percent_discount'] * 0.01)), 2) }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div> --}}



<aside data-nosnippet >
    <div class="promotion-content">
        <h4 class="hot-deals">Grab limited Hot deals now </h4>
        @if (!empty($promotions))
            @foreach($promotions as $promotion)
                <div class="promotion-column">
                    <a href="{{url('/shop', $promotion['slug'])}}" >
                    <div class="bk-image bk-image-promo">
                        {{-- <img src="../storage/{{$promotion['prod_image']}}" alt="{{$promotion['prod_title']}}"> --}}
                        @php
                        // 1. Define the dynamic variables from your parent view/loop
                        $dynamicImagePath = $promotion['prod_image'] ?? 'images/placeholder-product.jpg';
                        $imageTitle = $promotion['prod_title'] ?? 'Product Placeholder Image';

                        // 2. Determine the parts of the path
                        $parts = pathinfo($dynamicImagePath);
                        // If dynamicImagePath is 'images/product.jpg', $directory becomes 'images/'
                        $directory = $parts['dirname'] === '.' ? '' : $parts['dirname'] . '/';
                        $filename = $parts['filename'];
                        $extension = $parts['extension'] ?? 'jpg'; // Default to jpg if extension is missing

                        // 3. Define the sizes and paths based on the Artisan command (300w, 400w, 800w, 1200w)
                        // NOTE: The 'storage/' prefix is used, requiring the files to be in storage/app/public.
                        $sizes = [
                            300 => [ // NEW: Smallest variant for tiny screens/low-res mobiles
                                'original' => asset("storage/{$directory}{$filename}-300w.{$extension}"),
                                'webp' => asset("storage/{$directory}{$filename}-300w.webp")
                            ],
                            400 => [ // Corresponds to Artisan's 400w variant
                                'original' => asset("storage/{$directory}{$filename}-400w.{$extension}"),
                                'webp' => asset("storage/{$directory}{$filename}-400w.webp")
                            ],
                            // 800 => [ // Corresponds to Artisan's 800w variant
                            //     'original' => asset("storage/{$directory}{$filename}-800w.{$extension}"),
                            //     'webp' => asset("storage/{$directory}{$filename}-800w.webp")
                            // ],
                            // 1200 => [ // Corresponds to Artisan's largest 1200w variant
                            //     'original' => asset("storage/{$directory}{$filename}-1200w.{$extension}"),
                            //     'webp' => asset("storage/{$directory}{$filename}-1200w.webp")
                            // ],
                        ];

                        // 4. Build the srcset strings using the generated URLs and width descriptors (w)
                        $webpSrcset = collect($sizes)->map(function ($urls, $width) {
                            return "{$urls['webp']} {$width}w";
                        })->implode(', ');

                        $originalSrcset = collect($sizes)->map(function ($urls, $width) {
                            return "{$urls['original']} {$width}w";
                        })->implode(', ');

                        // 5. Fallback URL (must be the lowest-res image for best performance)
                        $fallbackUrl = $sizes[300]['original'];
                    @endphp

                    {{-- <picture>
                        <!-- 1. WebP Source: Allows the browser to pick the best size WebP file -->
                        <source
                            srcset="{{ $webpSrcset }}" --}}
                            {{-- UPDATED: Use 300px as the target for small screens --}}
                            {{-- sizes="(max-width: 400px) 300px, 100vw"
                            type="image/webp"
                        > --}}

                        <!-- 2. Original Format Source: Allows the browser to pick the best size JPG/PNG file -->
                        {{-- <source
                            srcset="{{ $originalSrcset }}" --}}
                            {{-- UPDATED: Use 300px as the target for small screens --}}
                            {{-- sizes="(max-width: 400px) 300px, 100vw"
                        > --}}

                        <!-- 3. Fallback Img: Use the <img> tag's width/height attributes to prevent CLS -->
                        {{-- <img
                            src="{{ $fallbackUrl }}"
                            alt="{{ $imageTitle }}"
                            class="webP-image" --}}
                            {{-- Set the aspect ratio based on the largest generated image (1200w), 
                                then use CSS/Tailwind to manage the max size. --}}
                            {{-- width="1200" 
                            height="800"  --}}
                            {{-- loading="lazy" --}}
                        {{-- >
                    </picture> --}}


                    </div>
                    <div class="bk-title">
                        <p>{{$promotion['prod_title']}}</p>
                    </div>
                    </a>

                    <div class="bk-price">
                        <div class="discount">
                            <p class="actual-price actual-price-discounted"><s>${{$promotion['prod_actualPrice']}}</s></p>
                            <p class="discounted-price">${{ round($promotion['prod_actualPrice']* (1-($promotion['prod_Percent_discount']*0.01)),2) }}</p>
                        </div>
                        
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</aside>