@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@section('title', $product->name . ' - ' . $product->category->name . ' | Speed and Style Hub Kenya')
@section('description', $product->description ?: 'Buy ' . $product->name . ' in Kenya. Quality ' . $product->category->name . ' at competitive prices. Fast delivery and excellent customer service from Speed and Style Hub.')
@section('keywords', $product->name . ', ' . $product->category->name . ', Fashion and Personal Care Products Kenya, Speed and Style Hub, buy online Kenya')
@section('og_title', $product->name . ' - ' . $product->category->name . ' | Speed and Style Hub')
@section('og_description', $product->description ?: 'Buy ' . $product->name . ' in Kenya. Quality ' . $product->category->name . ' at competitive prices.')
@section('og_type', 'product')
@section('og_image', $product->main_image_url)
@section('og_image_width', '1200')
@section('og_image_height', '1200')
@section('og_image_alt', $product->name)
@section('og_url', request()->url())
@section('og_price_amount', $product->price)
@section('og_price_currency', 'KES')
@section('og_product_availability', $product->stock > 0 ? 'in stock' : 'out of stock')
@section('twitter_title', $product->name . ' - ' . $product->category->name . ' | Speed and Style Hub')
@section('twitter_description', $product->description ?: 'Buy ' . $product->name . ' in Kenya. Quality ' . $product->category->name . ' at competitive prices.')
@section('twitter_image', $product->main_image_url)

@section('structured_data')
@php
    $description = $product->description ?: 'Buy ' . $product->name . ' in Kenya. Quality ' . $product->category->name . ' at competitive prices.';
@endphp
{!! '<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "' . addslashes($product->name) . '",
    "description": "' . addslashes($description) . '",
    "image": "' . $product->main_image_url . '",
    "url": "' . request()->url() . '",
    "category": "' . addslashes($product->category->name) . '",
    "brand": {
        "@type": "Brand",
        "name": "' . addslashes($product->brand ?? 'Speed and Style Hub') . '"
    },
    "offers": {
        "@type": "Offer",
        "price": "' . $product->price . '",
        "priceCurrency": "KES",
        "availability": "' . ($product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock') . '",
        "url": "' . request()->url() . '",
        "seller": {
            "@type": "Organization",
            "name": "Speed and Style Hub"
        }
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "' . $product->rating . '",
        "reviewCount": "' . $product->reviews_count . '",
        "bestRating": "5",
        "worstRating": "1"
    }
}
</script>' !!}
@endsection

@section('content')
    <!-- Breadcrumb - Compact on Mobile -->
    <section class="bg-gray-50 py-1.5 md:py-4">
        <div class="container mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
            <nav class="flex overflow-x-auto scrollbar-hide" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 md:space-x-4 min-w-max">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500">
                            <svg class="flex-shrink-0 h-4 w-4 md:h-5 md:w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 h-4 w-4 md:h-5 md:w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <a href="{{ route('products.index') }}" class="ml-2 md:ml-4 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-700 whitespace-nowrap">Products</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 h-4 w-4 md:h-5 md:w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="ml-2 md:ml-4 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-700 whitespace-nowrap">{{ Str::limit($product->category->name, 15) }}</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 h-4 w-4 md:h-5 md:w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="ml-2 md:ml-4 text-xs md:text-sm font-medium text-gray-500 whitespace-nowrap">{{ Str::limit($product->name, 20) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container mx-auto px-3 sm:px-4 md:px-6 lg:px-8 py-3 md:py-8 pb-16 md:pb-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 md:gap-8">
            <!-- Product Images -->
            <div class="space-y-2 md:space-y-4">
                <!-- Main Image - Swipeable on Mobile -->
                <div class="relative w-full overflow-hidden rounded-lg md:rounded-lg bg-gray-100">
                    <div class="w-full" style="aspect-ratio: 1/1;">
                        <img id="mainImage" 
                             src="{{ $product->main_image_url }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-contain md:object-cover" 
                             style="aspect-ratio: 1/1; display: block;"
                             onerror="this.onerror=null; this.src='https://via.placeholder.com/600x600/cccccc/ffffff?text=No+Image';">
                    </div>
                    @if(count($product->all_images_urls) > 1)
                        <!-- Image Counter -->
                        <div class="absolute top-2 right-2 bg-black/70 text-white text-xs font-semibold px-3 py-1.5 rounded-full backdrop-blur-sm z-10">
                            <span id="currentImageIndex">1</span> / {{ count($product->all_images_urls) }}
                        </div>
                        <!-- Mobile Navigation Arrows -->
                        <button id="prevImageBtn" class="md:hidden absolute left-2 top-1/2 transform -translate-y-1/2 bg-black/60 text-white w-10 h-10 rounded-full flex items-center justify-center z-10 backdrop-blur-sm active:bg-black/80 transition-all">
                            <i class="fas fa-chevron-left text-sm"></i>
                        </button>
                        <button id="nextImageBtn" class="md:hidden absolute right-2 top-1/2 transform -translate-y-1/2 bg-black/60 text-white w-10 h-10 rounded-full flex items-center justify-center z-10 backdrop-blur-sm active:bg-black/80 transition-all">
                            <i class="fas fa-chevron-right text-sm"></i>
                        </button>
                    @endif
                </div>

                <!-- Thumbnail Gallery - Desktop Only -->
                @if(count($product->all_images_urls) > 1)
                    <div class="hidden md:block relative">
                        <div class="flex space-x-2 overflow-x-auto scrollbar-hide justify-center" id="thumbnailContainer">
                            @foreach($product->all_images_urls as $index => $imageUrl)
                                <img src="{{ $imageUrl }}"
                                     alt="{{ $product->name }} - Image {{ $index + 1 }}"
                                     class="flex-shrink-0 w-20 h-20 object-cover rounded cursor-pointer border-2 {{ $index === 0 ? 'border-blue-500' : 'border-transparent hover:border-gray-300' }} thumbnail-image"
                                     data-image="{{ $imageUrl }}"
                                     style="width: 80px; height: 80px; min-width: 80px; max-width: 80px;">
                            @endforeach
                        </div>

                        <!-- Navigation Buttons -->
                        @if(count($product->all_images_urls) > 4)
                            <button class="scroll-left-btn absolute left-0 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-800 p-1 rounded-full shadow-lg transition-all duration-200 z-10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button class="scroll-right-btn absolute right-0 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-800 p-1 rounded-full shadow-lg transition-all duration-200 z-10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        @endif
                    </div>
                    
                    <!-- Mobile Image Thumbnails - Horizontal Scroll -->
                    <div class="md:hidden mt-3">
                        <div class="flex space-x-2 overflow-x-auto scrollbar-hide pb-2 justify-center" id="mobileThumbnailContainer">
                            @foreach($product->all_images_urls as $index => $imageUrl)
                                <button type="button" class="mobile-thumbnail flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden border-2 transition-all cursor-pointer {{ $index === 0 ? 'border-blue-600 shadow-md' : 'border-gray-300' }}" data-index="{{ $index }}" onclick="window.updateProductImage && window.updateProductImage({{ $index }}); return false;">
                                    <img src="{{ $imageUrl }}"
                                         alt="{{ $product->name }} - Image {{ $index + 1 }}"
                                         class="w-full h-full object-cover pointer-events-none"
                                         onerror="this.src='https://via.placeholder.com/64x64/cccccc/ffffff?text=No+Image';">
                                </button>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Mobile Image Swiper Dots (Alternative) - Hidden on mobile -->
                    <div class="hidden md:flex justify-center space-x-1.5 mt-2">
                        @foreach($product->all_images_urls as $index => $imageUrl)
                            <button class="image-dot w-1.5 h-1.5 rounded-full transition-all {{ $index === 0 ? 'bg-blue-600 w-5' : 'bg-gray-300' }}" data-index="{{ $index }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="space-y-3 md:space-y-6">
                <div>
                    <h1 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $product->name }}</h1>
                    <p class="text-gray-500 mt-1 md:mt-2 text-xs md:text-base">{{ $product->category->name }}</p>
                </div>

                <!-- Rating - Compact on Mobile -->
                <div class="flex items-center flex-wrap gap-1.5">
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-3 h-3 md:w-5 md:h-5 {{ $i <= $product->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <span class="text-[10px] md:text-sm text-gray-500">{{ $product->rating }} ({{ $product->reviews_count }})</span>
                </div>

                <!-- Price - Scaled Down on Mobile -->
                <div class="flex items-center flex-wrap gap-2">
                    <span class="text-2xl md:text-3xl font-bold text-gray-900">{{ $product->formatted_price }}</span>
                    @if($product->old_price && $product->old_price > $product->price)
                        <span class="text-base md:text-xl text-gray-500 line-through">{{ $product->formatted_old_price }}</span>
                        <span class="bg-red-100 text-red-800 text-[10px] md:text-sm font-medium px-2 py-0.5 rounded-full">-{{ $product->discount_percentage }}%</span>
                    @endif
                </div>

                <!-- Badge -->
                @if($product->badge)
                    <div class="inline-flex items-center px-2 py-1 rounded-full text-[10px] md:text-sm font-medium bg-blue-100 text-blue-800">
                        {{ $product->badge }}
                    </div>
                @endif

                <!-- Stock Status - Compact -->
                <div class="flex items-center">
                    @if($product->stock_quantity > 0)
                        <div class="flex items-center text-green-600">
                            <svg class="w-3.5 h-3.5 md:w-5 md:h-5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs md:text-base font-medium">In Stock</span>
                        </div>
                    @else
                        <div class="flex items-center text-red-600">
                            <svg class="w-3.5 h-3.5 md:w-5 md:h-5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs md:text-base font-medium">Out of Stock</span>
                        </div>
                    @endif
                </div>

                <!-- Quantity Selection and Add to Cart - Mobile (Single Row) -->
                <div class="md:hidden flex items-center gap-2 bg-gray-50 p-3 rounded-lg">
                    <label class="text-xs font-medium text-gray-700 whitespace-nowrap">Qty:</label>
                    <div class="flex items-center border-2 border-gray-300 rounded-lg bg-white shadow-sm">
                        <button type="button" onclick="updateQuantity(-1)" class="px-2.5 py-2 text-gray-700 active:bg-gray-100 transition-colors text-sm font-bold">-</button>
                        <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" class="w-12 text-center border-0 focus:ring-0 text-sm font-bold text-gray-900 bg-white" readonly>
                        <button type="button" onclick="updateQuantity(1)" class="px-2.5 py-2 text-gray-700 active:bg-gray-100 transition-colors text-sm font-bold">+</button>
                    </div>
                    <button onclick="toggleWishlist({{ $product->id }}, '{{ $product->name }}')"
                            class="w-11 h-11 border-2 border-gray-300 rounded-lg flex items-center justify-center active:bg-gray-50 transition-colors wishlist-btn flex-shrink-0 bg-white">
                        <i class="fas fa-heart text-gray-400 text-sm"></i>
                    </button>
                    <button onclick="addToCartWithQuantity({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->main_image_url }}', 'quantity')"
                            class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-3 py-2.5 rounded-lg font-bold text-xs active:scale-95 transition-all shadow-lg">
                        <i class="fas fa-shopping-cart mr-1"></i>
                        Add to Cart
                    </button>
                </div>

                <!-- Quantity Selection and Action Buttons - Desktop -->
                <div class="hidden md:block space-y-4">
                    <div class="flex items-center justify-start space-x-4 bg-gray-50 p-4 rounded-xl">
                        <label class="text-base font-medium text-gray-700">Quantity:</label>
                        <div class="flex items-center border-2 border-gray-300 rounded-xl bg-white">
                            <button type="button" onclick="updateQuantity(-1)" class="px-3 py-2 text-gray-600 hover:bg-gray-100 transition-colors">-</button>
                            <input type="number" id="quantity-desktop" value="1" min="1" max="{{ $product->stock_quantity }}" class="w-16 text-center border-0 focus:ring-0 text-base font-semibold" readonly>
                            <button type="button" onclick="updateQuantity(1)" class="px-3 py-2 text-gray-600 hover:bg-gray-100 transition-colors">+</button>
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <button onclick="addToCartWithQuantity({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->main_image_url }}', 'quantity-desktop')"
                                class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transition-all shadow-lg">
                            Add to Cart
                        </button>
                        <button onclick="toggleWishlist({{ $product->id }}, '{{ $product->name }}')"
                                class="w-12 h-12 border border-gray-300 rounded-lg flex items-center justify-center hover:border-gray-400 transition-colors wishlist-btn">
                            <i class="fas fa-heart text-gray-400"></i>
                        </button>
                    </div>
                </div>

                <!-- Description -->
                <div class="pt-3 md:pt-4 border-t border-gray-200">
                    <h3 class="text-sm md:text-lg font-medium text-gray-900 mb-1.5 md:mb-2">Description</h3>
                    <p class="text-xs md:text-base text-gray-600 leading-relaxed">{{ $product->description }}</p>
                </div>

                <!-- Quick Info - Compact on Mobile -->
                <div class="grid grid-cols-2 gap-2 md:gap-4 pt-3 md:pt-4 border-t border-gray-200">
                    <div class="text-center p-2 md:p-3 bg-gray-50 rounded-lg md:rounded-xl">
                        <div class="text-lg md:text-2xl font-bold text-gray-900">{{ $product->rating }}</div>
                        <div class="text-[10px] md:text-sm text-gray-500 mt-0.5 md:mt-1">Rating</div>
                    </div>
                    <div class="text-center p-2 md:p-3 bg-gray-50 rounded-lg md:rounded-xl">
                        <div class="text-lg md:text-2xl font-bold text-gray-900">{{ $product->reviews_count }}</div>
                        <div class="text-[10px] md:text-sm text-gray-500 mt-0.5 md:mt-1">Reviews</div>
                    </div>
                </div>
            </div>
        </div>

        @if($product->specifications)
            <div class="mt-6 md:mt-12">
                <h2 class="text-lg md:text-2xl font-bold text-gray-900 mb-3 md:mb-6">Specifications</h2>
                <div class="bg-white rounded-lg md:rounded-lg border-2 md:border border-gray-200 p-3 md:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-6">
                        @foreach($product->specifications as $key => $value)
                            <div class="flex justify-between py-1.5 md:py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-700 text-xs md:text-base">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                                <span class="text-gray-600 text-xs md:text-base text-right">{{ $value }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if($relatedProducts->count() > 0)
            <div class="mt-6 md:mt-12">
                <h2 class="text-lg md:text-2xl font-bold text-gray-900 mb-3 md:mb-6">Related Products</h2>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-2 md:gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                        <x-product-card :product="$relatedProduct" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@push('styles')
<style>
.scrollbar-hide {
    -ms-overflow-style: none;  /* Internet Explorer 10+ */
    scrollbar-width: none;  /* Firefox */
}
.scrollbar-hide::-webkit-scrollbar {
    display: none;  /* Safari and Chrome */
}

.thumbnail-image {
    transition: all 0.2s ease-in-out;
    cursor: pointer;
    user-select: none;
}

.thumbnail-image:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.thumbnail-image:active {
    transform: scale(0.98);
}

#mainImage {
    transition: opacity 0.3s ease-in-out;
    min-height: 300px;
    background-color: #f3f4f6;
}

#mainImage.loading {
    opacity: 0.6;
}

/* Ensure images are visible */
#mainImage[src] {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

/* Ensure thumbnails are clearly interactive */
.thumbnail-image {
    position: relative;
}

.thumbnail-image::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.1);
    opacity: 0;
    transition: opacity 0.2s ease-in-out;
    pointer-events: none;
}

.thumbnail-image:hover::after {
    opacity: 1;
}

/* Remove number input spinners */
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield; /* Firefox */
}

/* Ensure the quantity input looks clean */
#quantity, #quantity-desktop {
    -webkit-appearance: none;
    -moz-appearance: textfield;
    appearance: textfield;
    color: #111827 !important;
    font-weight: 700 !important;
    background-color: white !important;
}

/* Mobile image swiper */
@media (max-width: 768px) {
    #mainImage {
        touch-action: pan-y;
    }
}

.image-dot {
    transition: all 0.3s ease;
}

/* Mobile thumbnail styles */
.mobile-thumbnail {
    transition: all 0.2s ease;
    cursor: pointer;
    -webkit-tap-highlight-color: transparent;
    touch-action: manipulation;
}

.mobile-thumbnail:active {
    transform: scale(0.95);
}

.mobile-thumbnail:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

.mobile-thumbnail img {
    display: block;
    width: 100%;
    height: 100%;
    pointer-events: none;
    user-select: none;
    -webkit-user-select: none;
}

/* Ensure thumbnail container is hidden on mobile */
@media (max-width: 767px) {
    #thumbnailContainer,
    .scroll-left-btn,
    .scroll-right-btn {
        display: none !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.getElementById('mainImage');
    const imageDots = document.querySelectorAll('.image-dot');
    const currentImageIndex = document.getElementById('currentImageIndex');
    const productImages = @json($product->all_images_urls);
    
    if (!mainImage || !productImages || productImages.length <= 1) {
        console.log('Slider initialization skipped:', {
            hasMainImage: !!mainImage,
            productImagesLength: productImages ? productImages.length : 0
        });
        return;
    }
    
    console.log('Slider initialized with', productImages.length, 'images');
    
    let currentIndex = 0;
    let touchStartX = 0;
    let touchEndX = 0;
    let isSwiping = false;
    
    // Update main image
    function updateMainImage(index) {
        if (index < 0 || index >= productImages.length) {
            console.log('Invalid index:', index);
            return;
        }
        
        currentIndex = index;
        console.log('Updating to image index:', index, 'URL:', productImages[index]);
        
        // Add loading state
        mainImage.style.opacity = '0.6';
        
        // Update image source directly
        mainImage.src = productImages[index];
        
        // Update opacity after a short delay
        setTimeout(function() {
            mainImage.style.opacity = '1';
        }, 100);
        
        if (currentImageIndex) {
            currentImageIndex.textContent = index + 1;
        }
        
        // Update dots (only if they exist - they're hidden on mobile)
        if (imageDots && imageDots.length > 0) {
            imageDots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.remove('bg-gray-300', 'w-1.5');
                    dot.classList.add('bg-blue-600', 'w-5');
                } else {
                    dot.classList.remove('bg-blue-600', 'w-5');
                    dot.classList.add('bg-gray-300', 'w-1.5');
                }
            });
        }
        
        // Update mobile thumbnails
        document.querySelectorAll('.mobile-thumbnail').forEach((thumb, i) => {
            if (i === index) {
                thumb.classList.remove('border-gray-300');
                thumb.classList.add('border-blue-600', 'shadow-md');
            } else {
                thumb.classList.remove('border-blue-600', 'shadow-md');
                thumb.classList.add('border-gray-300');
            }
        });
        
        // Update desktop thumbnails
        document.querySelectorAll('.thumbnail-image').forEach((thumb, i) => {
            if (i === index) {
                thumb.classList.remove('border-transparent', 'hover:border-gray-300');
                thumb.classList.add('border-blue-500');
            } else {
                thumb.classList.remove('border-blue-500');
                thumb.classList.add('border-transparent', 'hover:border-gray-300');
            }
        });
    }
    
    // Touch events for mobile swiping
    if (mainImage) {
        mainImage.addEventListener('touchstart', function(e) {
            e.stopPropagation();
            touchStartX = e.changedTouches[0].screenX;
            isSwiping = false;
        }, { passive: true });
        
        mainImage.addEventListener('touchmove', function(e) {
            e.stopPropagation();
            isSwiping = true;
        }, { passive: true });
        
        mainImage.addEventListener('touchend', function(e) {
            e.stopPropagation();
            if (isSwiping) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }
        }, { passive: true });
    }
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        console.log('Swipe detected:', { diff, threshold: swipeThreshold });
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                // Swipe left - next image
                const nextIndex = currentIndex + 1 >= productImages.length ? 0 : currentIndex + 1;
                console.log('Swipe left, moving to index:', nextIndex);
                updateMainImage(nextIndex);
            } else {
                // Swipe right - previous image
                const prevIndex = currentIndex - 1 < 0 ? productImages.length - 1 : currentIndex - 1;
                console.log('Swipe right, moving to index:', prevIndex);
                updateMainImage(prevIndex);
            }
        }
    }
    
    // Dot click handlers (only if dots exist - they're hidden on mobile)
    if (imageDots && imageDots.length > 0) {
        imageDots.forEach((dot, index) => {
            dot.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('Dot clicked, index:', index);
                updateMainImage(index);
            });
        });
    }
    
    // Mobile thumbnail click handlers - Use event delegation on container for reliability
    const mobileThumbnailContainer = document.getElementById('mobileThumbnailContainer');
    if (mobileThumbnailContainer) {
        mobileThumbnailContainer.addEventListener('click', function(e) {
            // Find the closest button with mobile-thumbnail class
            const button = e.target.closest('.mobile-thumbnail');
            if (button) {
                e.preventDefault();
                e.stopPropagation();
                const index = parseInt(button.getAttribute('data-index'));
                if (!isNaN(index) && index >= 0 && index < productImages.length) {
                    console.log('Mobile thumbnail clicked (delegation), index:', index, 'URL:', productImages[index]);
                    updateMainImage(index);
                } else {
                    console.error('Invalid index:', index, 'from data-index:', button.getAttribute('data-index'));
                }
            }
        });
    }
    
    // Also attach direct listeners as backup
    setTimeout(function() {
        const mobileThumbnails = document.querySelectorAll('.mobile-thumbnail');
        console.log('Found mobile thumbnails:', mobileThumbnails.length);
        mobileThumbnails.forEach((thumb, index) => {
            const dataIndex = thumb.getAttribute('data-index');
            const thumbIndex = dataIndex !== null ? parseInt(dataIndex) : index;
            
            // Keep onclick as primary, add event listener as backup
            thumb.addEventListener('click', function(e) {
                // Don't prevent default if onclick already handled it
                const index = parseInt(this.getAttribute('data-index'));
                if (!isNaN(index) && index >= 0 && index < productImages.length) {
                    console.log('Mobile thumbnail clicked (direct listener backup), index:', index);
                    // Only call if onclick didn't work
                    if (!e.defaultPrevented) {
                        updateMainImage(index);
                    }
                }
            }, true); // Use capture phase
        });
    }, 200);
    
    // Thumbnail click handlers (for desktop) - Use event delegation
    document.addEventListener('click', function(e) {
        const desktopThumbnail = e.target.closest('.thumbnail-image');
        if (desktopThumbnail) {
            e.preventDefault();
            e.stopPropagation();
            const imageUrl = desktopThumbnail.getAttribute('data-image');
            const index = productImages.indexOf(imageUrl);
            if (index !== -1) {
                console.log('Desktop thumbnail clicked, index:', index);
                updateMainImage(index);
            }
        }
    });
    
    // Also attach direct listeners as backup
    setTimeout(function() {
        const desktopThumbnails = document.querySelectorAll('.thumbnail-image');
        console.log('Found desktop thumbnails:', desktopThumbnails.length);
        desktopThumbnails.forEach((thumb, index) => {
            const imageUrl = thumb.getAttribute('data-image');
            const thumbIndex = imageUrl ? productImages.indexOf(imageUrl) : index;
            
            // Remove any existing listeners
            const newThumb = thumb.cloneNode(true);
            thumb.parentNode.replaceChild(newThumb, thumb);
            
            newThumb.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('Desktop thumbnail clicked (direct), index:', thumbIndex);
                updateMainImage(thumbIndex);
            });
        });
    }, 200);
    
    // Navigation button handlers
    const prevImageBtn = document.getElementById('prevImageBtn');
    const nextImageBtn = document.getElementById('nextImageBtn');
    
    if (prevImageBtn) {
        prevImageBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (currentIndex > 0) {
                updateMainImage(currentIndex - 1);
            } else {
                updateMainImage(productImages.length - 1); // Loop to last
            }
        });
    }
    
    if (nextImageBtn) {
        nextImageBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (currentIndex < productImages.length - 1) {
                updateMainImage(currentIndex + 1);
            } else {
                updateMainImage(0); // Loop to first
            }
        });
    }
    
    // Sync quantity inputs (mobile and desktop)
    const quantityInput = document.getElementById('quantity');
    const quantityInputDesktop = document.getElementById('quantity-desktop');
    
    function syncQuantityInputs(value) {
        if (quantityInput) quantityInput.value = value;
        if (quantityInputDesktop) quantityInputDesktop.value = value;
    }
    
    // Store original updateQuantity function
    const originalUpdateQuantity = window.updateQuantity;
    
    // Override global updateQuantity to sync both inputs
    window.updateQuantity = function(change, inputId = 'quantity') {
        // Call original function
        if (originalUpdateQuantity) {
            originalUpdateQuantity(change, inputId);
        }
        
        // Sync both inputs
        const currentInput = document.getElementById(inputId);
        if (currentInput) {
            const value = currentInput.value;
            syncQuantityInputs(value);
        }
    };
    
    // Sync on input change
    if (quantityInput) {
        quantityInput.addEventListener('change', function() {
            syncQuantityInputs(this.value);
        });
    }
    if (quantityInputDesktop) {
        quantityInputDesktop.addEventListener('change', function() {
            syncQuantityInputs(this.value);
        });
    }
    
    // Make updateMainImage globally accessible immediately
    window.updateMainImage = updateMainImage;
    
    // Global function for onclick handlers - must be accessible from inline onclick
    window.updateProductImage = function(index) {
        console.log('updateProductImage called with index:', index, 'productImages:', productImages);
        if (typeof window.updateMainImage === 'function') {
            window.updateMainImage(index);
        } else {
            console.error('updateMainImage function not found');
            // Retry after a short delay
            setTimeout(function() {
                if (typeof window.updateMainImage === 'function') {
                    window.updateMainImage(index);
                }
            }, 100);
        }
    };
    
    // Process any queued updates from before DOMContentLoaded
    if (window.updateProductImageQueue && window.updateProductImageQueue.length > 0) {
        console.log('Processing', window.updateProductImageQueue.length, 'queued image updates');
        while (window.updateProductImageQueue.length > 0) {
            const queuedIndex = window.updateProductImageQueue.shift();
            window.updateMainImage(queuedIndex);
        }
    }
    
    console.log('Slider initialized, updateProductImage available:', typeof window.updateProductImage);
});
</script>

<!-- Pre-initialize function before DOM loads to handle early clicks -->
<script>
(function() {
    // Queue for early calls before DOMContentLoaded
    window.updateProductImageQueue = window.updateProductImageQueue || [];
    
    // Temporary function that will be replaced when DOMContentLoaded fires
    window.updateProductImage = function(index) {
        console.log('updateProductImage called early, index:', index);
        // If updateMainImage is already available, use it
        if (window.updateMainImage && typeof window.updateMainImage === 'function') {
            console.log('Calling updateMainImage immediately');
            window.updateMainImage(index);
        } else {
            // Queue it and try again multiple times
            console.log('Queuing image update, will retry');
            window.updateProductImageQueue.push(index);
            let retries = 0;
            const maxRetries = 10;
            const checkInterval = setInterval(function() {
                retries++;
                if (window.updateMainImage && typeof window.updateMainImage === 'function') {
                    clearInterval(checkInterval);
                    window.updateMainImage(index);
                    // Process any queued updates
                    while (window.updateProductImageQueue.length > 0) {
                        const queuedIndex = window.updateProductImageQueue.shift();
                        window.updateMainImage(queuedIndex);
                    }
                } else if (retries >= maxRetries) {
                    clearInterval(checkInterval);
                    console.error('updateMainImage not available after', maxRetries, 'retries');
                }
            }, 50);
        }
    };
})();
</script>
@endpush
