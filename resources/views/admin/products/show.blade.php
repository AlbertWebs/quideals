@extends('layouts.admin')

@section('title', 'Product Details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
            <p class="text-gray-600">Product details and information</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.products.edit', $product) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                Edit Product
            </a>
            <a href="{{ route('admin.products.index') }}" 
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                Back to Products
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Product Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Product Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Name</p>
                        <p class="font-medium">{{ $product->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Category</p>
                        <p class="font-medium">{{ $product->category->name ?? 'Uncategorized' }}</p>
                    </div>
                    @if($product->brand)
                        <div>
                            <p class="text-sm text-gray-600">Brand</p>
                            <p class="font-medium">{{ $product->brand }}</p>
                        </div>
                    @endif
                    <div>
                        <p class="text-sm text-gray-600">Price</p>
                        <p class="font-medium text-lg text-green-600">{{ $product->formatted_price }}</p>
                    </div>
                    @if($product->old_price)
                        <div>
                            <p class="text-sm text-gray-600">Old Price</p>
                            <p class="font-medium text-gray-500 line-through">{{ $product->formatted_old_price }}</p>
                        </div>
                    @endif
                    <div>
                        <p class="text-sm text-gray-600">Stock Quantity</p>
                        <p class="font-medium {{ $product->stock_quantity < 10 ? 'text-red-600' : 'text-gray-900' }}">
                            {{ $product->stock_quantity }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Description</h2>
                <div class="prose max-w-none">
                    <div class="text-gray-700">{!! html_entity_decode($product->description, ENT_QUOTES, 'UTF-8') !!}</div>
                </div>
            </div>

            <!-- Specifications -->
            @if($product->specifications && count($product->specifications) > 0)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Specifications</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($product->specifications as $key => $value)
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-700">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                                <span class="text-gray-600">{{ $value }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Images -->
            @if($product->image || $product->images)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Product Images</h2>
                    <div class="space-y-4">
                        @if($product->image)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Main Image</label>
                                <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" 
                                     class="w-48 h-48 object-cover rounded-lg border">
                            </div>
                        @endif

                        @if($product->getValidImages() && count($product->getValidImages()) > 0)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Additional Images</label>
                                <div class="flex space-x-2">
                                    @foreach($product->getValidImages() as $image)
                                        <img src="{{ $product->getImageUrlAttribute($image) }}" alt="{{ $product->name }}" 
                                             class="w-24 h-24 object-cover rounded-lg border">
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Additional Details -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Additional Details</h2>
                <div class="space-y-3">
                    @if($product->badge)
                        <div>
                            <p class="text-sm text-gray-600">Badge</p>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $product->badge }}
                            </span>
                        </div>
                    @endif

                    <div>
                        <p class="text-sm text-gray-600">Stock Status</p>
                        <div class="flex items-center">
                            @if($product->stock_quantity > 0)
                                <div class="flex items-center text-green-600">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">In Stock ({{ $product->stock_quantity }})</span>
                                </div>
                            @else
                                <div class="flex items-center text-red-600">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-medium">Out of Stock</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($product->reviews_count)
                        <div>
                            <p class="text-sm text-gray-600">Reviews Count</p>
                            <p class="font-medium">{{ $product->reviews_count }}</p>
                        </div>
                    @endif

                    <div>
                        <p class="text-sm text-gray-600">Featured</p>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $product->is_featured ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $product->is_featured ? 'Yes' : 'No' }}
                        </span>
                    </div>

                    @if($product->discount_percentage > 0)
                        <div>
                            <p class="text-sm text-gray-600">Discount</p>
                            <p class="font-medium text-red-600">{{ $product->discount_percentage }}% OFF</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Stats -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Product Stats</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Created</p>
                        <p class="font-medium">{{ $product->created_at->format('M j, Y g:i A') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Last Updated</p>
                        <p class="font-medium">{{ $product->updated_at->format('M j, Y g:i A') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Slug</p>
                        <p class="font-medium text-sm text-gray-500">{{ $product->slug }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('admin.products.edit', $product) }}" 
                       class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Edit Product
                    </a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')"
                                class="block w-full text-center bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                            Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 