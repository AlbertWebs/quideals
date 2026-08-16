@extends('layouts.app')

@section('title', 'Home & Kitchen Appliances - Quality Products for Your Home')
@section('description', 'Shop premium home and kitchen appliances in Kenya. Discover quality cookware, kitchen gadgets, home essentials and more at competitive prices.')
@section('keywords', 'home appliances Kenya, kitchen appliances, cookware, kitchen gadgets, home essentials, kitchenware Nairobi')
@section('og_title', 'Home & Kitchen Appliances - Quality Products for Your Home')
@section('og_description', 'Shop premium home and kitchen appliances in Kenya. Discover quality cookware, kitchen gadgets, home essentials and more.')
@section('og_type', 'website')
@section('og_image', \App\Models\Setting::logoUrl())

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
    "logo": "' . \App\Models\Setting::logoUrl() . '",
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
    <!-- Hero Section -->
    @php
        $heroProduct = $featuredProducts->first() ?? $trendingProducts->first();
        $heroCategories = $categories->take(4);
    @endphp
    <section class="relative bg-[#F8FAFC] py-12 md:py-20 lg:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 lg:items-stretch">
                <div class="lg:col-span-6 text-center lg:text-left flex flex-col justify-center">
                    <p class="inline-flex items-center gap-2 mb-5 text-xs sm:text-sm font-semibold tracking-wide uppercase text-brand-navy">
                        <span class="inline-block w-2 h-2 rounded-full bg-brand-green"></span>
                        Kenya’s home & kitchen deals
                    </p>
                    <h1 class="text-4xl sm:text-5xl lg:text-[3.4rem] font-extrabold text-brand-navy leading-[1.12] tracking-tight">
                        Better prices on the appliances you actually need
                    </h1>
                    <p class="mt-5 text-base sm:text-lg text-gray-600 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Shop cookware, kitchen gadgets, and home essentials with clear deals, trusted brands, and fast delivery.
                    </p>

                    <form action="{{ route('products.index') }}" method="GET" class="mt-7 flex w-full max-w-xl mx-auto lg:mx-0 overflow-hidden rounded-xl border border-gray-200 bg-white focus-within:border-brand-green">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search products, brands, or deals..."
                               class="flex-1 min-w-0 px-4 py-3.5 text-sm text-brand-navy border-0 outline-none focus:ring-0">
                        <button type="submit" class="px-5 bg-brand-green text-white hover:bg-brand-deep-green transition-colors">
                            <i class="fas fa-search"></i>
                            <span class="sr-only">Search</span>
                        </button>
                    </form>

                    <div class="mt-6 flex flex-row gap-3 justify-center lg:justify-start">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-brand-green text-white font-semibold rounded-xl hover:bg-brand-deep-green transition-colors text-sm sm:text-base">
                            Explore deals
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                        <a href="#categories" class="inline-flex items-center justify-center px-6 py-3 bg-white text-brand-navy font-semibold rounded-xl border border-gray-200 hover:border-brand-green hover:bg-brand-green-light transition-colors text-sm sm:text-base">
                            Browse categories
                        </a>
                    </div>

                    <div class="mt-8 grid grid-cols-3 max-w-md mx-auto lg:mx-0 divide-x divide-gray-200">
                        <div class="pr-4">
                            <p class="text-xl sm:text-2xl font-extrabold text-brand-navy">{{ $categories->count() }}+</p>
                            <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Categories</p>
                        </div>
                        <div class="px-4">
                            <p class="text-xl sm:text-2xl font-extrabold text-brand-navy">Free</p>
                            <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Delivery*</p>
                        </div>
                        <div class="pl-4">
                            <p class="text-xl sm:text-2xl font-extrabold text-brand-navy">24/7</p>
                            <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Support</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6 flex">
                    @if($heroProduct)
                        <div class="relative w-full bg-brand-navy rounded-3xl p-3 sm:p-4">
                            <span class="absolute -top-3 left-5 z-10 inline-flex items-center px-3 py-1 rounded-full bg-brand-lime text-brand-navy text-xs font-bold">
                                Featured deal
                            </span>
                            <a href="{{ route('products.show', $heroProduct->slug) }}" class="flex h-full w-full flex-col sm:flex-row bg-white rounded-2xl overflow-hidden">
                                <div class="sm:w-[46%] bg-slate-50 flex items-center justify-center p-4 sm:p-5 min-h-[160px] sm:min-h-0">
                                    <img src="{{ $heroProduct->main_image_url }}"
                                         alt="{{ $heroProduct->name }}"
                                         class="max-h-36 sm:max-h-48 w-auto object-contain">
                                </div>
                                <div class="flex-1 p-4 sm:p-5 flex flex-col justify-center text-left">
                                    @if($heroProduct->category)
                                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1">{{ $heroProduct->category->name }}</p>
                                    @endif
                                    <h2 class="text-base sm:text-lg font-bold text-brand-navy line-clamp-2">{{ $heroProduct->name }}</h2>
                                    <div class="mt-2 flex items-end gap-2">
                                        <span class="text-xl font-extrabold text-brand-green">{{ $heroProduct->formatted_price }}</span>
                                        @if($heroProduct->old_price)
                                            <span class="text-sm text-gray-500 line-through">{{ $heroProduct->formatted_old_price }}</span>
                                        @endif
                                    </div>
                                    <span class="mt-4 inline-flex items-center text-sm font-semibold text-brand-navy">
                                        View deal
                                        <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-2 gap-3">
                            @foreach($heroCategories as $category)
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="bg-white rounded-2xl border border-gray-200 p-6 text-center hover:border-brand-green/45 transition-colors">
                                    <div class="mx-auto mb-3 w-12 h-12 rounded-full bg-brand-green-light flex items-center justify-center text-brand-navy">
                                        <i class="{{ $category->icon }} text-lg"></i>
                                    </div>
                                    <span class="text-sm font-bold text-brand-navy">{{ $category->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section - Enhanced -->
    <section class="py-16 md:py-20 bg-gradient-to-b from-white to-slate-50 relative">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-extrabold text-brand-navy mb-2">
                    Featured Products
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
                    <a href="{{ route('products.index', ['sort' => 'featured']) }}" class="inline-flex items-center px-6 py-3 sm:px-10 sm:py-4 bg-brand-green text-white font-bold rounded-xl hover:bg-brand-deep-green transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-sm sm:text-lg">
                        <span>View All Featured</span>
                        <i class="fas fa-arrow-right ml-2 sm:ml-3 text-sm sm:text-base"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Categories Section - Enhanced -->
    <section id="categories" class="py-16 md:py-20 bg-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-lime via-brand-green to-brand-deep-green"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-5">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-green to-brand-deep-green">Shop by Category</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto font-medium">Explore our wide range of home and kitchen essentials</p>
            </div>

            <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
                @foreach($categories->take(12) as $index => $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group text-center block p-6 md:p-8 rounded-2xl border-3 border-gray-200 hover:border-brand-green/45 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 bg-gradient-to-br from-white to-slate-50 hover:from-brand-green-light hover:to-brand-green-soft">
                        <div class="w-20 h-20 md:w-24 md:h-24 mx-auto mb-4 bg-gradient-to-br from-brand-green-light via-white to-brand-green-soft rounded-full flex items-center justify-center group-hover:from-brand-green-soft group-hover:via-brand-green-light group-hover:to-brand-green-soft transition-all duration-500 shadow-lg group-hover:shadow-xl transform group-hover:scale-110 group-hover:rotate-6">
                            <i class="{{ $category->icon }} text-3xl md:text-4xl text-brand-green group-hover:text-brand-deep-green transition-colors"></i>
                        </div>
                        <p class="text-sm md:text-base font-bold text-gray-800 group-hover:text-brand-deep-green transition-colors">{{ $category->name }}</p>
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
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 sm:px-10 sm:py-4 bg-gradient-to-r from-brand-green to-brand-deep-green text-white font-bold rounded-xl hover:from-brand-deep-green hover:to-brand-deep-green transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-sm sm:text-lg">
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
                <div class="text-center p-8 rounded-3xl bg-gradient-to-br from-brand-green-light via-brand-green-soft to-brand-green-light border-3 border-brand-green-soft shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-brand-green to-brand-deep-green rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg transform hover:scale-110 transition-transform">
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
                
                <div class="text-center p-8 rounded-3xl bg-gradient-to-br from-slate-50 via-white to-brand-green-light border-3 border-slate-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="w-20 h-20 bg-gradient-to-br from-brand-navy to-[#002C55] rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg transform hover:scale-110 transition-transform">
                        <i class="fas fa-headset text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">24/7 Support</h3>
                    <p class="text-gray-700 font-medium">We're here to help anytime</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Grids Section - Enhanced -->
    <section class="hidden md:block py-16 md:py-20 bg-gradient-to-b from-white to-slate-50">
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
                        <div class="w-12 h-12 bg-brand-navy rounded-full flex items-center justify-center mr-3 shadow-lg">
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
                        <div class="w-12 h-12 bg-gradient-to-br from-brand-green to-brand-deep-green rounded-full flex items-center justify-center mr-3 shadow-lg">
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
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-lime via-brand-green to-brand-deep-green"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-5">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-green to-brand-deep-green">Shop by Brand</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto font-medium">Discover products from trusted brands</p>
            </div>

            <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                @php
                    $brands = \App\Models\Brand::active()->ordered()->take(20)->get();
                @endphp
                @foreach($brands as $brand)
                    <a href="{{ route('products.index', ['brand' => $brand->slug]) }}" class="group text-center block p-6 md:p-8 rounded-2xl border-2 border-gray-200 hover:border-brand-green/45 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 bg-gradient-to-br from-white to-slate-50 hover:from-brand-green-light hover:to-brand-green-soft">
                        @if($brand->logo)
                            <div class="w-20 h-20 md:w-24 md:h-24 mx-auto mb-4 bg-white rounded-full flex items-center justify-center group-hover:bg-gradient-to-br group-hover:from-brand-green-light group-hover:via-brand-green-soft group-hover:to-brand-green-light transition-all duration-500 shadow-lg group-hover:shadow-xl transform group-hover:scale-110 p-2">
                                <img src="{{ $brand->logo }}" alt="{{ $brand->name }}" class="w-full h-full object-contain">
                            </div>
                        @else
                            <div class="w-20 h-20 md:w-24 md:h-24 mx-auto mb-4 bg-gradient-to-br from-brand-green-light via-white to-brand-green-soft rounded-full flex items-center justify-center group-hover:from-brand-green-soft group-hover:via-brand-green-light group-hover:to-brand-green-soft transition-all duration-500 shadow-lg group-hover:shadow-xl transform group-hover:scale-110 group-hover:rotate-6">
                                <i class="fas fa-certificate text-3xl md:text-4xl text-brand-green group-hover:text-brand-deep-green transition-colors"></i>
                            </div>
                        @endif
                        <p class="text-sm md:text-base font-bold text-gray-800 group-hover:text-brand-deep-green transition-colors">{{ $brand->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Banner - Enhanced -->
    <section class="pt-16 md:pt-20 pb-0 bg-brand-navy-gradient relative overflow-hidden" style="margin-bottom: 0 !important;">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full mix-blend-overlay filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full mix-blend-overlay filter blur-3xl"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pb-16 md:pb-20" style="margin-bottom: 0 !important;">
            <div class="text-center text-white">
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 drop-shadow-lg">Ready to Upgrade Your Home?</h2>
                <p class="text-xl md:text-2xl mb-10 opacity-95 font-medium max-w-2xl mx-auto">Discover our exclusive collection of premium home and kitchen appliances</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 sm:px-12 sm:py-6 bg-white text-brand-green font-bold rounded-xl hover:bg-gray-100 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-0.5 hover:scale-105 text-sm sm:text-lg">
                    <span>Start Shopping</span>
                    <i class="fas fa-arrow-right ml-2 sm:ml-3 text-sm sm:text-base"></i>
                </a>
            </div>
        </div>
    </section>
@endsection
