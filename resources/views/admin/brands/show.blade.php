@extends('layouts.admin')

@section('title', 'Brand Details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $brand->name }}</h1>
            <p class="text-gray-600">Brand details and products</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.brands.edit', $brand) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                Edit Brand
            </a>
            <a href="{{ route('admin.brands.index') }}" 
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                Back to Brands
            </a>
        </div>
    </div>

    <!-- Brand Information -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Brand Information</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="text-sm text-gray-900 mt-1">{{ $brand->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Slug</dt>
                        <dd class="text-sm text-gray-900 mt-1">{{ $brand->slug }}</dd>
                    </div>
                    @if($brand->logo)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Logo</dt>
                            <dd class="mt-1">
                                <img src="{{ $brand->logo }}" alt="{{ $brand->name }}" class="w-32 h-32 object-contain border border-gray-200 rounded">
                            </dd>
                        </div>
                    @endif
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $brand->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $brand->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Sort Order</dt>
                        <dd class="text-sm text-gray-900 mt-1">{{ $brand->sort_order ?? 0 }}</dd>
                    </div>
                </dl>
            </div>
            @if($brand->description)
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Description</h3>
                    <p class="text-sm text-gray-700">{{ $brand->description }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Products -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Products ({{ $brand->products->count() }})</h3>
        @if($brand->products->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($brand->products as $product)
                            <tr>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-900">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">KES {{ number_format($product->price, 2) }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">No products found for this brand.</p>
        @endif
    </div>
</div>
@endsection

