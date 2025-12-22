@extends('layouts.app')

@php
use App\Models\Setting;
@endphp

@section('content')
    <!-- Page Header -->
    <section class="bg-gray-50 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Shopping Basket</h1>
                    <p class="text-gray-600 mt-2">Review your items and proceed to checkout</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if(count($cartItems) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-8">
                <!-- Basket Items -->
                <div class="lg:col-span-2 order-2 lg:order-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900">Basket Items ({{ count($cartItems) }})</h2>
                        </div>
                        
                        <div class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <div class="p-3 md:p-6 flex items-center space-x-3 md:space-x-4">
                                    <img src="{{ $item['product']->image }}" alt="{{ $item['product']->name }}" class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-lg flex-shrink-0">
                                    
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-sm md:text-lg font-medium text-gray-900 line-clamp-2">{{ $item['product']->name }}</h3>
                                        <p class="text-xs md:text-sm text-gray-500 hidden md:block">{{ $item['product']->category->name }}</p>
                                        <div class="flex items-center mt-1 md:mt-2">
                                            <span class="text-sm md:text-lg font-bold text-gray-900">{{ $item['product']->formatted_price }}</span>
                                            @if($item['product']->old_price && $item['product']->old_price > $item['product']->price)
                                                <span class="ml-2 text-xs md:text-sm text-gray-500 line-through hidden sm:inline">{{ $item['product']->formatted_old_price }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col items-end space-y-2">
                                        <div class="flex items-center border-2 border-gray-300 rounded-lg">
                                            <button onclick="updateCartQuantity({{ $item['id'] }}, {{ $item['quantity'] - 1 }})" 
                                                    class="px-2 md:px-3 py-1.5 md:py-2 text-gray-600 hover:text-gray-800 active:bg-gray-100 transition-colors" 
                                                    {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                <i class="fas fa-minus text-xs"></i>
                                            </button>
                                            <span class="px-2 md:px-3 py-1.5 md:py-2 text-gray-900 font-medium text-sm md:text-base">{{ $item['quantity'] }}</span>
                                            <button onclick="updateCartQuantity({{ $item['id'] }}, {{ $item['quantity'] + 1 }})" 
                                                    class="px-2 md:px-3 py-1.5 md:py-2 text-gray-600 hover:text-gray-800 active:bg-gray-100 transition-colors">
                                                <i class="fas fa-plus text-xs"></i>
                                            </button>
                                        </div>
                                        
                                        <div class="text-right">
                                            <div class="text-sm md:text-lg font-bold text-gray-900">KES {{ number_format($item['subtotal'], 2) }}</div>
                                            <button onclick="removeFromCart({{ $item['id'] }})" 
                                                    class="text-red-500 hover:text-red-700 text-xs md:text-sm transition-colors active:scale-95">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="p-6 border-t border-gray-200">
                            <button onclick="clearCart()" class="text-red-600 hover:text-red-700 font-medium transition-colors">
                                Clear Basket
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Checkout Form -->
                <div class="lg:col-span-1 order-1 lg:order-2 sticky top-20 lg:top-24">
                    <div class="bg-white rounded-lg shadow-lg border-2 border-gray-200 p-4 md:p-6">
                        <!-- WhatsApp Checkout Badge -->
                        <div class="mb-4 p-3 bg-gradient-to-r from-green-500 to-green-600 rounded-xl text-white text-center">
                            <i class="fab fa-whatsapp text-2xl mb-2"></i>
                            <p class="text-sm font-semibold">Checkout via WhatsApp</p>
                            <p class="text-xs opacity-90 mt-1">Quick & Easy Guest Checkout</p>
                        </div>
                        
                        <h2 class="text-lg md:text-xl font-semibold text-gray-900 mb-4 md:mb-6">Checkout</h2>
                        
                        <!-- Order Summary -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="text-gray-900">KES {{ number_format($total, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Delivery</span>
                                    <span class="text-gray-500 text-sm">Shipping fee may apply</span>
                                </div>
                                <div class="border-t border-gray-200 pt-2">
                                    <div class="flex justify-between font-semibold">
                                        <span class="text-gray-900">Total</span>
                                        <span class="text-gray-900">KES {{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delivery Details Form -->
                        <form action="{{ route('cart.checkout') }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <div>
                                <label for="name" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                                <input type="text" id="name" name="name" required 
                                       class="w-full px-3 py-2.5 md:py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                       value="{{ old('name') }}" placeholder="Your full name">
                            </div>

                            <div>
                                <label for="email" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                                <input type="email" id="email" name="email" required 
                                       class="w-full px-3 py-2.5 md:py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                       value="{{ old('email') }}" placeholder="your@email.com">
                            </div>

                            <div>
                                <label for="phone" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                                <input type="tel" id="phone" name="phone" required 
                                       class="w-full px-3 py-2.5 md:py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                       value="{{ old('phone') }}" placeholder="{{ Setting::get('contact_phone', '+254 700 123 456') }}">
                                <p class="text-xs text-gray-500 mt-1">For WhatsApp order confirmation</p>
                            </div>

                            <div>
                                <label for="address" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Delivery Address *</label>
                                <textarea id="address" name="address" rows="2" required 
                                          class="w-full px-3 py-2.5 md:py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                          placeholder="Street, Building, Apartment">{{ old('address') }}</textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label for="city" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">City *</label>
                                    <input type="text" id="city" name="city" required 
                                           class="w-full px-3 py-2.5 md:py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                           value="{{ old('city', 'Nairobi') }}" placeholder="Nairobi">
                                </div>

                                <div>
                                    <label for="postal_code" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                    <input type="text" id="postal_code" name="postal_code" 
                                           class="w-full px-3 py-2.5 md:py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                           value="{{ old('postal_code') }}" placeholder="Optional">
                                </div>
                            </div>

                            <div>
                                <label for="delivery_notes" class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Delivery Notes (Optional)</label>
                                <textarea id="delivery_notes" name="delivery_notes" rows="2" 
                                          class="w-full px-3 py-2.5 md:py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                          placeholder="Any special instructions...">{{ old('delivery_notes') }}</textarea>
                            </div>

                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-4 px-6 rounded-xl font-bold text-lg hover:from-green-600 hover:to-green-700 transition-all shadow-lg hover:shadow-xl active:scale-95 flex items-center justify-center gap-2">
                                <i class="fab fa-whatsapp text-xl"></i>
                                <span>Checkout via WhatsApp</span>
                                <span class="text-sm opacity-90">KES {{ number_format($total, 2) }}</span>
                            </button>
                            
                            <p class="text-xs text-gray-500 text-center mt-2">
                                <i class="fas fa-info-circle"></i> No account needed - Guest checkout available
                            </p>
                        </form>

                        <!-- Payment Info -->
                        <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="flex items-start gap-2 mb-2">
                                <i class="fas fa-info-circle text-blue-600 mt-0.5"></i>
                                <h4 class="text-xs font-semibold text-blue-900">Payment & Delivery</h4>
                            </div>
                            <p class="text-xs text-blue-800 mb-1">
                                💵 Cash on delivery • 📱 Mobile money accepted
                            </p>
                            <p class="text-xs text-blue-700">
                                Delivery fees calculated based on location
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Basket -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m6 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Your basket is empty</h3>
                <p class="mt-1 text-sm text-gray-500">Start shopping to add items to your basket.</p>
                <div class="mt-6">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Continue Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection 