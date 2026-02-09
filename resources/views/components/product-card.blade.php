@props(['product'])

<article class="bg-white border border-gray-200 overflow-hidden group" data-product-id="{{ $product->id }}" itemscope itemtype="https://schema.org/Product">
    <div class="relative">
        <!-- Product Image with Link - Square aspect ratio -->
        <a href="{{ route('products.show', $product->slug) }}" 
        class="block flex justify-center items-center w-full bg-gray-100">
            <img src="{{ $product->main_image_url }}"
             alt="{{ $product->name }}" 
             class="w-[95%] aspect-square object-contain lg:w-[327px] lg:h-[327px]"
             itemprop="image"
             loading="lazy"
             decoding="async"
             fetchpriority="low"
             onerror="this.src='https://via.placeholder.com/300x200/cccccc/ffffff?text=No+Image'; console.log('Image failed to load:', this.src);">
        </a>
        
        <!-- Sale Badge -->
        @if($product->badge)
            <div class="absolute top-2 left-2">
                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                    {{ $product->badge }}
                </span>
            </div>
        @endif
        
        <!-- Action Buttons Container - Hidden on mobile, hover on desktop -->
        <div class="hidden md:flex absolute top-2 right-2 flex-col space-y-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-out">
            <!-- Wishlist Button -->
            <button class="wishlist-btn bg-white rounded-full p-2 shadow-md hover:bg-red-50 active:scale-95 transition-all duration-200 z-10 w-8 h-8 flex items-center justify-center" 
                    onclick="toggleWishlist('{{ $product->id }}', '{{ $product->name }}')"
                    data-product-id="{{ $product->id }}"
                    title="Add to Wishlist">
                <i class="fas fa-heart text-gray-400 hover:text-red-500 transition-colors text-sm wishlist-icon"></i>
            </button>
            
            <!-- Remove from Wishlist Button (hidden by default) -->
            <button class="remove-wishlist-btn bg-white rounded-full p-2 shadow-md hover:bg-red-50 active:scale-95 transition-all duration-200 z-10 w-8 h-8 flex items-center justify-center hidden" 
                    onclick="removeFromWishlist('{{ $product->id }}')"
                    data-product-id="{{ $product->id }}"
                    title="Remove from Wishlist">
                <i class="fas fa-times text-red-500 text-sm"></i>
            </button>
            
            <!-- Add to Cart Button -->
            <button class="bg-white rounded-full p-2 shadow-md hover:bg-blue-50 active:scale-95 transition-all duration-200 z-10 w-8 h-8 flex items-center justify-center"
                    onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->main_image_url }}')"
                    title="Add to Cart">
                <i class="fas fa-shopping-cart text-gray-400 hover:text-blue-600 transition-colors text-sm"></i>
            </button>
        </div>
    </div>
    
    <!-- Content Section - Longer to make card rectangular -->
    <div class="p-3 sm:p-4 flex flex-col">
        <!-- Product Name with Link -->
        <a href="{{ route('products.show', $product->slug) }}" class="">
            <h3 class="text-xs sm:text-sm font-medium text-gray-900 hover:text-blue-600 transition-colors line-clamp-2" itemprop="name">{{ $product->name }}</h3>
        </a>
        
        <!-- Stock Status -->
        <div class="flex items-center">
            @if($product->stock_quantity > 0)
                <div class="flex items-center text-green-600">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-xs font-medium">In Stock</span>
                </div>
            @else
                <div class="flex items-center text-red-600">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-xs font-medium">Out of Stock</span>
                </div>
            @endif
            @if($product->reviews_count > 0)
                <span class="text-xs text-gray-500 ml-2">({{ $product->reviews_count }} reviews)</span>
            @endif
        </div>
        
        <!-- Price and Quick Add Button -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-auto gap-2">
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-2">
                @if($product->old_price)
                    <span class="text-xs sm:text-sm text-gray-500 line-through order-2 sm:order-1">{{ $product->formatted_old_price }}</span>
                @endif
                <span class="text-base sm:text-lg font-bold text-gray-900 order-1 sm:order-2" itemprop="price" content="{{ $product->price }}">
                    <span itemprop="priceCurrency" content="KES">{{ $product->formatted_price }}</span>
                </span>
            </div>
            <!-- Mobile Quick Add Button - Always Visible -->
            <button onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->main_image_url }}')" 
                    class="md:hidden w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-2 px-4 rounded-lg font-semibold text-sm active:scale-95 transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                <i class="fas fa-shopping-cart"></i>
                <span>Add to Cart</span>
            </button>
        </div>
    </div>
    
    <!-- Hidden structured data -->
    <meta itemprop="url" content="{{ route('products.show', $product->slug) }}">
    <meta itemprop="availability" content="{{ $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}">
    @if($product->category)
        <meta itemprop="category" content="{{ $product->category->name }}">
    @endif
</article> 