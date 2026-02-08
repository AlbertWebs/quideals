@extends('layouts.admin')

@section('title', 'Subcategories')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Subcategories</h1>
            <p class="text-sm sm:text-base text-gray-600">Manage product subcategories</p>
        </div>
        <a href="{{ route('admin.subcategories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm sm:text-base w-full sm:w-auto text-center">
            <i class="fas fa-plus mr-2"></i>New Subcategory
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <form method="GET" action="{{ route('admin.subcategories.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="flex items-end">
                <a href="{{ route('admin.subcategories.index') }}" class="w-full bg-gray-200 text-gray-700 px-4 py-2 text-sm rounded-lg hover:bg-gray-300 text-center">
                    Clear Filters
                </a>
            </div>
        </form>
    </div>

    <!-- Subcategories Table - Desktop -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subcategory</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sort Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($subcategories as $subcategory)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($subcategory->icon)
                                        <i class="{{ $subcategory->icon }} text-gray-400 mr-3 text-xl"></i>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $subcategory->name }}</div>
                                        @if($subcategory->description)
                                            <div class="text-sm text-gray-500">{{ Str::limit($subcategory->description, 50) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $subcategory->category->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $subcategory->products_count }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $subcategory->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $subcategory->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $subcategory->sort_order ?? 0 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                <a href="{{ route('admin.subcategories.show', $subcategory->id) }}" 
                                   class="text-green-600 hover:text-green-900 mr-3">View</a>
                                <form method="POST" action="{{ route('admin.subcategories.destroy', $subcategory->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this subcategory?')"
                                            class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No subcategories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Subcategories Cards - Mobile -->
        <div class="md:hidden divide-y divide-gray-200">
            @forelse($subcategories as $subcategory)
                <div class="p-4 bg-white">
                    <div class="flex items-start space-x-3 mb-3">
                        @if($subcategory->icon)
                            <i class="{{ $subcategory->icon }} text-gray-400 text-2xl flex-shrink-0"></i>
                        @endif
                        <div class="flex-1 min-w-0">
                            <div class="text-base font-medium text-gray-900 mb-1">{{ $subcategory->name }}</div>
                            <div class="text-xs text-blue-600 mb-1">{{ $subcategory->category->name }}</div>
                            @if($subcategory->description)
                                <div class="text-sm text-gray-500 line-clamp-2">{{ $subcategory->description }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 mb-3 text-sm">
                        <div>
                            <span class="text-gray-500">Products:</span>
                            <span class="font-medium text-gray-900 ml-1">{{ $subcategory->products_count }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Sort Order:</span>
                            <span class="font-medium text-gray-900 ml-1">{{ $subcategory->sort_order ?? 0 }}</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-gray-500">Status:</span>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ml-1 {{ $subcategory->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $subcategory->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-100">
                        <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}" 
                           class="flex-1 min-w-[70px] text-center text-xs px-3 py-2 bg-blue-50 text-blue-600 hover:bg-blue-100 active:bg-blue-200 rounded-lg font-medium transition-colors">
                            Edit
                        </a>
                        <a href="{{ route('admin.subcategories.show', $subcategory->id) }}" 
                           class="flex-1 min-w-[70px] text-center text-xs px-3 py-2 bg-green-50 text-green-600 hover:bg-green-100 active:bg-green-200 rounded-lg font-medium transition-colors">
                            View
                        </a>
                        <form method="POST" action="{{ route('admin.subcategories.destroy', $subcategory->id) }}" class="flex-1 min-w-[70px]">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this subcategory?')"
                                    class="w-full text-xs px-3 py-2 bg-red-50 text-red-600 hover:bg-red-100 active:bg-red-200 rounded-lg font-medium transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500 text-sm">
                    No subcategories found.
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($subcategories->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $subcategories->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
