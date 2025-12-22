@extends('layouts.admin')

@php
use App\Models\Setting;
$currentYear = date('Y');
$appName = config('app.name', 'Home & Kitchen Appliances');
$defaultCopyright = "© {$currentYear} {$appName}. All rights reserved.";
@endphp

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="mb-6">
        <a href="{{ route('admin.settings') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Settings
        </a>
    </div>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Contact & Site Settings</h1>
        <p class="text-gray-600 mt-2">Update your contact details, business hours, and footer information</p>
    </div>

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
        
        <!-- Contact Details Section -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">Contact Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">Site Name</label>
                    <input type="text" id="site_name" name="settings[site_name]" 
                           value="{{ Setting::get('site_name', config('app.name', 'Home & Kitchen Appliances')) }}" 
                           placeholder="Home & Kitchen Appliances"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">The name of your website/business</p>
                </div>
                    
                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="text" id="contact_phone" name="settings[contact_phone]" 
                               value="{{ Setting::get('contact_phone') }}" 
                           placeholder="+254 700 123 456"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" id="contact_email" name="settings[contact_email]" 
                               value="{{ Setting::get('contact_email') }}" 
                           placeholder="hello@example.com"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="whatsapp_number" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp Number</label>
                        <input type="text" id="whatsapp_number" name="settings[whatsapp_number]" 
                               value="{{ Setting::get('whatsapp_number') }}" 
                               placeholder="+254700123456"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Include country code (e.g., +254700123456)</p>
                    </div>

                <div>
                    <label for="contact_address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <input type="text" id="contact_address" name="settings[contact_address]" 
                           value="{{ Setting::get('contact_address') }}" 
                           placeholder="Westlands, Nairobi"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="contact_city" class="block text-sm font-medium text-gray-700 mb-2">City/Country</label>
                    <input type="text" id="contact_city" name="settings[contact_city]" 
                           value="{{ Setting::get('contact_city') }}" 
                           placeholder="Kenya"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
        </div>

        <!-- Business Hours Section -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">Business Hours</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="business_hours_weekdays" class="block text-sm font-medium text-gray-700 mb-2">Weekdays</label>
                        <input type="text" id="business_hours_weekdays" name="settings[business_hours_weekdays]" 
                               value="{{ Setting::get('business_hours_weekdays') }}" 
                               placeholder="Monday - Friday: 8:00 AM - 6:00 PM"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="business_hours_saturday" class="block text-sm font-medium text-gray-700 mb-2">Saturday</label>
                        <input type="text" id="business_hours_saturday" name="settings[business_hours_saturday]" 
                               value="{{ Setting::get('business_hours_saturday') }}" 
                               placeholder="Saturday: 9:00 AM - 4:00 PM"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="business_hours_sunday" class="block text-sm font-medium text-gray-700 mb-2">Sunday</label>
                        <input type="text" id="business_hours_sunday" name="settings[business_hours_sunday]" 
                               value="{{ Setting::get('business_hours_sunday') }}" 
                               placeholder="Sunday: Closed"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

        <!-- Footer Top Bar Section -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">Footer Top Bar</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Free Delivery -->
                <div class="space-y-4 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-shipping-fast text-blue-600 mr-2"></i>
                        Free Delivery
                    </h3>
                    <div>
                        <label for="footer_free_delivery_title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" id="footer_free_delivery_title" name="settings[footer_free_delivery_title]" 
                               value="{{ Setting::get('footer_free_delivery_title', 'FREE DELIVERY') }}" 
                               placeholder="FREE DELIVERY"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="footer_free_delivery_text" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <input type="text" id="footer_free_delivery_text" name="settings[footer_free_delivery_text]" 
                               value="{{ Setting::get('footer_free_delivery_text', 'On orders over KES 5,000') }}" 
                               placeholder="On orders over KES 5,000"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Secure Checkout -->
                <div class="space-y-4 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-credit-card text-green-600 mr-2"></i>
                        Secure Checkout
                    </h3>
                    <div>
                        <label for="footer_secure_checkout_title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" id="footer_secure_checkout_title" name="settings[footer_secure_checkout_title]" 
                               value="{{ Setting::get('footer_secure_checkout_title', 'SECURE CHECKOUT') }}" 
                               placeholder="SECURE CHECKOUT"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="footer_secure_checkout_text" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <input type="text" id="footer_secure_checkout_text" name="settings[footer_secure_checkout_text]" 
                               value="{{ Setting::get('footer_secure_checkout_text', 'Shop safely and confidently') }}" 
                               placeholder="Shop safely and confidently"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Easy Returns -->
                <div class="space-y-4 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-sync-alt text-purple-600 mr-2"></i>
                        Easy Returns
                    </h3>
                    <div>
                        <label for="footer_easy_returns_title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" id="footer_easy_returns_title" name="settings[footer_easy_returns_title]" 
                               value="{{ Setting::get('footer_easy_returns_title', 'EASY RETURNS') }}" 
                               placeholder="EASY RETURNS"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="footer_easy_returns_text" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <input type="text" id="footer_easy_returns_text" name="settings[footer_easy_returns_text]" 
                               value="{{ Setting::get('footer_easy_returns_text', '15-day return window') }}" 
                               placeholder="15-day return window"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Customer Care -->
                <div class="space-y-4 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-headset text-orange-600 mr-2"></i>
                        Customer Care
                    </h3>
                    <div>
                        <label for="footer_customer_care_title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" id="footer_customer_care_title" name="settings[footer_customer_care_title]" 
                               value="{{ Setting::get('footer_customer_care_title', 'CUSTOMER CARE') }}" 
                               placeholder="CUSTOMER CARE"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="footer_customer_care_text" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <input type="text" id="footer_customer_care_text" name="settings[footer_customer_care_text]" 
                               value="{{ Setting::get('footer_customer_care_text', 'We\'re here 24/7') }}" 
                               placeholder="We're here 24/7"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Main Section -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-3 border-b border-gray-200">Footer Main Section</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="footer_subscribe_title" class="block text-sm font-medium text-gray-700 mb-2">Subscribe Section Title</label>
                    <input type="text" id="footer_subscribe_title" name="settings[footer_subscribe_title]" 
                           value="{{ Setting::get('footer_subscribe_title', 'SUBSCRIBE') }}" 
                           placeholder="SUBSCRIBE"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="footer_subscribe_text" class="block text-sm font-medium text-gray-700 mb-2">Subscribe Section Description</label>
                    <input type="text" id="footer_subscribe_text" name="settings[footer_subscribe_text]" 
                           value="{{ Setting::get('footer_subscribe_text', 'Get the latest deals, product updates, and exclusive offers delivered to your inbox.') }}" 
                           placeholder="Get the latest deals..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label for="footer_copyright" class="block text-sm font-medium text-gray-700 mb-2">Copyright Text</label>
                    <textarea id="footer_copyright" name="settings[footer_copyright]" 
                              rows="3"
                              placeholder="© 2024 Home & Kitchen Appliances. All rights reserved."
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('settings.footer_copyright', Setting::get('footer_copyright', $defaultCopyright)) }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">HTML is allowed. Use the unescaped output syntax in blade template to render HTML.</p>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold shadow-lg">
                <i class="fas fa-save mr-2"></i>
                Save All Changes
                </button>
            </div>
        </form>
</div>
@endsection 
