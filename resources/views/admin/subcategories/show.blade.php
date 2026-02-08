@extends('layouts.admin')

@section('title', 'Subcategory Details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">{{ $subcategory->name }}</h1>
            <p class="text-sm sm:text-base text-gray-600">Subcategory details and products</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
            <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm sm:text-base text-center">
                <i class="fas fa-edit mr-2"></i>Edit Subcategory
            </a>
            <a href="{{ route('admin.subcategories.index') }}" 
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors text-sm sm:text-base text-center">
                <i class="fas fa-arrow-left mr-2"></i>Back to Subcategories
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Subcategory Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Subcategory Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Name</p>
                        <p class="font-medium">{{ $subcategory->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Parent Category</p>
                        <p class="font-medium text-blue-600">{{ $subcategory->category->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Slug</p>
                        <p class="font-medium text-sm text-gray-500">{{ $subcategory->slug }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $subcategory->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $subcategory->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Sort Order</p>
                        <p class="font-medium">{{ $subcategory->sort_order ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            @if($subcategory->description)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Description</h2>
                    <div class="prose max-w-none">
                        <p class="text-gray-700">{{ $subcategory->description }}</p>
                    </div>
                </div>
            @endif

            <!-- Products in this Subcategory -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Products in this Subcategory ({{ $subcategory->products->count() }})</h2>
                
                @if($subcategory->products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($subcategory->products as $product)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center space-x-3">
                                    @if($product->image)
                                        <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" 
                                             class="w-12 h-12 object-cover rounded">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <h3 class="font-medium text-gray-900">{{ $product->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $product->formatted_price }}</p>
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-box-open text-gray-400 text-4xl mb-4"></i>
                        <p class="text-gray-500">No products in this subcategory yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Subcategory Stats -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Subcategory Stats</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Total Products</p>
                        <p class="font-medium text-lg">{{ $subcategory->products->count() }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Active Products</p>
                        <p class="font-medium">{{ $subcategory->products->where('is_active', true)->count() }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Featured Products</p>
                        <p class="font-medium">{{ $subcategory->products->where('is_featured', true)->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}" 
                       class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Edit Subcategory
                    </a>
                    <form method="POST" action="{{ route('admin.subcategories.destroy', $subcategory->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this subcategory? This will also affect all products in this subcategory.')"
                                class="block w-full text-center bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                            Delete Subcategory
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
