@extends('layouts.admin')

@section('title', 'Products')

@section('content')
    <div class="space-y-3 sm:space-y-4 lg:space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 sm:gap-4">
            <h1 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900">Products</h1>
            <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm sm:text-base w-full sm:w-auto text-center">
                <i class="fas fa-plus mr-2"></i>Add Product
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow p-3 sm:p-4 lg:p-6">
            <form method="GET" action="{{ route('admin.products.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-2 sm:gap-3 lg:gap-4">
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search products..." 
                           class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Status</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-gray-600 text-white px-4 py-2 text-sm rounded-lg hover:bg-gray-700">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Bulk Actions -->
        <form method="POST" action="{{ route('admin.products.bulk-action') }}" id="bulk-action-form">
            @csrf
            <input type="hidden" name="action" id="bulk-action">
            <input type="hidden" name="product_ids" id="product-ids">
            
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-3 sm:px-4 lg:px-6 py-2.5 sm:py-3 lg:py-4 border-b border-gray-200">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between sm:gap-3">
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 w-4 h-4 flex-shrink-0">
                            <label for="select-all" class="text-xs sm:text-sm font-medium text-gray-700">Select All</label>
                        </div>
                        
                        <div class="flex flex-wrap items-center gap-1.5 sm:gap-2">
                            <button type="button" onclick="bulkAction('activate')" class="text-xs px-2.5 py-1.5 sm:px-3 sm:py-2 bg-green-50 text-green-600 hover:bg-green-100 active:bg-green-200 rounded-lg font-medium transition-colors">
                                Activate
                            </button>
                            <button type="button" onclick="bulkAction('deactivate')" class="text-xs px-2.5 py-1.5 sm:px-3 sm:py-2 bg-yellow-50 text-yellow-600 hover:bg-yellow-100 active:bg-yellow-200 rounded-lg font-medium transition-colors">
                                Deactivate
                            </button>
                            <button type="button" onclick="bulkAction('delete')" class="text-xs px-2.5 py-1.5 sm:px-3 sm:py-2 bg-red-50 text-red-600 hover:bg-red-100 active:bg-red-200 rounded-lg font-medium transition-colors">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Products Table - Desktop -->
                <div class="hidden md:block w-full">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 lg:px-4 xl:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Product
                                </th>
                                <th class="px-3 lg:px-4 xl:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category
                                </th>
                                <th class="px-3 lg:px-4 xl:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price
                                </th>
                                <th class="px-3 lg:px-4 xl:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stock
                                </th>
                                <th class="px-3 lg:px-4 xl:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-3 lg:px-4 xl:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($products as $product)
                                <tr>
                                    <td class="px-3 lg:px-4 xl:px-6 py-4">
                                        <div class="flex items-center min-w-0">
                                            <input type="checkbox" name="selected_products[]" value="{{ $product->id }}" 
                                                   class="product-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500 mr-2 flex-shrink-0 w-4 h-4">
                                            <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" class="w-10 h-10 object-cover rounded flex-shrink-0">
                                            <div class="ml-3 min-w-0 flex-1">
                                                <div class="text-sm font-medium text-gray-900 truncate">{{ $product->name }}</div>
                                                <div class="text-xs text-gray-500 truncate">{{ Str::limit($product->description, 40) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 lg:px-4 xl:px-6 py-4 text-sm text-gray-900">
                                        <div class="truncate max-w-[120px]">{{ $product->category->name }}</div>
                                    </td>
                                    <td class="px-3 lg:px-4 xl:px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $product->formatted_price }}
                                    </td>
                                    <td class="px-3 lg:px-4 xl:px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $product->stock_quantity }}
                                    </td>
                                    <td class="px-3 lg:px-4 xl:px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-3 lg:px-4 xl:px-6 py-4 text-sm font-medium whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                            <span class="text-gray-300">|</span>
                                            <a href="{{ route('admin.products.show', $product) }}" class="text-green-600 hover:text-green-900">View</a>
                                            <span class="text-gray-300">|</span>
                                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" 
                                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        No products found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Products Cards - Mobile -->
                <div class="md:hidden divide-y divide-gray-200">
                    @forelse($products as $product)
                        <div class="p-3 sm:p-4 bg-white">
                            <div class="flex items-start space-x-2 sm:space-x-3 mb-2 sm:mb-3">
                                <input type="checkbox" name="selected_products[]" value="{{ $product->id }}" 
                                       class="product-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500 mt-0.5 w-4 h-4 flex-shrink-0">
                                <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" class="w-14 h-14 sm:w-16 sm:h-16 object-cover rounded flex-shrink-0">
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm sm:text-base font-medium text-gray-900 mb-0.5 sm:mb-1 line-clamp-1">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500 line-clamp-2">{{ Str::limit($product->description, 50) }}</div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-2 sm:gap-3 mb-2 sm:mb-3 text-xs">
                                <div class="truncate">
                                    <span class="text-gray-500">Category:</span>
                                    <span class="font-medium text-gray-900 ml-1 truncate block">{{ $product->category->name }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Price:</span>
                                    <span class="font-medium text-gray-900 ml-1">{{ $product->formatted_price }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Stock:</span>
                                    <span class="font-medium text-gray-900 ml-1">{{ $product->stock_quantity }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Status:</span>
                                    <span class="inline-flex items-center px-1.5 py-0.5 sm:px-2 rounded-full text-xs font-medium ml-1 {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="flex flex-wrap gap-1.5 sm:gap-2 pt-2 border-t border-gray-100">
                                <a href="{{ route('admin.products.edit', $product) }}" class="flex-1 min-w-[70px] sm:min-w-[80px] text-center text-xs px-2 sm:px-3 py-2 bg-blue-50 text-blue-600 hover:bg-blue-100 active:bg-blue-200 rounded-lg font-medium transition-colors">
                                    Edit
                                </a>
                                <a href="{{ route('admin.products.show', $product) }}" class="flex-1 min-w-[70px] sm:min-w-[80px] text-center text-xs px-2 sm:px-3 py-2 bg-green-50 text-green-600 hover:bg-green-100 active:bg-green-200 rounded-lg font-medium transition-colors">
                                    View
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="flex-1 min-w-[70px] sm:min-w-[80px]">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full text-xs px-2 sm:px-3 py-2 bg-red-50 text-red-600 hover:bg-red-100 active:bg-red-200 rounded-lg font-medium transition-colors" 
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 sm:p-6 text-center text-gray-500 text-sm">
                            No products found.
                        </div>
                    @endforelse
                </div>
            </div>
        </form>

        <!-- Pagination -->
        <div class="mt-4 sm:mt-6">
            <div class="flex flex-wrap justify-center items-center gap-2">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <script>
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Select all functionality
            const selectAllCheckbox = document.getElementById('select-all');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('.product-checkbox');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            }

            // Update select-all checkbox state when individual checkboxes change
            const productCheckboxes = document.querySelectorAll('.product-checkbox');
            productCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const allChecked = document.querySelectorAll('.product-checkbox:checked').length;
                    const totalCheckboxes = document.querySelectorAll('.product-checkbox').length;
                    if (selectAllCheckbox) {
                        selectAllCheckbox.checked = allChecked === totalCheckboxes && totalCheckboxes > 0;
                    }
                });
            });
        });

        // Bulk action functionality
        function bulkAction(action) {
            const checkboxes = document.querySelectorAll('.product-checkbox:checked');
            
            if (checkboxes.length === 0) {
                alert('Please select at least one product.');
                return;
            }

            const productIds = Array.from(checkboxes).map(cb => cb.value);
            
            // Validate product IDs
            if (!productIds || productIds.length === 0) {
                alert('No valid products selected.');
                return;
            }

            const actionInput = document.getElementById('bulk-action');
            const productIdsInput = document.getElementById('product-ids');
            const form = document.getElementById('bulk-action-form');

            if (!actionInput || !productIdsInput || !form) {
                alert('Form elements not found. Please refresh the page and try again.');
                console.error('Form elements missing:', {
                    actionInput: !!actionInput,
                    productIdsInput: !!productIdsInput,
                    form: !!form
                });
                return;
            }

            actionInput.value = action;
            productIdsInput.value = JSON.stringify(productIds);
            
            console.log('Bulk action:', {
                action: action,
                productIds: productIds,
                productIdsString: productIdsInput.value
            });
            
            if (action === 'delete') {
                if (!confirm('Are you sure you want to delete ' + productIds.length + ' selected product(s)?')) {
                    return;
                }
            }
            
            // Submit the form
            form.submit();
        }
    </script>
@endsection 