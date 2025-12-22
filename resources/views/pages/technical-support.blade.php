@extends('layouts.app')

@php
use App\Models\Setting;
@endphp

@section('title', 'Customer Support - ' . Setting::get('site_name', config('app.name', 'Qui Deals')))
@section('description', 'Get help with your home and kitchen appliances. Our customer support team is here to assist you with product installation, troubleshooting, warranty claims, and more.')
@section('keywords', 'customer support, home appliances support, kitchen appliances help, product installation, warranty service')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-white py-12 md:py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center mb-12 md:mb-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl mb-6 shadow-lg">
                <i class="fas fa-headset text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Customer Support</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                Need help with your home and kitchen appliances? Our expert customer support team is here to assist you with product installation, troubleshooting, warranty claims, and any questions about your purchase.
            </p>
        </div>

        <!-- Support Categories -->
        <div class="mb-16 md:mb-20">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">How Can We Help?</span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <!-- Product Installation & Setup -->
                <div class="border-2 border-gray-200 rounded-xl p-6 bg-white hover:bg-gradient-to-br hover:from-blue-50 hover:to-purple-50 hover:border-blue-300 transition-all duration-300 shadow-sm hover:shadow-lg transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-4 shadow-md">
                        <i class="fas fa-tools text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Product Installation & Setup</h3>
                    <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                        Need help installing or setting up your new appliance? Our technical experts can guide you through the installation process step by step.
                    </p>
                    <a href="#contact" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-sm transition-colors">
                        Get Help <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Product Troubleshooting -->
                <div class="border-2 border-gray-200 rounded-xl p-6 bg-white hover:bg-gradient-to-br hover:from-green-50 hover:to-emerald-50 hover:border-green-300 transition-all duration-300 shadow-sm hover:shadow-lg transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-4 shadow-md">
                        <i class="fas fa-wrench text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Product Troubleshooting</h3>
                    <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                        Experiencing issues with your appliance? Our support team can help diagnose and resolve technical problems quickly and efficiently.
                    </p>
                    <a href="#contact" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold text-sm transition-colors">
                        Get Help <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Warranty & Repairs -->
                <div class="border-2 border-gray-200 rounded-xl p-6 bg-white hover:bg-gradient-to-br hover:from-purple-50 hover:to-pink-50 hover:border-purple-300 transition-all duration-300 shadow-sm hover:shadow-lg transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-4 shadow-md">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Warranty & Repairs</h3>
                    <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                        Need warranty service or repairs? We'll help you process warranty claims and coordinate repair services for your appliances.
                    </p>
                    <a href="#contact" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold text-sm transition-colors">
                        Get Help <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Product Usage & Care -->
                <div class="border-2 border-gray-200 rounded-xl p-6 bg-white hover:bg-gradient-to-br hover:from-orange-50 hover:to-amber-50 hover:border-orange-300 transition-all duration-300 shadow-sm hover:shadow-lg transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mb-4 shadow-md">
                        <i class="fas fa-book text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Product Usage & Care</h3>
                    <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                        Learn how to properly use and maintain your appliances for optimal performance and longevity. Get expert tips and care instructions.
                    </p>
                    <a href="#contact" class="inline-flex items-center text-orange-600 hover:text-orange-700 font-semibold text-sm transition-colors">
                        Get Help <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Product Recommendations -->
                <div class="border-2 border-gray-200 rounded-xl p-6 bg-white hover:bg-gradient-to-br hover:from-red-50 hover:to-rose-50 hover:border-red-300 transition-all duration-300 shadow-sm hover:shadow-lg transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mb-4 shadow-md">
                        <i class="fas fa-lightbulb text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Product Recommendations</h3>
                    <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                        Not sure which appliance is right for your needs? Our experts can help you choose the perfect product for your home and kitchen.
                    </p>
                    <a href="#contact" class="inline-flex items-center text-red-600 hover:text-red-700 font-semibold text-sm transition-colors">
                        Get Help <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Product Specifications & Manuals -->
                <div class="border-2 border-gray-200 rounded-xl p-6 bg-white hover:bg-gradient-to-br hover:from-indigo-50 hover:to-blue-50 hover:border-indigo-300 transition-all duration-300 shadow-sm hover:shadow-lg transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center mb-4 shadow-md">
                        <i class="fas fa-file-alt text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Product Specifications & Manuals</h3>
                    <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                        Need detailed product specifications, user manuals, or technical documentation? We can provide all the information you need.
                    </p>
                    <a href="#contact" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-semibold text-sm transition-colors">
                        Get Help <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Support Channels -->
        <div class="mb-16 md:mb-20" id="contact">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Support Channels</span>
            </h2>
            @if(session('success'))
                <div class="mb-6 bg-green-100 border-2 border-green-400 text-green-700 px-4 py-3 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12">
                <!-- Contact Information -->
                <div class="space-y-6">
                    <div class="border-2 border-gray-200 rounded-xl p-6 md:p-8 bg-gradient-to-br from-white to-gray-50 shadow-lg">
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-headset text-blue-600 mr-3"></i>
                            Get in Touch
                        </h3>
                        <div class="space-y-5">
                            <a href="tel:{{ str_replace(' ', '', Setting::get('contact_phone', '+254 700 123 456')) }}" class="flex items-start space-x-4 p-4 bg-white rounded-xl border border-gray-100 hover:border-blue-200 hover:shadow-md transition-all">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md">
                                    <i class="fas fa-phone text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Phone Support</h4>
                                    <p class="text-gray-700 font-semibold hover:text-blue-600">{{ Setting::get('contact_phone', '+254 700 123 456') }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ Setting::get('business_hours_weekdays', 'Mon-Fri: 8AM-6PM, Sat: 9AM-4PM') }}</p>
                                </div>
                            </a>

                            <div class="flex items-start space-x-4 p-4 bg-white rounded-xl border border-gray-100 hover:border-green-200 hover:shadow-md transition-all">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Email Support</h4>
                                    <p class="text-gray-700 font-semibold">{{ Setting::get('contact_email', 'support@quideals.com') }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Response within 24 hours</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4 p-4 bg-white rounded-xl border border-gray-100 hover:border-purple-200 hover:shadow-md transition-all">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md">
                                    <i class="fas fa-comments text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Live Chat</h4>
                                    <p class="text-gray-700 font-semibold">Available on website</p>
                                    <p class="text-xs text-gray-500 mt-1">Instant response during business hours</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Support Form -->
                <div class="border-2 border-gray-200 rounded-xl p-6 md:p-8 bg-gradient-to-br from-white to-gray-50 shadow-lg">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-paper-plane text-purple-600 mr-3"></i>
                        Submit a Support Request
                    </h3>
                    <form action="{{ route('contact-messages.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="hidden" name="source" value="technical_support">
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                            <input type="text" id="name" name="name" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="email" name="email" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        </div>

                        <div>
                            <label for="product" class="block text-sm font-bold text-gray-700 mb-2">Product (if applicable)</label>
                            <input type="text" id="product" name="product" placeholder="Product name or model number" class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        </div>

                        <div>
                            <label for="issue_type" class="block text-sm font-bold text-gray-700 mb-2">Issue Type</label>
                            <select id="issue_type" name="issue_type" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white">
                                <option value="">Select issue type</option>
                                <option value="installation">Product Installation & Setup</option>
                                <option value="troubleshooting">Product Troubleshooting</option>
                                <option value="warranty">Warranty & Repairs</option>
                                <option value="usage_care">Product Usage & Care</option>
                                <option value="recommendations">Product Recommendations</option>
                                <option value="specifications">Product Specifications & Manuals</option>
                                <option value="returns_exchanges">Returns & Exchanges</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                            <textarea id="description" name="description" rows="5" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none" placeholder="Please describe your question or issue in detail..."></textarea>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 px-6 rounded-xl font-bold text-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Submit Request
                        </button>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>


@endsection
