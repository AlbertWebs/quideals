@extends('layouts.app')

@php
use App\Models\Setting;
@endphp

@section('title', 'Shipping & Returns - ' . Setting::get('site_name', config('app.name', 'Qui Deals')))
@section('description', 'Learn about our shipping options, delivery times, and hassle-free return policy for home and kitchen appliances. Free delivery on orders over KES 5,000.')
@section('keywords', 'shipping, returns, delivery, home appliances delivery, kitchen appliances shipping, return policy')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-white py-12 md:py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center mb-12 md:mb-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl mb-6 shadow-lg">
                <i class="fas fa-shipping-fast text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Shipping & Returns</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                We want you to be completely satisfied with your home and kitchen appliance purchase. Learn about our shipping options,
                delivery times, and hassle-free return policy.
            </p>
        </div>

        <!-- Shipping Information -->
        <div class="mb-16 md:mb-20">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Shipping Information</span>
            </h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12">
                <!-- Shipping Options -->
                <div class="space-y-6">
                    <div class="border-2 border-gray-200 rounded-xl bg-gradient-to-br from-white to-gray-50 p-6 md:p-8 shadow-lg">
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-truck text-blue-600 mr-3"></i>
                            Shipping Options
                        </h3>
                        <div class="space-y-4">
                            <div class="border-l-4 border-green-500 pl-5 pr-4 py-3 bg-green-50 rounded-r-lg hover:shadow-md transition-all">
                                <h4 class="font-bold text-gray-900 mb-1">Free Standard Delivery</h4>
                                <p class="text-gray-700 font-semibold">{{ Setting::get('footer_free_delivery_text', 'On orders over KES 5,000') }}</p>
                                <p class="text-sm text-gray-600 mt-1">3-5 business days</p>
                            </div>
                            <div class="border-l-4 border-blue-500 pl-5 pr-4 py-3 bg-blue-50 rounded-r-lg hover:shadow-md transition-all">
                                <h4 class="font-bold text-gray-900 mb-1">Express Delivery</h4>
                                <p class="text-gray-700 font-semibold">KES 1,500</p>
                                <p class="text-sm text-gray-600 mt-1">1-2 business days</p>
                            </div>
                            <div class="border-l-4 border-purple-500 pl-5 pr-4 py-3 bg-purple-50 rounded-r-lg hover:shadow-md transition-all">
                                <h4 class="font-bold text-gray-900 mb-1">Same Day Delivery</h4>
                                <p class="text-gray-700 font-semibold">KES 3,000</p>
                                <p class="text-sm text-gray-600 mt-1">Nairobi only, order before 2 PM</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-2 border-gray-200 rounded-xl bg-gradient-to-br from-white to-gray-50 p-6 md:p-8 shadow-lg">
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-map-marker-alt text-purple-600 mr-3"></i>
                            Delivery Areas
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center p-3 bg-white rounded-lg border border-gray-100 hover:shadow-md transition-all">
                                <span class="text-gray-700 font-semibold">Nairobi</span>
                                <span class="text-green-600 font-bold">{{ Setting::get('footer_free_delivery_text', 'Free over KES 5,000') }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-white rounded-lg border border-gray-100 hover:shadow-md transition-all">
                                <span class="text-gray-700 font-semibold">Mombasa, Kisumu, Nakuru</span>
                                <span class="text-gray-700 font-bold">KES 800</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-white rounded-lg border border-gray-100 hover:shadow-md transition-all">
                                <span class="text-gray-700 font-semibold">Other Major Towns</span>
                                <span class="text-gray-700 font-bold">KES 1,200</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-white rounded-lg border border-gray-100 hover:shadow-md transition-all">
                                <span class="text-gray-700 font-semibold">Remote Areas</span>
                                <span class="text-gray-700 font-bold">KES 1,500</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delivery Process -->
                <div class="space-y-6">
                    <div class="border-2 border-gray-200 rounded-xl bg-gradient-to-br from-white to-gray-50 p-6 md:p-8 shadow-lg">
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-route text-green-600 mr-3"></i>
                            How Delivery Works
                        </h3>
                        <div class="space-y-5">
                            <div class="flex items-start space-x-4 p-4 bg-white rounded-lg border border-gray-100 hover:shadow-md transition-all">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-md flex-shrink-0">1</div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Order Confirmation</h4>
                                    <p class="text-gray-600 text-sm">You'll receive an email confirmation with tracking details</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4 p-4 bg-white rounded-lg border border-gray-100 hover:shadow-md transition-all">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-md flex-shrink-0">2</div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Processing</h4>
                                    <p class="text-gray-600 text-sm">We'll prepare your appliance order and arrange delivery</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4 p-4 bg-white rounded-lg border border-gray-100 hover:shadow-md transition-all">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-md flex-shrink-0">3</div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Shipping</h4>
                                    <p class="text-gray-600 text-sm">Your package will be shipped via our trusted courier partners</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4 p-4 bg-white rounded-lg border border-gray-100 hover:shadow-md transition-all">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-md flex-shrink-0">4</div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Delivery</h4>
                                    <p class="text-gray-600 text-sm">You'll receive a call before delivery to confirm location and schedule</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-2 border-gray-200 rounded-xl bg-gradient-to-br from-white to-gray-50 p-6 md:p-8 shadow-lg">
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-info-circle text-orange-600 mr-3"></i>
                            Important Notes
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-start space-x-3 p-3 bg-white rounded-lg border border-gray-100">
                                <i class="fas fa-check-circle text-green-500 mt-1 text-lg"></i>
                                <span class="text-gray-700 font-medium">Please ensure someone is available to receive the delivery</span>
                            </li>
                            <li class="flex items-start space-x-3 p-3 bg-white rounded-lg border border-gray-100">
                                <i class="fas fa-check-circle text-green-500 mt-1 text-lg"></i>
                                <span class="text-gray-700 font-medium">Valid ID required for delivery confirmation</span>
                            </li>
                            <li class="flex items-start space-x-3 p-3 bg-white rounded-lg border border-gray-100">
                                <i class="fas fa-check-circle text-green-500 mt-1 text-lg"></i>
                                <span class="text-gray-700 font-medium">Cash on delivery available for orders under KES 100,000</span>
                            </li>
                            <li class="flex items-start space-x-3 p-3 bg-white rounded-lg border border-gray-100">
                                <i class="fas fa-check-circle text-green-500 mt-1 text-lg"></i>
                                <span class="text-gray-700 font-medium">Free installation available for large appliances (refrigerators, washing machines, etc.)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Returns Information -->
        <div class="mb-16 md:mb-20">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center mb-12">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Returns & Refunds</span>
            </h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12">
                <!-- Return Policy -->
                <div class="space-y-6">
                    <div class="border-2 border-gray-200 rounded-xl bg-gradient-to-br from-white to-gray-50 p-6 md:p-8 shadow-lg">
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-undo text-red-600 mr-3"></i>
                            Return Policy
                        </h3>
                        <div class="space-y-4">
                            <div class="border-l-4 border-green-500 pl-5 pr-4 py-3 bg-green-50 rounded-r-lg hover:shadow-md transition-all">
                                <h4 class="font-bold text-gray-900 mb-1">{{ Setting::get('footer_easy_returns_title', 'EASY RETURNS') }}</h4>
                                <p class="text-gray-700 font-semibold">{{ Setting::get('footer_easy_returns_text', '15-day return window') }}</p>
                                <p class="text-sm text-gray-600 mt-1">Must be in original condition with all packaging</p>
                            </div>
                            <div class="border-l-4 border-blue-500 pl-5 pr-4 py-3 bg-blue-50 rounded-r-lg hover:shadow-md transition-all">
                                <h4 class="font-bold text-gray-900 mb-1">Free Returns</h4>
                                <p class="text-gray-700 font-semibold">We cover return shipping costs</p>
                                <p class="text-sm text-gray-600 mt-1">For defective items or wrong products</p>
                            </div>
                            <div class="border-l-4 border-purple-500 pl-5 pr-4 py-3 bg-purple-50 rounded-r-lg hover:shadow-md transition-all">
                                <h4 class="font-bold text-gray-900 mb-1">Refund Processing</h4>
                                <p class="text-gray-700 font-semibold">Refunds processed within 5-7 business days</p>
                                <p class="text-sm text-gray-600 mt-1">Original payment method</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-2 border-gray-200 rounded-xl bg-gradient-to-br from-white to-gray-50 p-6 md:p-8 shadow-lg">
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-check-circle text-green-600 mr-3"></i>
                            What Can Be Returned
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-100">
                                <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                <span class="text-gray-700 font-medium">Defective or damaged appliances</span>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-100">
                                <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                <span class="text-gray-700 font-medium">Wrong items received</span>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-100">
                                <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                <span class="text-gray-700 font-medium">Items not as described</span>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-100">
                                <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                <span class="text-gray-700 font-medium">Change of mind (within return window)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Return Process -->
                <div class="space-y-6">
                    <div class="border-2 border-gray-200 rounded-xl bg-gradient-to-br from-white to-gray-50 p-6 md:p-8 shadow-lg">
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-arrow-left text-red-600 mr-3"></i>
                            How to Return
                        </h3>
                        <div class="space-y-5">
                            <div class="flex items-start space-x-4 p-4 bg-white rounded-lg border border-gray-100 hover:shadow-md transition-all">
                                <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold shadow-md flex-shrink-0">1</div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Contact Us</h4>
                                    <p class="text-gray-600 text-sm">Call or email us to initiate the return process</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4 p-4 bg-white rounded-lg border border-gray-100 hover:shadow-md transition-all">
                                <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold shadow-md flex-shrink-0">2</div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Return Authorization</h4>
                                    <p class="text-gray-600 text-sm">We'll provide a return authorization number</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4 p-4 bg-white rounded-lg border border-gray-100 hover:shadow-md transition-all">
                                <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold shadow-md flex-shrink-0">3</div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Package Item</h4>
                                    <p class="text-gray-600 text-sm">Pack the appliance securely with all original packaging and accessories</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4 p-4 bg-white rounded-lg border border-gray-100 hover:shadow-md transition-all">
                                <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold shadow-md flex-shrink-0">4</div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Ship Back</h4>
                                    <p class="text-gray-600 text-sm">We'll arrange pickup or provide shipping label</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-2 border-gray-200 rounded-xl bg-gradient-to-br from-white to-gray-50 p-6 md:p-8 shadow-lg">
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-ban text-red-600 mr-3"></i>
                            Non-Returnable Items
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-100">
                                <i class="fas fa-times-circle text-red-500 text-lg"></i>
                                <span class="text-gray-700 font-medium">Items used beyond normal wear or damaged by misuse</span>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-100">
                                <i class="fas fa-times-circle text-red-500 text-lg"></i>
                                <span class="text-gray-700 font-medium">Personalized or custom-made appliances</span>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-100">
                                <i class="fas fa-times-circle text-red-500 text-lg"></i>
                                <span class="text-gray-700 font-medium">Items without original packaging or accessories</span>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-100">
                                <i class="fas fa-times-circle text-red-500 text-lg"></i>
                                <span class="text-gray-700 font-medium">Gift cards and vouchers</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 rounded-2xl p-8 md:p-12 text-white shadow-2xl">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-10">Need Help?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <a href="tel:{{ str_replace(' ', '', Setting::get('contact_phone', '+254 700 123 456')) }}" class="bg-white/10 backdrop-blur-sm rounded-xl p-6 hover:bg-white/20 transition-all block">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-phone text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Call Us</h3>
                    <p class="text-blue-100 font-semibold">{{ Setting::get('contact_phone', '+254 700 123 456') }}</p>
                    <p class="text-sm text-blue-200 mt-1">{{ Setting::get('business_hours_weekdays', 'Mon-Fri: 8AM-6PM') }}</p>
                </a>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 hover:bg-white/20 transition-all">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-envelope text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Email Us</h3>
                    <p class="text-blue-100 font-semibold">{{ Setting::get('contact_email', 'support@quideals.com') }}</p>
                    <p class="text-sm text-blue-200 mt-1">24-hour response</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 hover:bg-white/20 transition-all">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-comments text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Live Chat</h3>
                    <p class="text-blue-100 font-semibold">Available on website</p>
                    <p class="text-sm text-blue-200 mt-1">Instant support</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
