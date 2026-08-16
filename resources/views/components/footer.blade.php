@php
use App\Models\Setting;
use App\Helpers\SocialMediaHelper;

$siteName = Setting::get('site_name', config('app.name', 'Qui Deals'));
$phone = Setting::get('contact_phone', '+254 700 123 456');
$email = Setting::get('contact_email', 'hello@homekitchen.com');
$address = Setting::get('contact_address', 'Westlands, Nairobi');
$city = Setting::get('contact_city', 'Kenya');
$whatsapp = Setting::get('whatsapp_number');
$socialUrls = SocialMediaHelper::getSocialMediaUrls();
$shopCategories = \App\Models\Category::active()->ordered()->take(6)->get();
$brands = \App\Models\Brand::active()->ordered()->take(6)->get();
$defaultCopyright = '© ' . date('Y') . ' ' . config('app.name', 'Qui Deals') . '. All rights reserved.';

$benefits = [
    ['icon' => 'fa-shipping-fast', 'title' => Setting::get('footer_free_delivery_title', 'FREE DELIVERY'), 'text' => Setting::get('footer_free_delivery_text', 'On orders over KES 5,000')],
    ['icon' => 'fa-lock', 'title' => Setting::get('footer_secure_checkout_title', 'SECURE CHECKOUT'), 'text' => Setting::get('footer_secure_checkout_text', 'Shop safely and confidently')],
    ['icon' => 'fa-sync-alt', 'title' => Setting::get('footer_easy_returns_title', 'EASY RETURNS'), 'text' => Setting::get('footer_easy_returns_text', '15-day return window')],
    ['icon' => 'fa-headset', 'title' => Setting::get('footer_customer_care_title', 'CUSTOMER CARE'), 'text' => Setting::get('footer_customer_care_text', 'We\'re here 24/7')],
];

$socialIcons = [
    'facebook' => 'fab fa-facebook-f',
    'twitter' => 'fab fa-twitter',
    'instagram' => 'fab fa-instagram',
    'linkedin' => 'fab fa-linkedin-in',
];
@endphp

<footer class="bg-brand-navy text-white">
    <div class="border-b border-white/10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach($benefits as $benefit)
                    <div class="flex items-start gap-3">
                        <div class="flex h-10 w-10 md:h-11 md:w-11 shrink-0 items-center justify-center rounded-full bg-white/10 text-brand-lime">
                            <i class="fas {{ $benefit['icon'] }} text-sm md:text-base"></i>
                        </div>
                        <div class="min-w-0">
                            <h4 class="text-white text-xs md:text-sm font-semibold tracking-wide uppercase leading-tight">{{ $benefit['title'] }}</h4>
                            <p class="text-white/70 text-xs md:text-sm leading-snug mt-1">{{ $benefit['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">
            <div class="col-span-2 lg:col-span-1">
                <a href="{{ route('home') }}" class="inline-block mb-4">
                    <img src="{{ Setting::logoUrl('light') }}" alt="{{ $siteName }}" class="h-10 md:h-12 w-auto">
                </a>
                <p class="text-white/70 text-sm leading-relaxed mb-5">{{ $address }}, {{ $city }}</p>

                <div class="space-y-2.5 mb-6">
                    <a href="tel:{{ str_replace(' ', '', $phone) }}" class="flex items-center gap-3 text-sm text-white/80 hover:text-brand-lime transition-colors">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-white/10">
                            <i class="fas fa-phone text-xs"></i>
                        </span>
                        {{ $phone }}
                    </a>
                    <a href="mailto:{{ $email }}" class="flex items-center gap-3 text-sm text-white/80 hover:text-brand-lime transition-colors">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-white/10">
                            <i class="fas fa-envelope text-xs"></i>
                        </span>
                        {{ $email }}
                    </a>
                    @if($whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/\D+/', '', $whatsapp) }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 text-sm text-white/80 hover:text-brand-lime transition-colors">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-white/10">
                                <i class="fab fa-whatsapp text-sm"></i>
                            </span>
                            WhatsApp
                        </a>
                    @endif
                </div>

                @if(!empty($socialUrls))
                    <div class="flex flex-wrap gap-2">
                        @foreach($socialUrls as $platform => $url)
                            <a href="{{ $url }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="{{ ucfirst($platform) }}"
                               class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 text-white hover:bg-brand-green hover:text-white transition-colors">
                                <i class="{{ $socialIcons[$platform] ?? 'fas fa-link' }} text-sm"></i>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <h4 class="text-sm font-semibold tracking-wider uppercase mb-4 text-white">
                    Support
                    <span class="block w-8 h-0.5 bg-brand-green mt-2"></span>
                </h4>
                <ul class="space-y-2.5">
                    <li><a href="{{ route('pages.contact') }}" class="text-sm text-white/75 hover:text-brand-lime transition-colors">Contact Us</a></li>
                    <li><a href="{{ route('pages.about') }}" class="text-sm text-white/75 hover:text-brand-lime transition-colors">About Us</a></li>
                    <li><a href="{{ route('pages.technical-support') }}" class="text-sm text-white/75 hover:text-brand-lime transition-colors">Customer Support</a></li>
                    <li><a href="{{ route('pages.shipping-returns') }}" class="text-sm text-white/75 hover:text-brand-lime transition-colors">Shipping & Returns</a></li>
                    <li><a href="{{ route('pages.faq') }}" class="text-sm text-white/75 hover:text-brand-lime transition-colors">FAQs</a></li>
                    <li><a href="{{ route('pages.privacy') }}" class="text-sm text-white/75 hover:text-brand-lime transition-colors">Privacy Policy</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-semibold tracking-wider uppercase mb-4 text-white">
                    Shop
                    <span class="block w-8 h-0.5 bg-brand-green mt-2"></span>
                </h4>
                <ul class="space-y-2.5">
                    @foreach($shopCategories as $category)
                        <li>
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="text-sm text-white/75 hover:text-brand-lime transition-colors">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ route('products.index') }}" class="text-sm font-medium text-brand-lime hover:text-white transition-colors">
                            View all products
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-span-2 lg:col-span-1">
                <h4 class="text-sm font-semibold tracking-wider uppercase mb-4 text-white">
                    Brands
                    <span class="block w-8 h-0.5 bg-brand-green mt-2"></span>
                </h4>
                <ul class="space-y-2.5">
                    @forelse($brands as $brand)
                        <li>
                            <a href="{{ route('products.index', ['brand' => $brand->slug]) }}" class="flex items-center gap-2 text-sm text-white/75 hover:text-brand-lime transition-colors">
                                @if($brand->logo)
                                    <img src="{{ $brand->logo }}" alt="" class="w-5 h-5 object-contain rounded-sm bg-white p-0.5">
                                @endif
                                {{ $brand->name }}
                            </a>
                        </li>
                    @empty
                        <li class="text-white/50 text-sm">No brands available</li>
                    @endforelse
                    @if($brands->count() > 0)
                        <li>
                            <a href="{{ route('products.index') }}" class="text-sm font-medium text-brand-lime hover:text-white transition-colors">
                                View all brands
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-white/60 text-sm text-center sm:text-left">
                {!! Setting::get('footer_copyright', $defaultCopyright) !!}
            </p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center text-sm font-medium text-white hover:text-brand-lime transition-colors">
                Shop deals
                <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>
    </div>
</footer>
