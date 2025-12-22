@php
use App\Models\Setting;
use App\Helpers\SocialMediaHelper;
@endphp

<!-- Footer Top Bar -->
<div class="hidden md:block bg-gray-800 pt-0 pb-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-8 py-2 md:py-0">
            <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-3 text-center md:text-left space-y-1 md:space-y-0">
                <i class="fas fa-shipping-fast text-white text-sm md:text-xl mb-0.5 md:mb-0"></i>
                <div>
                    <h4 class="text-white font-semibold text-[10px] md:text-base leading-tight">{{ Setting::get('footer_free_delivery_title', 'FREE DELIVERY') }}</h4>
                    <p class="text-gray-300 text-[9px] md:text-sm leading-tight mt-0.5">{{ Setting::get('footer_free_delivery_text', 'On orders over KES 5,000') }}</p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-3 text-center md:text-left space-y-1 md:space-y-0">
                <i class="fas fa-credit-card text-white text-sm md:text-xl mb-0.5 md:mb-0"></i>
                <div>
                    <h4 class="text-white font-semibold text-[10px] md:text-base leading-tight">{{ Setting::get('footer_secure_checkout_title', 'SECURE CHECKOUT') }}</h4>
                    <p class="text-gray-300 text-[9px] md:text-sm leading-tight mt-0.5">{{ Setting::get('footer_secure_checkout_text', 'Shop safely and confidently') }}</p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-3 text-center md:text-left space-y-1 md:space-y-0">
                <i class="fas fa-sync-alt text-white text-sm md:text-xl mb-0.5 md:mb-0"></i>
                <div>
                    <h4 class="text-white font-semibold text-[10px] md:text-base leading-tight">{{ Setting::get('footer_easy_returns_title', 'EASY RETURNS') }}</h4>
                    <p class="text-gray-300 text-[9px] md:text-sm leading-tight mt-0.5">{{ Setting::get('footer_easy_returns_text', '15-day return window') }}</p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-3 text-center md:text-left space-y-1 md:space-y-0">
                <i class="fas fa-headset text-white text-sm md:text-xl mb-0.5 md:mb-0"></i>
                <div>
                    <h4 class="text-white font-semibold text-[10px] md:text-base leading-tight">{{ Setting::get('footer_customer_care_title', 'CUSTOMER CARE') }}</h4>
                    <p class="text-gray-300 text-[9px] md:text-sm leading-tight mt-0.5">{{ Setting::get('footer_customer_care_text', 'We\'re here 24/7') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Footer -->
<footer class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8">
            <!-- Company Info -->
            <div class="col-span-2 md:col-span-1 lg:col-span-1">
                <h3 class="text-xl md:text-2xl font-bold text-blue-500 mb-3 md:mb-4 flex items-center">
                    <i class="fas fa-home mr-2"></i>
                    <span class="text-sm md:text-2xl">{{ Setting::get('site_name', config('app.name', 'Home & Kitchen Appliances')) }}</span>
                </h3>
                <p class="text-gray-400 mb-2 md:mb-4 text-xs md:text-base">{{ Setting::get('contact_address', 'Westlands, Nairobi') }}, {{ Setting::get('contact_city', 'Kenya') }}</p>
                <p class="text-gray-400 mb-1 md:mb-2 text-xs md:text-base">{{ Setting::get('contact_phone', '+254 700 123 456') }}</p>
                <p class="text-gray-400 mb-4 md:mb-6 text-xs md:text-base">{{ Setting::get('contact_email', 'hello@homekitchen.com') }}</p>

                <!-- Social Media -->
                <div class="flex space-x-3 md:space-x-4">
                    @php
                        $socialUrls = SocialMediaHelper::getSocialMediaUrls();
                    @endphp

                    @if(isset($socialUrls['facebook']))
                        <a href="{{ $socialUrls['facebook'] }}" target="_blank" class="text-gray-400 hover:text-white text-sm md:text-base"><i class="fab fa-facebook-f"></i></a>
                    @endif

                    @if(isset($socialUrls['twitter']))
                        <a href="{{ $socialUrls['twitter'] }}" target="_blank" class="text-gray-400 hover:text-white text-sm md:text-base"><i class="fab fa-twitter"></i></a>
                    @endif

                    @if(isset($socialUrls['instagram']))
                        <a href="{{ $socialUrls['instagram'] }}" target="_blank" class="text-gray-400 hover:text-white text-sm md:text-base"><i class="fab fa-instagram"></i></a>
                    @endif

                    @if(isset($socialUrls['linkedin']))
                        <a href="{{ $socialUrls['linkedin'] }}" target="_blank" class="text-gray-400 hover:text-white text-sm md:text-base"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>

            <!-- Support Links -->
            <div class="col-span-1 md:col-span-1 lg:col-span-1">
                <h4 class="text-sm md:text-lg font-semibold mb-2 md:mb-4">SUPPORT</h4>
                <ul class="space-y-1 md:space-y-2">
                    <li><a href="{{ route('pages.contact') }}" class="text-gray-400 hover:text-white text-xs md:text-base">Contact Us</a></li>
                    <li><a href="{{ route('pages.about') }}" class="text-gray-400 hover:text-white text-xs md:text-base">About Us</a></li>
                    <li><a href="{{ route('pages.technical-support') }}" class="text-gray-400 hover:text-white text-xs md:text-base">Customer Support</a></li>
                    <li><a href="{{ route('pages.shipping-returns') }}" class="text-gray-400 hover:text-white text-xs md:text-base">Shipping & Returns</a></li>
                    <li><a href="{{ route('pages.faq') }}" class="text-gray-400 hover:text-white text-xs md:text-base">FAQs</a></li>
                    <li><a href="{{ route('pages.privacy') }}" class="text-gray-400 hover:text-white text-xs md:text-base">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Shop Links -->
            <div class="col-span-1 md:col-span-1 lg:col-span-1">
                <h4 class="text-sm md:text-lg font-semibold mb-2 md:mb-4">SHOP</h4>
                <ul class="space-y-1 md:space-y-2">
                    @php
                        $shopCategories = \App\Models\Category::active()->ordered()->take(5)->get();
                    @endphp
                    @foreach($shopCategories as $category)
                        <li><a href="{{ route('products.index', ['category' => $category->slug]) }}" class="text-gray-400 hover:text-white flex items-center text-xs md:text-base">
                            <i class="{{ $category->icon }} mr-1 md:mr-2 text-xs md:text-sm"></i>
                            {{ $category->name }}
                        </a></li>
                    @endforeach
                    <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white text-xs md:text-base">View All Products</a></li>
                </ul>
            </div>

            <!-- Subscribe -->
            <div class="col-span-2 md:col-span-2 lg:col-span-1">
                <h4 class="text-sm md:text-lg font-semibold mb-2 md:mb-4">{{ Setting::get('footer_subscribe_title', 'SUBSCRIBE') }}</h4>
                <p class="text-gray-400 mb-3 md:mb-4 text-xs md:text-base">{{ Setting::get('footer_subscribe_text', 'Get the latest deals, product updates, and exclusive offers delivered to your inbox.') 

                <!-- Email Subscription -->
                <div class="flex mb-4 md:mb-6">
                    <input type="email" placeholder="Your Email" class="flex-1 px-2 md:px-3 py-1.5 md:py-2 bg-gray-800 border border-gray-700 rounded-l text-white placeholder-gray-400 focus:outline-none focus:border-gray-600 text-xs md:text-base">
                    <button class="bg-blue-600 px-3 md:px-4 py-1.5 md:py-2 rounded-r hover:bg-blue-700 transition-colors text-xs md:text-base">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="bg-gray-800 py-4">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-400 text-sm">
                @php
                    $defaultCopyright = '© ' . date('Y') . ' ' . config('app.name', 'Home & Kitchen Appliances') . '. All rights reserved.';
                @endphp
                {!! Setting::get('footer_copyright', $defaultCopyright) !!}
            </p>
        </div>
    </div>
</footer>
