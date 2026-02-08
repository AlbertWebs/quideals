@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Categories</h1>
            <p class="text-sm sm:text-base text-gray-600">Manage product categories</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm sm:text-base w-full sm:w-auto text-center">
            <i class="fas fa-plus mr-2"></i>New Category
        </a>
    </div>

    <!-- Categories Table - Desktop -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sort Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($category->icon)
                                        <i class="{{ $category->icon }} text-gray-400 mr-3 text-xl"></i>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                        @if($category->description)
                                            <div class="text-sm text-gray-500">{{ Str::limit($category->description, 50) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $category->products_count }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $category->sort_order ?? 0 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                <a href="{{ route('admin.categories.show', $category->id) }}" 
                                   class="text-green-600 hover:text-green-900 mr-3">View</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this category?')"
                                            class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Categories Cards - Mobile -->
        <div class="md:hidden divide-y divide-gray-200">
            @forelse($categories as $category)
                <div class="p-4 bg-white">
                    <div class="flex items-start space-x-3 mb-3">
                        @if($category->icon)
                            <i class="{{ $category->icon }} text-gray-400 text-2xl flex-shrink-0"></i>
                        @endif
                        <div class="flex-1 min-w-0">
                            <div class="text-base font-medium text-gray-900 mb-1">{{ $category->name }}</div>
                            @if($category->description)
                                <div class="text-sm text-gray-500 line-clamp-2">{{ $category->description }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 mb-3 text-sm">
                        <div>
                            <span class="text-gray-500">Products:</span>
                            <span class="font-medium text-gray-900 ml-1">{{ $category->products_count }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Sort Order:</span>
                            <span class="font-medium text-gray-900 ml-1">{{ $category->sort_order ?? 0 }}</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-gray-500">Status:</span>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ml-1 {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-100">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" 
                           class="flex-1 min-w-[70px] text-center text-xs px-3 py-2 bg-blue-50 text-blue-600 hover:bg-blue-100 active:bg-blue-200 rounded-lg font-medium transition-colors">
                            Edit
                        </a>
                        <a href="{{ route('admin.categories.show', $category->id) }}" 
                           class="flex-1 min-w-[70px] text-center text-xs px-3 py-2 bg-green-50 text-green-600 hover:bg-green-100 active:bg-green-200 rounded-lg font-medium transition-colors">
                            View
                        </a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" class="flex-1 min-w-[70px]">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this category?')"
                                    class="w-full text-xs px-3 py-2 bg-red-50 text-red-600 hover:bg-red-100 active:bg-red-200 rounded-lg font-medium transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500 text-sm">
                    No categories found.
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($categories->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 