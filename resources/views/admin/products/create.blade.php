@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Create Product</h1>
            <p class="text-sm sm:text-base text-gray-600">Add a new product to your store</p>
        </div>
        <a href="{{ route('admin.products.index') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors text-sm sm:text-base w-full sm:w-auto text-center">
            <i class="fas fa-arrow-left mr-2"></i>Back to Products
        </a>
    </div>

    <!-- Create Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:p-6">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                        <input type="text" id="name" name="name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                        <select id="category_id" name="category_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Featured Product</span>
                        </label>
                    </div>

                    <div>
                        <label for="brand_id" class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                        <select id="brand_id" name="brand_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Brand (Optional)</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="hidden">
                        <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity *</label>
                        <input type="number" id="stock_quantity" name="stock_quantity" min="0" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('stock_quantity', 10) }}">
                        @error('stock_quantity')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="space-y-4">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (KES) *</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('price') }}">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="old_price" class="block text-sm font-medium text-gray-700 mb-1">Old Price (KES)</label>
                        <input type="number" id="old_price" name="old_price" step="0.01" min="0"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('old_price') }}">
                        @error('old_price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="hidden">
                        <label for="badge" class="block text-sm font-medium text-gray-700 mb-1">Badge</label>
                        <input type="text" id="badge" name="badge"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('badge', 'New') }}" placeholder="e.g., New, Sale, Featured">
                        @error('badge')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="hidden">
                        <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                        <input type="number" id="rating" name="rating" min="1" max="5" step="0.1"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('rating', number_format(rand(40, 50) / 10, 1)) }}">
                        @error('rating')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="hidden">
                        <label for="reviews_count" class="block text-sm font-medium text-gray-700 mb-1">Reviews Count</label>
                        <input type="number" id="reviews_count" name="reviews_count" min="0"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('reviews_count', rand(1, 20)) }}">
                        @error('reviews_count')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="hidden">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                <textarea id="description" name="description" rows="4" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Enter product description...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Specifications -->
            <div class="space-y-4 hidden">
                <div class="flex items-center justify-between">
                    <label class="block text-sm font-medium text-gray-700">Specifications</label>
                    <button type="button" onclick="addSpecificationRow()"
                            class="text-sm bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition-colors">
                        Add Specification
                    </button>
                </div>

                <div id="specifications-container" class="space-y-3">
                    <div class="specification-row flex items-center space-x-3">
                        <input type="text" name="specifications[0][key]" placeholder="Specification name"
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <input type="text" name="specifications[0][value]" placeholder="Specification value"
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="button" onclick="removeSpecificationRow(this)"
                                class="text-red-600 hover:text-red-800 p-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <p class="text-sm text-gray-500">Add product specifications like dimensions, weight, color, etc.</p>
            </div>

            <!-- Images Section -->
            <div class="space-y-6">
                <h3 class="text-lg font-medium text-gray-900">Product Images</h3>

                <!-- Main Image -->
                <div class="space-y-3">
                    <label class="block text-sm font-medium text-gray-700">Main Image(500px by 500px)</label>

                    <!-- Main Image Upload Area -->
                    <div class="flex items-center space-x-4">
                        <!-- Preview Area -->
                        <div id="main-image-preview" class="flex-shrink-0">
                            <div class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer" onclick="document.getElementById('image').click()">
                                <div class="text-center">
                                    <svg class="mx-auto h-8 w-8 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="text-xs text-gray-500 mt-1">Click to upload</p>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Info -->
                        <div class="flex-1">
                            <input type="file" id="image" name="image" accept="image/*" class="hidden">
                            <div class="space-y-2">
                                <p class="text-sm text-gray-600">Upload the main product image</p>
                                <p class="text-xs text-gray-500">JPEG, PNG, JPG, GIF up to 2MB</p>
                                <p class="text-xs text-gray-500">This will be the primary image shown for the product</p>
                            </div>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Additional Images -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="block text-sm font-medium text-gray-700">Additional Images</label>
                        <span class="text-sm text-gray-500">Selected: <span id="image-count">0</span></span>
                    </div>

                    <!-- Drag and Drop Zone -->
                    <div id="image-drop-zone" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                        <div class="space-y-2">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="text-gray-600">
                                <label for="images" class="cursor-pointer">
                                    <span class="font-medium text-blue-600 hover:text-blue-500">Click to upload</span>
                                    <span class="text-gray-500"> or drag and drop</span>
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB each</p>
                        </div>
                        <input type="file" id="images" name="images[]" accept="image/*" multiple class="hidden">
                    </div>

                    <!-- Image Preview Container -->
                    <div id="image-preview-container" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mt-4"></div>
                </div>

                <!-- Product Video -->
                <div class="space-y-3">
                    <label class="block text-sm font-medium text-gray-700">Product Video (Optional)</label>
                    
                    <!-- Video Upload Area -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <!-- Preview Area -->
                        <div id="video-preview" class="flex-shrink-0 w-full sm:w-auto">
                            <div class="w-full sm:w-48 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer" onclick="document.getElementById('video').click()">
                                <div class="text-center p-4">
                                    <i class="fas fa-video text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-xs text-gray-500">Click to upload video</p>
                                </div>
                            </div>
                            <video id="video-preview-player" class="hidden w-full sm:w-48 h-32 rounded-lg object-cover border-2 border-gray-300" controls></video>
                        </div>

                        <!-- Upload Info -->
                        <div class="flex-1 w-full sm:w-auto">
                            <input type="file" id="video" name="video" accept="video/*" class="hidden">
                            <div class="space-y-2">
                                <p class="text-sm text-gray-600">Upload a product demonstration video</p>
                                <p class="text-xs text-gray-500">MP4, MOV, AVI, WMV, FLV, WEBM up to 10MB</p>
                                <p class="text-xs text-gray-500">This video will be displayed on the product page</p>
                            </div>
                        </div>
                    </div>
                    @error('video')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.products.index') }}" 
                   class="w-full sm:w-auto text-center bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-300 transition-colors text-sm sm:text-base">
                    Cancel
                </a>
                <button type="submit"
                        class="w-full sm:w-auto bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors text-sm sm:text-base font-medium">
                    <i class="fas fa-save mr-2"></i>Create Product
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/product-images.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/product-images.js') }}"></script>
<script>
let specificationIndex = 1;

// Video preview functionality
document.addEventListener('DOMContentLoaded', function() {
    const videoInput = document.getElementById('video');
    const videoPreview = document.getElementById('video-preview');
    const videoPreviewPlayer = document.getElementById('video-preview-player');
    const videoPreviewPlaceholder = videoPreview.querySelector('div');

    if (videoInput) {
        videoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file type
                const validTypes = ['video/mp4', 'video/mov', 'video/avi', 'video/wmv', 'video/flv', 'video/webm'];
                if (!validTypes.includes(file.type) && !file.name.match(/\.(mp4|mov|avi|wmv|flv|webm)$/i)) {
                    alert('Please select a valid video file (MP4, MOV, AVI, WMV, FLV, WEBM)');
                    videoInput.value = '';
                    return;
                }

                // Validate file size (10MB)
                if (file.size > 10 * 1024 * 1024) {
                    alert('Video file size must be less than 10MB');
                    videoInput.value = '';
                    return;
                }

                // Create preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    videoPreviewPlayer.src = e.target.result;
                    videoPreviewPlaceholder.classList.add('hidden');
                    videoPreviewPlayer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }
});

function addSpecificationRow() {
    const container = document.getElementById('specifications-container');
    const newRow = document.createElement('div');
    newRow.className = 'specification-row flex items-center space-x-3';

    newRow.innerHTML = `
        <input type="text" name="specifications[${specificationIndex}][key]" placeholder="Specification name"
               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <input type="text" name="specifications[${specificationIndex}][value]" placeholder="Specification value"
               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <button type="button" onclick="removeSpecificationRow(this)"
                class="text-red-600 hover:text-red-800 p-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </button>
    `;

    container.appendChild(newRow);
    specificationIndex++;
}

function removeSpecificationRow(button) {
    const row = button.closest('.specification-row');
    row.remove();
}
</script>
@endpush
@endsection
