@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Edit Product</h1>
            <p class="text-sm sm:text-base text-gray-600">Update product information</p>
        </div>
        <a href="{{ route('admin.products.index') }}" 
           class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors text-sm sm:text-base w-full sm:w-auto text-center">
            <i class="fas fa-arrow-left mr-2"></i>Back to Products
        </a>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:p-6">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <!-- Hidden field to ensure proper form encoding -->
            <input type="hidden" name="_method" value="PUT">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                        <input type="text" id="name" name="name" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('name', $product->name) }}">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                        <textarea id="short_description" name="short_description" rows="3" maxlength="500"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Brief product summary (max 500 characters)...">{{ old('short_description', $product->short_description) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">A brief summary that appears in product listings and at the top of product pages</p>
                        @error('short_description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                        <select id="category_id" name="category_id" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subcategory_id" class="block text-sm font-medium text-gray-700 mb-1">Subcategory (Optional)</label>
                        <select id="subcategory_id" name="subcategory_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Subcategory</option>
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" 
                                        data-category-id="{{ $subcategory->category_id }}"
                                        {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                    {{ $subcategory->category->name }} - {{ $subcategory->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subcategory_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
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
                                <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
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
                               value="{{ old('stock_quantity', $product->stock_quantity ?? 10) }}">
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
                               value="{{ old('price', $product->price) }}">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="old_price" class="block text-sm font-medium text-gray-700 mb-1">Old Price (KES)</label>
                        <input type="number" id="old_price" name="old_price" step="0.01" min="0" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('old_price', $product->old_price) }}">
                        @error('old_price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="hidden">
                        <label for="badge" class="block text-sm font-medium text-gray-700 mb-1">Badge</label>
                        <input type="text" id="badge" name="badge" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('badge', $product->badge ?? 'New') }}" placeholder="e.g., New, Sale, Featured">
                        @error('badge')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="hidden">
                        <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                        <input type="number" id="rating" name="rating" min="1" max="5" step="0.1"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('rating', $product->rating) }}">
                        @error('rating')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="hidden">
                        <label for="reviews_count" class="block text-sm font-medium text-gray-700 mb-1">Reviews Count</label>
                        <input type="number" id="reviews_count" name="reviews_count" min="0" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('reviews_count', $product->reviews_count) }}">
                        @error('reviews_count')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="hidden">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                <textarea id="description" name="description" rows="10" required 
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Enter product description...">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-1">Use the editor above to format your description with HTML (bold, lists, links, etc.)</p>
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
                    @if($product->specifications && count($product->specifications) > 0)
                        @foreach($product->specifications as $key => $value)
                            <div class="specification-row flex items-center space-x-3">
                                <input type="text" name="specifications[{{ $loop->index }}][key]" 
                                       value="{{ $key }}" placeholder="Specification name" 
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <input type="text" name="specifications[{{ $loop->index }}][value]" 
                                       value="{{ $value }}" placeholder="Specification value" 
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <button type="button" onclick="removeSpecificationRow(this)" 
                                        class="text-red-600 hover:text-red-800 p-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    @else
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
                    @endif
                </div>
                
                <p class="text-sm text-gray-500">Add product specifications like dimensions, weight, color, etc.</p>
            </div>

            <!-- Images Section -->
            <div class="space-y-6">
                <h3 class="text-lg font-medium text-gray-900">Product Images</h3>
                
                <!-- Current Images -->
                @if($product->image || ($product->images && count($product->images) > 0))
                    <div class="space-y-4">
                        <h4 class="text-md font-medium text-gray-700">Current Images</h4>
                        
                        <!-- Main Image -->
                        @if($product->image)
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Main Image</label>
                                <div id="existing-main-image" class="relative group">
                                    <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" 
                                         class="w-32 h-32 object-cover rounded-lg border" data-image-path="{{ $product->image }}">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                        <button type="button" onclick="productImageManager.removeMainImage()" 
                                                class="bg-red-500 text-white p-1 rounded-full hover:bg-red-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Additional Images -->
                        @if($product->getValidImages() && count($product->getValidImages()) > 0)
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Additional Images</label>
                                <div id="existing-images-container" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                                    @foreach($product->getValidImages() as $index => $image)
                                        <div id="existing-img-{{ $index }}" class="relative group" data-image-path="{{ $image }}">
                                            <img src="{{ $product->getImageUrlAttribute($image) }}" alt="{{ $product->name }}" 
                                                 class="w-24 h-24 object-cover rounded-lg border">
                                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                                <button type="button" onclick="productImageManager.removeExistingImage('existing-img-{{ $index }}', '{{ $image }}')" 
                                                        class="bg-red-500 text-white p-1 rounded-full hover:bg-red-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- New Images -->
                <div class="space-y-6">
                    <h4 class="text-md font-medium text-gray-700">Add New Images</h4>
                    
                    <!-- New Main Image -->
                    <div class="space-y-3">
                        <label class="block text-sm font-medium text-gray-700">New Main Image</label>
                        
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
                                    <p class="text-sm text-gray-600">Upload a new main image</p>
                                    <p class="text-xs text-gray-500">JPEG, PNG, JPG, GIF up to 2MB</p>
                                    <p class="text-xs text-gray-500">Leave empty to keep current image</p>
                                </div>
                            </div>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Additional Images -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700">New Additional Images</label>
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
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700">Product Video (Optional)</label>
                            @if($product->video)
                                <label class="flex items-center text-sm text-red-600 hover:text-red-700 cursor-pointer">
                                    <input type="checkbox" name="delete_video" value="1" class="mr-2 rounded border-gray-300 text-red-600 focus:ring-red-500">
                                    Delete video
                                </label>
                            @endif
                        </div>
                        
                        <!-- Current Video -->
                        @if($product->video)
                            <div class="mb-4 p-4 bg-gray-50 rounded-lg border-2 border-gray-200">
                                <p class="text-sm font-medium text-gray-700 mb-2">Current Video:</p>
                                <video class="w-full max-w-md h-64 rounded-lg object-cover border-2 border-gray-300" controls>
                                    <source src="{{ $product->video_url }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif

                        <!-- Video Upload Area -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
                            <!-- Preview Area -->
                            <div id="video-preview" class="flex-shrink-0 w-full sm:w-auto">
                                <div class="w-full sm:w-48 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer" onclick="document.getElementById('video').click()">
                                    <div class="text-center p-4">
                                        <i class="fas fa-video text-3xl text-gray-400 mb-2"></i>
                                        <p class="text-xs text-gray-500">{{ $product->video ? 'Replace video' : 'Click to upload video' }}</p>
                                    </div>
                                </div>
                                <video id="video-preview-player" class="hidden w-full sm:w-48 h-32 rounded-lg object-cover border-2 border-gray-300" controls></video>
                            </div>

                            <!-- Upload Info -->
                            <div class="flex-1 w-full sm:w-auto">
                                <input type="file" id="video" name="video" accept="video/*" class="hidden">
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">{{ $product->video ? 'Upload a new video to replace the current one' : 'Upload a product demonstration video' }}</p>
                                    <p class="text-xs text-gray-500">MP4, MOV, AVI, WMV, FLV, WEBM up to 10MB</p>
                                    <p class="text-xs text-gray-500">Leave empty to keep current video</p>
                                </div>
                            </div>
                        </div>
                        @error('video')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
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
                    <i class="fas fa-save mr-2"></i>Update Product
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/product-images.css') }}">
<style>
    .ck-editor__editable {
        min-height: 300px;
    }
    @media (max-width: 640px) {
        .ck-editor__editable {
            min-height: 250px;
        }
    }
    .ck-content {
        font-size: 14px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script src="{{ asset('assets/js/product-images.js') }}"></script>
<script>
let specificationIndex = {{ $product->specifications ? count($product->specifications) : 1 }};

// Initialize CKEditor for description
document.addEventListener('DOMContentLoaded', function() {
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'link', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'blockQuote', 'insertTable', '|',
                    'undo', 'redo'
                ]
            },
            language: 'en',
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            }
        })
        .then(editor => {
            console.log('CKEditor initialized successfully', editor);
        })
        .catch(error => {
            console.error('Error initializing CKEditor:', error);
        });
});

// Subcategory filtering based on category selection
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category_id');
    const subcategorySelect = document.getElementById('subcategory_id');
    
    if (categorySelect && subcategorySelect) {
        categorySelect.addEventListener('change', function() {
            const selectedCategoryId = this.value;
            const options = subcategorySelect.querySelectorAll('option');
            
            // Show/hide subcategories based on selected category
            options.forEach(option => {
                if (option.value === '') {
                    option.style.display = 'block'; // Always show "Select Subcategory"
                } else {
                    const categoryId = option.getAttribute('data-category-id');
                    if (categoryId === selectedCategoryId) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                }
            });
            
            // Reset subcategory selection if it doesn't belong to selected category
            const selectedSubcategory = subcategorySelect.value;
            if (selectedSubcategory) {
                const selectedOption = subcategorySelect.querySelector(`option[value="${selectedSubcategory}"]`);
                if (selectedOption && selectedOption.getAttribute('data-category-id') !== selectedCategoryId) {
                    subcategorySelect.value = '';
                }
            }
        });
        
        // Trigger on page load if category is already selected
        if (categorySelect.value) {
            categorySelect.dispatchEvent(new Event('change'));
        }
    }
});

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