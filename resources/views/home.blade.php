@extends('layouts.app')

@section('title', 'Home & Kitchen Appliances - Quality Products for Your Home')
@section('description', 'Shop premium home and kitchen appliances in Kenya. Discover quality cookware, kitchen gadgets, home essentials and more at competitive prices.')
@section('keywords', 'home appliances Kenya, kitchen appliances, cookware, kitchen gadgets, home essentials, kitchenware Nairobi')
@section('og_title', 'Home & Kitchen Appliances - Quality Products for Your Home')
@section('og_description', 'Shop premium home and kitchen appliances in Kenya. Discover quality cookware, kitchen gadgets, home essentials and more.')
@section('og_type', 'website')
@section('og_image', asset('images/logo.svg'))

@push('styles')
<style>
    /* Remove bottom padding from main on home page to eliminate gap */
    main {
        padding-bottom: 0 !important;
    }
</style>
@endpush

@section('structured_data')
@php
    $socialUrls = \App\Helpers\SocialMediaHelper::getSameAsArray();
    $sameAsJson = '';
    if (!empty($socialUrls)) {
        $sameAsJson = '"' . implode('","', $socialUrls) . '"';
    } else {
        $sameAsJson = '"https://example.com"';
    }
@endphp
{!! '<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Home & Kitchen Appliances",
    "url": "' . url('/') . '",
    "logo": "' . asset('images/logo.svg') . '",
    "description": "Your trusted source for quality home and kitchen appliances in Kenya",
    "address": {
        "@type": "PostalAddress",
        "addressCountry": "KE",
        "addressLocality": "Nairobi"
    },
    "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "customer service"
    },
    "sameAs": [
        ' . $sameAsJson . '
    ]
}
</script>' !!}

{!! '<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "Home & Kitchen Appliances",
    "url": "' . url('/') . '",
    "potentialAction": {
        "@type": "SearchAction",
        "target": "' . url('/products') . '?search={search_term_string}",
        "query-input": "required name=search_term_string"
    }
}
</script>' !!}
@endsection

@section('content')
    <!-- Hero Section - Enhanced & Eye-Catching -->
    <section class="relative bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-16 md:py-24 lg:py-32 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.6))] -z-10"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 left-0 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Left Content -->
                <div class="text-center lg:text-left space-y-8 animate-fade-in-up">
                    <div class="inline-block animate-bounce-subtle">
                        <span class="inline-flex items-center px-5 py-3 rounded-full text-sm font-semibold bg-gradient-to-r from-blue-500 to-purple-500 text-white shadow-lg shadow-blue-500/50 border-2 border-white/20">
                            <i class="fas fa-home mr-2 text-lg"></i>
                            Premium Home & Kitchen Essentials
                        </span>
                    </div>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-gray-900 leading-tight tracking-tight">
                        Transform Your Home
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 mt-3 animate-gradient">
                            With Quality Appliances
                        </span>
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-700 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-medium">
                        Discover premium kitchen appliances, cookware, and home essentials designed to elevate your everyday living experience.
                    </p>
                    <div class="flex flex-row gap-2 sm:gap-5 justify-center lg:justify-start">
                        <a href="{{ route('products.index') }}" class="group flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2.5 sm:px-10 sm:py-5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-xl shadow-blue-500/50 hover:shadow-2xl hover:shadow-blue-600/60 transform hover:-translate-y-0.5 hover:scale-105 text-xs sm:text-lg">
                            <span>Shop Now</span>
                            <i class="fas fa-arrow-right ml-1.5 sm:ml-3 group-hover:translate-x-1 transition-transform text-xs sm:text-base"></i>
                        </a>
                        <a href="#categories" class="group flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2.5 sm:px-10 sm:py-5 bg-white text-gray-800 font-bold rounded-xl border-2 sm:border-3 border-gray-300 hover:border-blue-500 hover:bg-blue-50 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-xs sm:text-lg">
                            <span class="hidden sm:inline">Browse Categories</span>
                            <span class="sm:hidden">Browse</span>
                            <i class="fas fa-chevron-down ml-1.5 sm:ml-3 group-hover:translate-y-1 transition-transform text-xs sm:text-base"></i>
                        </a>
                    </div>
                    <!-- Trust Indicators - Enhanced -->
                    <div class="hidden md:flex flex-wrap items-center justify-center lg:justify-start gap-8 pt-6">
                        <div class="flex items-center space-x-3 bg-white/80 backdrop-blur-sm px-5 py-3 rounded-full shadow-md hover:shadow-lg transition-shadow">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-shipping-fast text-blue-600 text-lg"></i>
                            </div>
                            <span class="text-base font-semibold text-gray-800">Free Shipping</span>
                        </div>
                        <div class="flex items-center space-x-3 bg-white/80 backdrop-blur-sm px-5 py-3 rounded-full shadow-md hover:shadow-lg transition-shadow">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-shield-alt text-green-600 text-lg"></i>
                            </div>
                            <span class="text-base font-semibold text-gray-800">Quality Guaranteed</span>
                        </div>
                        <div class="flex items-center space-x-3 bg-white/80 backdrop-blur-sm px-5 py-3 rounded-full shadow-md hover:shadow-lg transition-shadow">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-headset text-purple-600 text-lg"></i>
                            </div>
                            <span class="text-base font-semibold text-gray-800">24/7 Support</span>
                        </div>
                    </div>
                </div>
                
                <!-- Right Image/Visual - Enhanced -->
                <div class="relative hidden lg:block animate-fade-in-right">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 rounded-3xl transform rotate-6 opacity-30 blur-2xl animate-pulse-slow"></div>
                        <div class="relative bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl p-10 border-2 border-white/50 transform hover:scale-105 transition-transform duration-500">
                            <div class="grid grid-cols-2 gap-6">
                                <div class="bg-gradient-to-br from-blue-100 via-blue-50 to-blue-100 rounded-2xl p-8 flex flex-col items-center justify-center space-y-3 transform hover:scale-110 transition-transform duration-300 shadow-lg hover:shadow-xl border-2 border-blue-200">
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg">
                                        <i class="fas fa-blender text-white text-3xl"></i>
                                    </div>
                                    <span class="text-base font-bold text-gray-800">Kitchen</span>
                                </div>
                                <div class="bg-gradient-to-br from-purple-100 via-purple-50 to-purple-100 rounded-2xl p-8 flex flex-col items-center justify-center space-y-3 transform hover:scale-110 transition-transform duration-300 shadow-lg hover:shadow-xl border-2 border-purple-200">
                                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                                        <i class="fas fa-couch text-white text-3xl"></i>
                                    </div>
                                    <span class="text-base font-bold text-gray-800">Home</span>
                                </div>
                                <div class="bg-gradient-to-br from-green-100 via-green-50 to-green-100 rounded-2xl p-8 flex flex-col items-center justify-center space-y-3 transform hover:scale-110 transition-transform duration-300 shadow-lg hover:shadow-xl border-2 border-green-200">
                                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center shadow-lg">
                                        <i class="fas fa-fire text-white text-3xl"></i>
                                    </div>
                                    <span class="text-base font-bold text-gray-800">Appliances</span>
                                </div>
                                <div class="bg-gradient-to-br from-orange-100 via-orange-50 to-orange-100 rounded-2xl p-8 flex flex-col items-center justify-center space-y-3 transform hover:scale-110 transition-transform duration-300 shadow-lg hover:shadow-xl border-2 border-orange-200">
                                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center shadow-lg">
                                        <i class="fas fa-utensils text-white text-3xl"></i>
                                    </div>
                                    <span class="text-base font-bold text-gray-800">Cookware</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section - Enhanced -->
    <section class="py-16 md:py-20 bg-gradient-to-b from-white to-gray-50 relative">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div class="inline-block mb-2">
                    <span class="px-4 py-2 bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-full text-sm font-bold shadow-lg">
                        ⭐ FEATURED
                    </span>
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-2">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-600 via-orange-600 to-red-600">Featured Products</span>
                </h2>
                <p class="text-xl text-gray-600 font-medium">Handpicked premium selections for you</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 md:gap-6">
                @foreach($featuredProducts as $product)
                    <div class="transform hover:scale-105 transition-transform duration-300">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>

            @if($featuredProducts->count() > 0)
                <div class="text-center mt-8 sm:mt-12">
                    <a href="{{ route('products.index', ['sort' => 'featured']) }}" class="inline-flex items-center px-6 py-3 sm:px-10 sm:py-4 bg-gradient-to-r from-yellow-600 to-orange-600 text-white font-bold rounded-xl hover:from-yellow-700 hover:to-orange-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-sm sm:text-lg">
                        <span>View All Featured</span>
                        <i class="fas fa-arrow-right ml-2 sm:ml-3 text-sm sm:text-base"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Categories Section - Enhanced -->
    <section id="categories" class="py-16 md:py-20 bg-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-5">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Shop by Category</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto font-medium">Explore our wide range of home and kitchen essentials</p>
            </div>

            <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
                @foreach($categories->take(12) as $index => $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group text-center block p-6 md:p-8 rounded-2xl border-3 border-gray-200 hover:border-blue-400 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 bg-gradient-to-br from-white to-gray-50 hover:from-blue-50 hover:to-purple-50">
                        <div class="w-20 h-20 md:w-24 md:h-24 mx-auto mb-4 bg-gradient-to-br from-blue-100 via-blue-50 to-purple-100 rounded-full flex items-center justify-center group-hover:from-blue-200 group-hover:via-purple-100 group-hover:to-pink-100 transition-all duration-500 shadow-lg group-hover:shadow-xl transform group-hover:scale-110 group-hover:rotate-6">
                            <i class="{{ $category->icon }} text-3xl md:text-4xl text-blue-600 group-hover:text-purple-600 transition-colors"></i>
                        </div>
                        <p class="text-sm md:text-base font-bold text-gray-800 group-hover:text-blue-600 transition-colors">{{ $category->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Trending Products - Enhanced -->
    <section class="py-16 md:py-20 bg-gradient-to-b from-gray-50 to-white relative">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div class="inline-block mb-4">
                    <span class="px-4 py-2 bg-gradient-to-r from-orange-400 to-red-500 text-white rounded-full text-sm font-bold shadow-lg">
                        🔥 HOT DEALS
                    </span>
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-5">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 via-red-600 to-pink-600">Trending Products</span>
                </h2>
                <p class="text-xl text-gray-600 font-medium">Most popular items this week</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 md:gap-6">
                @foreach($trendingProducts as $product)
                    <div class="transform hover:scale-105 transition-transform duration-300">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8 sm:mt-12">
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 sm:px-10 sm:py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-sm sm:text-lg">
                    <span>View All Products</span>
                    <i class="fas fa-arrow-right ml-2 sm:ml-3 text-sm sm:text-base"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section - Enhanced -->
    <section class="hidden md:block py-16 md:py-20 bg-white relative">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10">
                <div class="text-center p-8 rounded-3xl bg-gradient-to-br from-blue-50 via-blue-100 to-blue-50 border-3 border-blue-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg transform hover:scale-110 transition-transform">
                        <i class="fas fa-shipping-fast text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Free Shipping</h3>
                    <p class="text-gray-700 font-medium">Free delivery on orders over KES 50,000</p>
                </div>
                
                <div class="text-center p-8 rounded-3xl bg-gradient-to-br from-green-50 via-green-100 to-green-50 border-3 border-green-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg transform hover:scale-110 transition-transform">
                        <i class="fas fa-shield-alt text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Quality Guaranteed</h3>
                    <p class="text-gray-700 font-medium">Premium products with warranty</p>
                </div>
                
                <div class="text-center p-8 rounded-3xl bg-gradient-to-br from-purple-50 via-purple-100 to-purple-50 border-3 border-purple-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg transform hover:scale-110 transition-transform">
                        <i class="fas fa-headset text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">24/7 Support</h3>
                    <p class="text-gray-700 font-medium">We're here to help anytime</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Grids Section - Enhanced -->
    <section class="hidden md:block py-16 md:py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                <!-- Top Seller -->
                <div class="bg-white rounded-2xl border-2 border-gray-200 p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <h3 class="text-2xl font-bold mb-8 text-gray-900 flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-red-500 rounded-full flex items-center justify-center mr-3 shadow-lg">
                            <i class="fas fa-fire text-white text-xl"></i>
                        </div>
                        Top Sellers
                    </h3>
                    <div class="space-y-5">
                        @foreach($topSellers as $product)
                            <div class="transform hover:scale-105 transition-transform duration-300">
                                <x-product-card :product="$product" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Featured Products -->
                <div class="bg-white rounded-2xl border-2 border-gray-200 p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <h3 class="text-2xl font-bold mb-8 text-gray-900 flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center mr-3 shadow-lg">
                            <i class="fas fa-star text-white text-xl"></i>
                        </div>
                        Featured Products
                    </h3>
                    <div class="space-y-5">
                        @foreach($featuredProducts as $product)
                            <div class="transform hover:scale-105 transition-transform duration-300">
                                <x-product-card :product="$product" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Products -->
                <div class="bg-white rounded-2xl border-2 border-gray-200 p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <h3 class="text-2xl font-bold mb-8 text-gray-900 flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center mr-3 shadow-lg">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                        New Arrivals
                    </h3>
                    <div class="space-y-5">
                        @foreach($recentProducts as $product)
                            <div class="transform hover:scale-105 transition-transform duration-300">
                                <x-product-card :product="$product" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands Section - Enhanced -->
    <section class="py-16 md:py-20 bg-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-5">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Shop by Brand</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto font-medium">Discover products from trusted brands</p>
            </div>

            <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                @php
                    $brands = \App\Models\Brand::active()->ordered()->take(20)->get();
                @endphp
                @foreach($brands as $brand)
                    <a href="{{ route('products.index', ['brand' => $brand->slug]) }}" class="group text-center block p-6 md:p-8 rounded-2xl border-2 border-gray-200 hover:border-blue-400 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 bg-gradient-to-br from-white to-gray-50 hover:from-blue-50 hover:to-purple-50">
                        @if($brand->logo)
                            <div class="w-20 h-20 md:w-24 md:h-24 mx-auto mb-4 bg-white rounded-full flex items-center justify-center group-hover:bg-gradient-to-br group-hover:from-blue-100 group-hover:via-purple-100 group-hover:to-pink-100 transition-all duration-500 shadow-lg group-hover:shadow-xl transform group-hover:scale-110 p-2">
                                <img src="{{ $brand->logo }}" alt="{{ $brand->name }}" class="w-full h-full object-contain">
                            </div>
                        @else
                            <div class="w-20 h-20 md:w-24 md:h-24 mx-auto mb-4 bg-gradient-to-br from-blue-100 via-blue-50 to-purple-100 rounded-full flex items-center justify-center group-hover:from-blue-200 group-hover:via-purple-100 group-hover:to-pink-100 transition-all duration-500 shadow-lg group-hover:shadow-xl transform group-hover:scale-110 group-hover:rotate-6">
                                <i class="fas fa-certificate text-3xl md:text-4xl text-blue-600 group-hover:text-purple-600 transition-colors"></i>
                            </div>
                        @endif
                        <p class="text-sm md:text-base font-bold text-gray-800 group-hover:text-blue-600 transition-colors">{{ $brand->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Banner - Enhanced -->
    <section class="pt-16 md:pt-20 pb-0 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 relative overflow-hidden" style="margin-bottom: 0 !important;">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full mix-blend-overlay filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full mix-blend-overlay filter blur-3xl"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pb-16 md:pb-20" style="margin-bottom: 0 !important;">
            <div class="text-center text-white">
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 drop-shadow-lg">Ready to Upgrade Your Home?</h2>
                <p class="text-xl md:text-2xl mb-10 opacity-95 font-medium max-w-2xl mx-auto">Discover our exclusive collection of premium home and kitchen appliances</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 sm:px-12 sm:py-6 bg-white text-blue-600 font-bold rounded-xl hover:bg-gray-100 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-0.5 hover:scale-105 text-sm sm:text-lg">
                    <span>Start Shopping</span>
                    <i class="fas fa-arrow-right ml-2 sm:ml-3 text-sm sm:text-base"></i>
                </a>
            </div>
        </div>
    </section>
@endsection
