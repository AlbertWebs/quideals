@extends('layouts.app')

@php
    $category = null;
    if (request()->filled('category')) {
        $category = \App\Models\Category::where('slug', request()->category)->first();
    }
    
    if ($category && $representativeProduct) {
        $ogTitle = $category->name . ' - Shop ' . $category->name . ' Products | Home & Kitchen Appliances';
        $ogDescription = 'Shop ' . $category->name . ' products in Kenya. Quality ' . $category->name . ' at competitive prices. Fast delivery from Home & Kitchen Appliances.';
        $ogImage = $representativeProduct->main_image_url;
        $ogImageAlt = $category->name . ' - ' . $representativeProduct->name;
    } else {
        $ogTitle = 'Home & Kitchen Appliances - Shop Quality Products in Kenya';
        $ogDescription = 'Shop premium home and kitchen appliances in Kenya. Discover quality cookware, kitchen gadgets, home essentials and more at competitive prices.';
        $ogImage = asset('images/logo.svg');
        $ogImageAlt = 'Home & Kitchen Appliances';
    }
@endphp

@section('title', $category ? $category->name . ' - Shop ' . $category->name . ' Products' : 'Shop All Products - Home & Kitchen Appliances')
@section('description', $category ? 'Shop ' . $category->name . ' products in Kenya. Quality ' . $category->name . ' at competitive prices. Fast delivery and excellent customer service.' : 'Shop premium home and kitchen appliances in Kenya. Discover quality cookware, kitchen gadgets, home essentials and more.')
@section('keywords', $category ? $category->name . ', ' . $category->name . ' Kenya, home appliances Kenya, kitchen appliances' : 'home appliances Kenya, kitchen appliances, cookware, kitchen gadgets, home essentials')
@section('og_title', $ogTitle)
@section('og_description', $ogDescription)
@section('og_type', 'website')
@section('og_image', $ogImage)
@section('og_image_alt', $ogImageAlt)
@section('twitter_title', $ogTitle)
@section('twitter_description', $ogDescription)
@section('twitter_image', $ogImage)

@section('structured_data')
@php
    $itemListElements = [];
    foreach($products as $index => $product) {
        $itemListElements[] = '{
            "@type": "ListItem",
            "position": ' . ($index + 1) . ',
            "item": {
                "@type": "Product",
                "name": "' . addslashes($product->name) . '",
                "url": "' . route('products.show', $product->slug) . '",
                "image": "' . $product->main_image_url . '",
                "description": "' . addslashes($product->description) . '",
                "category": "' . addslashes($product->category->name ?? 'Home & Kitchen') . '",
                "brand": "' . addslashes($product->brand ?? 'Home & Kitchen Appliances') . '",
                "offers": {
                    "@type": "Offer",
                    "price": "' . $product->price . '",
                    "priceCurrency": "KES",
                    "availability": "' . ($product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock') . '"
                }
            }
        }';
    }
    $itemListJson = implode(',', $itemListElements);
@endphp
{!! '<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ItemList",
    "name": "Home & Kitchen Products",
    "description": "Premium home and kitchen appliances in Kenya",
    "url": "' . request()->url() . '",
    "numberOfItems": ' . $products->count() . ',
    "itemListElement": [
        ' . $itemListJson . '
    ]
}
</script>' !!}
@endsection

@section('content')
    <!-- Page Header - Enhanced -->
    <section class="bg-gradient-to-r from-blue-50 via-purple-50 to-blue-50 py-8 md:py-12 relative overflow-hidden">
        <div class="absolute inset-0 bg-grid-slate-100 opacity-30"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    @if($category)
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="{{ $category->icon }} text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">{{ $category->name }}</span>
                                </h1>
                                <p class="text-gray-600 mt-1 font-medium">Shop our collection of {{ strtolower($category->name) }}</p>
                            </div>
                        </div>
                    @else
                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">All Products</span>
                        </h1>
                        <p class="text-gray-600 font-medium">Discover our amazing collection of home and kitchen essentials</p>
                    @endif
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="hidden md:block bg-white/80 backdrop-blur-sm px-6 py-3 rounded-xl shadow-lg border-2 border-white/50">
                        <p class="text-sm font-semibold text-gray-700">
                            <span class="text-blue-600">{{ $products->firstItem() ?? 0 }}</span> - 
                            <span class="text-blue-600">{{ $products->lastItem() ?? 0 }}</span> of 
                            <span class="text-purple-600 font-bold">{{ $totalProducts }}</span> products
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-8">
            <!-- Filters Sidebar - Enhanced -->
            <div class="lg:col-span-1">
                <!-- Mobile Filter Toggle - Enhanced -->
                <div class="hidden mb-4">
                    <button id="mobile-filter-toggle" class="w-full flex items-center justify-between p-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl shadow-xl active:shadow-lg transition-all active:scale-[0.98]">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-filter text-lg"></i>
                            </div>
                            <div class="flex flex-col items-start">
                                <span class="font-bold text-lg">Filters</span>
                                @if(request()->hasAny(['search', 'category', 'min_price', 'max_price', 'rating', 'sort']))
                                    <span class="text-xs opacity-90">{{ count(array_filter(request()->only(['search', 'category', 'min_price', 'max_price', 'rating', 'sort']))) }} active</span>
                                @else
                                    <span class="text-xs opacity-90">Tap to filter</span>
                                @endif
                            </div>
                            @if(request()->hasAny(['search', 'category', 'min_price', 'max_price', 'rating', 'sort']))
                                <span class="bg-white text-blue-600 text-xs font-bold rounded-full px-3 py-1 ml-2">{{ count(array_filter(request()->only(['search', 'category', 'min_price', 'max_price', 'rating', 'sort']))) }}</span>
                            @endif
                        </div>
                        <i class="fas fa-chevron-down text-white text-lg transition-transform duration-300" id="filter-toggle-icon"></i>
                    </button>
                </div>

                <!-- Mobile Filters Drawer - Enhanced -->
                <div id="mobile-filters" class="lg:block hidden fixed inset-0 z-[100] lg:relative lg:z-auto">
                    <!-- Backdrop -->
                    <div id="mobile-filter-backdrop" class="lg:hidden fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>
                    
                    <!-- Filters Panel -->
                    <div class="lg:block fixed lg:relative bottom-0 left-0 right-0 lg:inset-auto bg-white rounded-t-3xl lg:rounded-2xl shadow-2xl lg:shadow-xl border-2 lg:border-2 border-gray-100 p-6 lg:p-6 max-h-[85vh] lg:max-h-none overflow-y-auto lg:overflow-visible lg:sticky lg:top-24 transform lg:transform-none transition-transform duration-300 ease-out translate-y-full lg:translate-y-0">
                        <!-- Mobile Header with Close Button -->
                        <div class="lg:hidden flex items-center justify-between mb-6 pb-4 border-b-2 border-gray-200 sticky top-0 bg-white z-10 -mt-2 -mx-6 px-6 pt-4">
                            <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                <i class="fas fa-filter text-blue-600 mr-2"></i>
                                Filters
                            </h3>
                            <button id="mobile-filter-close" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 transition-all active:scale-95">
                                <i class="fas fa-times text-lg"></i>
                            </button>
                        </div>
                        
                        <!-- Desktop Header -->
                        <div class="hidden lg:flex items-center justify-between mb-6 pb-4 border-b-2 border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                <i class="fas fa-filter text-blue-600 mr-2"></i>
                                Filters
                            </h3>
                            @if(request()->hasAny(['search', 'category', 'min_price', 'max_price', 'rating', 'sort']))
                                <a href="{{ route('products.index') }}" class="text-xs text-red-600 hover:text-red-700 font-semibold">
                                    Clear All
                                </a>
                            @endif
                        </div>
                        
                        <!-- Mobile Clear All Button -->
                        @if(request()->hasAny(['search', 'category', 'min_price', 'max_price', 'rating', 'sort']))
                            <div class="lg:hidden mb-4">
                                <a href="{{ route('products.index') }}" class="w-full flex items-center justify-center px-4 py-3 bg-red-50 border-2 border-red-200 text-red-600 rounded-xl font-semibold transition-all active:scale-95">
                                    <i class="fas fa-times-circle mr-2"></i>
                                    Clear All Filters
                                </a>
                            </div>
                        @endif

                    <!-- Search - Enhanced -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-search text-blue-600 mr-2"></i>
                            Search
                        </label>
                        <form method="GET" action="{{ route('products.index') }}">
                            <div class="relative">
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Search products..."
                                       class="w-full px-4 py-3 pl-11 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </form>
                    </div>

                    <!-- Categories - Enhanced -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-th-large text-purple-600 mr-2"></i>
                            Categories
                        </label>
                        <div class="space-y-2">
                            <a href="{{ route('products.index') }}"
                               class="flex items-center p-4 rounded-xl transition-all active:scale-95 {{ !request('category') ? 'bg-gradient-to-r from-blue-50 to-purple-50 border-2 border-blue-300 text-blue-700 font-semibold' : 'bg-gray-50 active:bg-gray-100 text-gray-700' }}">
                                <i class="fas fa-th text-base mr-3"></i>
                                <span class="text-base">All Categories</span>
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('products.index', ['category' => $cat->slug] + request()->except('category')) }}"
                                   class="flex items-center p-4 rounded-xl transition-all active:scale-95 {{ request('category') == $cat->slug ? 'bg-gradient-to-r from-blue-50 to-purple-50 border-2 border-blue-300 text-blue-700 font-semibold' : 'bg-gray-50 active:bg-gray-100 text-gray-700' }}">
                                    <i class="{{ $cat->icon }} text-base mr-3"></i>
                                    <span class="text-base flex-1">{{ $cat->name }}</span>
                                    @if(request('category') == $cat->slug)
                                        <i class="fas fa-check-circle text-blue-600 text-lg"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range - Enhanced -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-tags text-green-600 mr-2"></i>
                            Price Range
                        </label>
                        <form method="GET" action="{{ route('products.index') }}" id="price-form">
                            @if(request('min_price') || request('max_price'))
                                <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                                <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                            @endif
                            <div class="space-y-3">
                                <input type="range"
                                       id="price-range"
                                       min="{{ $minPrice }}"
                                       max="{{ $maxPrice }}"
                                       value="{{ request('max_price', $maxPrice) }}"
                                       class="w-full h-2 bg-gradient-to-r from-blue-200 to-purple-200 rounded-lg appearance-none cursor-pointer">
                                <div class="flex justify-between items-center bg-gradient-to-r from-blue-50 to-purple-50 px-4 py-2 rounded-xl">
                                    <span class="text-sm font-semibold text-gray-700">KES {{ number_format($minPrice, 0) }}</span>
                                    <span id="price-value" class="text-sm font-bold text-blue-600">KES {{ number_format(request('max_price', $maxPrice), 0) }}</span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Rating Filter - Enhanced -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-2"></i>
                            Rating
                        </label>
                        <div class="space-y-2">
                            @for($i = 5; $i >= 1; $i--)
                                <a href="{{ route('products.index', ['rating' => $i] + request()->except('rating')) }}"
                                   class="flex items-center justify-between p-4 rounded-xl transition-all active:scale-95 {{ request('rating') == $i ? 'bg-gradient-to-r from-yellow-50 to-orange-50 border-2 border-yellow-300' : 'bg-gray-50 active:bg-gray-100' }}">
                                    <div class="flex items-center">
                                        <div class="flex items-center mr-3">
                                            @for($star = 1; $star <= 5; $star++)
                                                <svg class="w-5 h-5 {{ $star <= $i ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                        <span class="text-base font-semibold {{ request('rating') == $i ? 'text-yellow-700' : 'text-gray-700' }}">{{ $i }}+ Stars</span>
                                    </div>
                                    @if(request('rating') == $i)
                                        <i class="fas fa-check-circle text-yellow-600 text-lg"></i>
                                    @endif
                                </a>
                            @endfor
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Featured Products Sidebar - Enhanced -->
                <div class="mt-6 lg:mt-8 hidden lg:block">
                    <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl border-2 border-gray-100 p-6">
                        <h3 class="text-lg font-bold mb-6 flex items-center text-gray-900">
                            <i class="fas fa-star text-yellow-500 mr-2"></i>
                            Featured Products
                        </h3>
                        <div class="space-y-4">
                            @foreach($featuredProducts as $product)
                                <a href="{{ route('products.show', $product->slug) }}" class="group block hover:bg-white rounded-xl p-3 -m-3 transition-all transform hover:-translate-y-1 hover:shadow-lg border-2 border-transparent hover:border-blue-200">
                                    <div class="flex space-x-3">
                                        <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl overflow-hidden flex-shrink-0 shadow-md group-hover:shadow-lg transition-shadow">
                                            <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 mb-1">{{ $product->name }}</h4>
                                            <p class="text-sm font-bold text-blue-600">{{ $product->formatted_price }}</p>
                                            @if($product->rating)
                                                <div class="flex items-center mt-1">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star text-xs {{ $i <= $product->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                                    @endfor
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid - Enhanced -->
            <div class="lg:col-span-3">
                <!-- Mobile Search Bar - Prominent -->
                <div class="md:hidden mb-4 sticky top-16 z-40 bg-white pb-3">
                    <form action="{{ route('products.index') }}" method="GET" class="flex gap-2 shadow-lg rounded-xl overflow-hidden border-2 border-gray-200">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Search products..." 
                               class="flex-1 px-4 py-3 text-sm border-0 focus:ring-0 focus:outline-none">
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-5 py-3">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Sort and View Options - Enhanced -->
                <div class="hidden md:flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl border-2 border-blue-100">
                    <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                        <span class="text-sm font-bold text-gray-700 flex items-center">
                            <i class="fas fa-sort text-blue-600 mr-2"></i>
                            Sort by:
                        </span>
                        <select name="sort"
                                onchange="window.location.href='{{ route('products.index') }}?sort=' + this.value + '&' + new URLSearchParams(window.location.search).toString().replace(/sort=[^&]*&?/g, '')"
                                class="text-sm font-semibold border-2 border-gray-200 rounded-xl px-4 py-2 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm hover:shadow-md transition-all cursor-pointer">
                            <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                        </select>
                    </div>

                    <div class="hidden md:flex items-center space-x-2 bg-white rounded-xl p-1 shadow-sm">
                        <button class="p-2 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-all" title="Grid View">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                        </button>
                        <button class="p-2 rounded-lg text-blue-600 bg-blue-50" title="List View">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Products Grid -->
                @if($products->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                        @foreach($products as $product)
                            <div class="transform hover:scale-105 transition-transform duration-300">
                                <x-product-card :product="$product" />
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination - Enhanced -->
                    <div class="mt-10 flex justify-center">
                        <div class="bg-white rounded-xl shadow-lg border-2 border-gray-100 p-2">
                            {{ $products->links() }}
                        </div>
                    </div>
                @else
                    <!-- No Products Found - Enhanced -->
                    <div class="text-center py-16 bg-gradient-to-br from-gray-50 to-white rounded-2xl border-2 border-gray-200">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-search text-4xl text-blue-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">No products found</h3>
                        <p class="text-gray-600 mb-6 font-medium">Try adjusting your search or filter criteria.</p>
                        <div class="flex flex-row gap-3 justify-center items-center">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center px-5 py-2.5 sm:px-6 sm:py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-sm sm:text-base whitespace-nowrap">
                                <i class="fas fa-times-circle mr-2 text-sm"></i>
                                Clear Filters
                            </a>
                            <a href="{{ route('home') }}" class="inline-flex items-center px-5 py-2.5 sm:px-6 sm:py-3 bg-white border-2 border-gray-300 text-gray-700 font-bold rounded-xl hover:border-gray-400 transition-all shadow-sm hover:shadow-md text-sm sm:text-base whitespace-nowrap">
                                <i class="fas fa-home mr-2 text-sm"></i>
                                Go Home
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Price range slider
    const priceRange = document.getElementById('price-range');
    const priceValue = document.getElementById('price-value');
    const priceForm = document.getElementById('price-form');

    if (priceRange && priceValue) {
        priceRange.addEventListener('input', function() {
            const value = this.value;
            priceValue.textContent = 'KES ' + parseInt(value).toLocaleString();
        });

        priceRange.addEventListener('change', function() {
            const url = new URL(window.location);
            url.searchParams.set('max_price', this.value);
            window.location.href = url.toString();
        });
    }
});
</script>
@endpush
