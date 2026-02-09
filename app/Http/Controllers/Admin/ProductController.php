<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Search
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->status !== null) {
            $query->where('is_active', $request->status);
        }

        $products = $query->latest()->paginate(15);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::active()->ordered()->get();
        $brands = Brand::active()->ordered()->get();
        return view('admin.products.create', compact('categories', 'subcategories', 'brands'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'subcategory_id' => 'nullable|exists:subcategories,id',
                'short_description' => 'nullable|string|max:500',
                'description' => 'required|string',
                'brand' => 'nullable|string|max:100',
                'price' => 'required|numeric|min:0',
                'old_price' => 'nullable|numeric|min:0',
                'stock_quantity' => 'required|integer|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'video' => 'nullable|mimes:mp4,mov,avi,wmv,flv,webm|max:10240',
                'badge' => 'nullable|string|max:50',
                'rating' => 'nullable|numeric|min:1|max:5',
                'reviews_count' => 'nullable|integer|min:0',
                'is_featured' => 'boolean',
                'is_active' => 'boolean',
                'specifications' => 'nullable|array',
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            // Handle main image upload
            if ($request->hasFile('image')) {
                try {
                    $validated['image'] = $request->file('image')->store('products', 'public');
                    Log::info('Product image uploaded successfully', ['path' => $validated['image']]);
                } catch (Exception $e) {
                    Log::error('Failed to upload product main image', [
                        'error' => $e->getMessage(),
                        'file' => $request->file('image')->getClientOriginalName()
                    ]);
                    throw $e;
                }
            }

            // Handle additional images upload
            if ($request->hasFile('images')) {
                try {
                    $images = [];
                    foreach ($request->file('images') as $image) {
                        $images[] = $image->store('products', 'public');
                    }
                    $validated['images'] = array_values($images);
                    Log::info('Product additional images uploaded successfully', ['count' => count($images)]);
                } catch (Exception $e) {
                    Log::error('Failed to upload product additional images', [
                        'error' => $e->getMessage()
                    ]);
                    throw $e;
                }
            }

            // Handle video upload
            if ($request->hasFile('video')) {
                try {
                    $validated['video'] = $request->file('video')->store('products/videos', 'public');
                    Log::info('Product video uploaded successfully', ['path' => $validated['video']]);
                } catch (Exception $e) {
                    Log::error('Failed to upload product video', [
                        'error' => $e->getMessage(),
                        'file' => $request->file('video')->getClientOriginalName()
                    ]);
                    throw $e;
                }
            }

            // Process specifications
            if (isset($validated['specifications'])) {
                $specifications = [];
                foreach ($validated['specifications'] as $spec) {
                    if (!empty($spec['key']) && !empty($spec['value'])) {
                        $specifications[$spec['key']] = $spec['value'];
                    }
                }
                $validated['specifications'] = $specifications;
            }

            $product = Product::create($validated);
            Log::info('Product created successfully', ['product_id' => $product->id, 'name' => $product->name]);

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Product creation validation failed', [
                'errors' => $e->errors(),
                'input' => $request->except(['image', 'images'])
            ]);
            throw $e;
        } catch (Exception $e) {
            Log::error('Failed to create product', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->except(['image', 'images'])
            ]);
            return redirect()->back()->withInput()->with('error', 'Failed to create product. Please try again.');
        }
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $subcategories = Subcategory::active()->ordered()->get();
        $brands = Brand::active()->ordered()->get();
        return view('admin.products.edit', compact('product', 'categories', 'subcategories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'subcategory_id' => 'nullable|exists:subcategories,id',
                'brand_id' => 'nullable|exists:brands,id',
                'short_description' => 'nullable|string|max:500',
                'description' => 'required|string',
                'brand' => 'nullable|string|max:100',
                'price' => 'required|numeric|min:0',
                'old_price' => 'nullable|numeric|min:0',
                'stock_quantity' => 'required|integer|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'video' => 'nullable|mimes:mp4,mov,avi,wmv,flv,webm|max:10240',
                'delete_video' => 'nullable|boolean',
                'delete_images' => 'nullable|array',
                'delete_images.*' => 'nullable|string',
                'badge' => 'nullable|string|max:50',
                'rating' => 'nullable|numeric|min:1|max:5',
                'reviews_count' => 'nullable|integer|min:0',
                'is_featured' => 'boolean',
                'is_active' => 'boolean',
                'specifications' => 'nullable|array',
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            // Handle main image upload
            if ($request->hasFile('image')) {
                try {
                    // Delete old main image if exists (only if it's a storage file)
                    if ($product->image && !str_starts_with($product->image, '/assets/')) {
                        Storage::disk('public')->delete($product->image);
                    }
                    $validated['image'] = $request->file('image')->store('products', 'public');
                    Log::info('Product main image updated', ['product_id' => $product->id, 'path' => $validated['image']]);
                } catch (Exception $e) {
                    Log::error('Failed to update product main image', [
                        'product_id' => $product->id,
                        'error' => $e->getMessage(),
                        'file' => $request->file('image')->getClientOriginalName()
                    ]);
                    throw $e;
                }
            }

            // Start with existing images
            $currentImages = $product->images ?? [];
            
            // Clean up current images array to remove invalid entries
            $currentImages = array_filter($currentImages, function($image) {
                return is_string($image) && !empty(trim($image));
            });

            // Handle image deletions
            $imagesToDelete = [];
            
            // Check for array format
            if ($request->has('delete_images')) {
                $imagesToDelete = $request->delete_images;
            }
            
            // Remove duplicates and filter out empty values
            $imagesToDelete = array_unique(array_filter($imagesToDelete, function($image) {
                return is_string($image) && !empty(trim($image));
            }));
            
            if (!empty($imagesToDelete)) {
                // Delete main image if it's in the delete list
                if (in_array($product->image, $imagesToDelete)) {
                    // Only delete from storage if it's a storage file (not a public asset)
                    if (!str_starts_with($product->image, '/assets/')) {
                        Storage::disk('public')->delete($product->image);
                    }
                    $validated['image'] = null;
                    Log::info('Main image deleted:', ['product_id' => $product->id, 'image' => $product->image]);
                }
                
                // Remove deleted images from current images array
                $currentImages = array_filter($currentImages, function($image) use ($imagesToDelete) {
                    if (in_array($image, $imagesToDelete)) {
                        // Only delete from storage if it's a storage file (not a public asset)
                        if (!str_starts_with($image, '/assets/')) {
                            Storage::disk('public')->delete($image);
                        }
                        Log::info('Additional image deleted:', ['image' => $image]);
                        return false;
                    }
                    return true;
                });
            }

            // Handle additional images upload
            if ($request->hasFile('images')) {
                try {
                    foreach ($request->file('images') as $image) {
                        $currentImages[] = $image->store('products', 'public');
                    }
                    Log::info('Product additional images uploaded', ['product_id' => $product->id, 'count' => count($request->file('images'))]);
                } catch (Exception $e) {
                    Log::error('Failed to upload product additional images', [
                        'product_id' => $product->id,
                        'error' => $e->getMessage()
                    ]);
                    throw $e;
                }
            }
            
            // Set the final images array
            $validated['images'] = array_values($currentImages);

            // Handle video deletion
            if ($request->has('delete_video') && $request->delete_video) {
                if ($product->video && !str_starts_with($product->video, '/assets/')) {
                    Storage::disk('public')->delete($product->video);
                }
                $validated['video'] = null;
                Log::info('Product video deleted', ['product_id' => $product->id]);
            }

            // Handle video upload
            if ($request->hasFile('video')) {
                try {
                    // Delete old video if exists (only if it's a storage file)
                    if ($product->video && !str_starts_with($product->video, '/assets/')) {
                        Storage::disk('public')->delete($product->video);
                    }
                    $validated['video'] = $request->file('video')->store('products/videos', 'public');
                    Log::info('Product video updated', ['product_id' => $product->id, 'path' => $validated['video']]);
                } catch (Exception $e) {
                    Log::error('Failed to update product video', [
                        'product_id' => $product->id,
                        'error' => $e->getMessage(),
                        'file' => $request->file('video')->getClientOriginalName()
                    ]);
                    throw $e;
                }
            }

            // Process specifications
            if (isset($validated['specifications'])) {
                $specifications = [];
                foreach ($validated['specifications'] as $spec) {
                    if (!empty($spec['key']) && !empty($spec['value'])) {
                        $specifications[$spec['key']] = $spec['value'];
                    }
                }
                $validated['specifications'] = $specifications;
            }

            $product->update($validated);
            Log::info('Product updated successfully', ['product_id' => $product->id, 'name' => $product->name]);

            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Product update validation failed', [
                'product_id' => $product->id,
                'errors' => $e->errors(),
                'input' => $request->except(['image', 'images'])
            ]);
            throw $e;
        } catch (Exception $e) {
            Log::error('Failed to update product', [
                'product_id' => $product->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->except(['image', 'images'])
            ]);
            return redirect()->back()->withInput()->with('error', 'Failed to update product. Please try again.');
        }
    }

    public function testUpdate(Request $request)
    {
        // Log all request data for debugging
        \Log::info('Test Update - All request data:', $request->all());
        
        // Check for delete_images specifically
        if ($request->has('delete_images')) {
            \Log::info('Test Update - delete_images found:', $request->delete_images);
        } else {
            \Log::info('Test Update - No delete_images in request');
        }
        
        // Check all hidden inputs
        $allInputs = $request->all();
        $deleteImagesFromInputs = [];
        foreach ($allInputs as $key => $value) {
            if (strpos($key, 'delete_images') === 0) {
                $deleteImagesFromInputs[] = $value;
            }
        }
        \Log::info('Test Update - delete_images from inputs:', $deleteImagesFromInputs);
        
        return response()->json([
            'success' => true,
            'message' => 'Test update received',
            'delete_images' => $request->delete_images ?? [],
            'all_inputs' => $allInputs
        ]);
    }

    public function destroy(Product $product)
    {
        try {
            $productId = $product->id;
            $productName = $product->name;
            
            // Delete all product images
            if ($product->image) {
                try {
                    // Only delete from storage if it's a storage file (not a public asset)
                    if (!str_starts_with($product->image, '/assets/')) {
                        Storage::disk('public')->delete($product->image);
                        Log::info('Product main image deleted', ['product_id' => $productId, 'image' => $product->image]);
                    }
                } catch (Exception $e) {
                    Log::error('Failed to delete product main image', [
                        'product_id' => $productId,
                        'image' => $product->image,
                        'error' => $e->getMessage()
                    ]);
                }
            }
            
            if ($product->images && is_array($product->images)) {
                foreach ($product->images as $image) {
                    try {
                        // Only delete from storage if it's a storage file (not a public asset)
                        if (!str_starts_with($image, '/assets/')) {
                            Storage::disk('public')->delete($image);
                        }
                    } catch (Exception $e) {
                        Log::error('Failed to delete product additional image', [
                            'product_id' => $productId,
                            'image' => $image,
                            'error' => $e->getMessage()
                        ]);
                    }
                }
            }

            // Delete product video
            if ($product->video) {
                try {
                    // Only delete from storage if it's a storage file (not a public asset)
                    if (!str_starts_with($product->video, '/assets/')) {
                        Storage::disk('public')->delete($product->video);
                        Log::info('Product video deleted', ['product_id' => $productId, 'video' => $product->video]);
                    }
                } catch (Exception $e) {
                    Log::error('Failed to delete product video', [
                        'product_id' => $productId,
                        'video' => $product->video,
                        'error' => $e->getMessage()
                    ]);
                }
            }
            
            $product->delete();
            Log::info('Product deleted successfully', ['product_id' => $productId, 'name' => $productName]);
            
            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
        } catch (Exception $e) {
            Log::error('Failed to delete product', [
                'product_id' => $product->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('admin.products.index')->with('error', 'Failed to delete product. Please try again.');
        }
    }

    public function bulkAction(Request $request)
    {
        try {
            // Log all request data for debugging
            Log::info('Bulk action request received', [
                'action' => $request->action,
                'product_ids' => $request->product_ids,
                'all_request_data' => $request->all()
            ]);

            $action = $request->action;
            $productIds = $request->product_ids;

            if (!$productIds) {
                Log::warning('Bulk action attempted without product selection', [
                    'request_data' => $request->all()
                ]);
                return back()->with('error', 'No products selected.');
            }

            // Decode JSON string if it's a string
            if (is_string($productIds)) {
                $productIds = json_decode($productIds, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::error('Failed to decode product_ids JSON', ['product_ids' => $request->product_ids, 'error' => json_last_error_msg()]);
                    return back()->with('error', 'Invalid product selection format.');
                }
            }

            // Ensure productIds is an array
            if (!is_array($productIds) || empty($productIds)) {
                Log::warning('Bulk action attempted with invalid product selection', ['product_ids' => $request->product_ids]);
                return back()->with('error', 'No products selected.');
            }

            switch ($action) {
                case 'activate':
                    try {
                        Product::whereIn('id', $productIds)->update(['is_active' => true]);
                        Log::info('Products activated via bulk action', ['product_ids' => $productIds, 'count' => count($productIds)]);
                        $message = 'Products activated successfully.';
                    } catch (Exception $e) {
                        Log::error('Failed to activate products', [
                            'product_ids' => $productIds,
                            'error' => $e->getMessage()
                        ]);
                        throw $e;
                    }
                    break;
                case 'deactivate':
                    try {
                        Product::whereIn('id', $productIds)->update(['is_active' => false]);
                        Log::info('Products deactivated via bulk action', ['product_ids' => $productIds, 'count' => count($productIds)]);
                        $message = 'Products deactivated successfully.';
                    } catch (Exception $e) {
                        Log::error('Failed to deactivate products', [
                            'product_ids' => $productIds,
                            'error' => $e->getMessage()
                        ]);
                        throw $e;
                    }
                    break;
                case 'delete':
                    try {
                        $products = Product::whereIn('id', $productIds)->get();
                        foreach ($products as $product) {
                            // Delete all product images
                            if ($product->image) {
                                try {
                                    // Only delete from storage if it's a storage file (not a public asset)
                                    if (!str_starts_with($product->image, '/assets/')) {
                                        Storage::disk('public')->delete($product->image);
                                    }
                                } catch (Exception $e) {
                                    Log::error('Failed to delete product image in bulk delete', [
                                        'product_id' => $product->id,
                                        'image' => $product->image,
                                        'error' => $e->getMessage()
                                    ]);
                                }
                            }
                            
                            if ($product->images && is_array($product->images)) {
                                foreach ($product->images as $image) {
                                    try {
                                        // Only delete from storage if it's a storage file (not a public asset)
                                        if (!str_starts_with($image, '/assets/')) {
                                            Storage::disk('public')->delete($image);
                                        }
                                    } catch (Exception $e) {
                                        Log::error('Failed to delete product additional image in bulk delete', [
                                            'product_id' => $product->id,
                                            'image' => $image,
                                            'error' => $e->getMessage()
                                        ]);
                                    }
                                }
                            }
                        }
                        Product::whereIn('id', $productIds)->delete();
                        Log::info('Products deleted via bulk action', ['product_ids' => $productIds, 'count' => count($productIds)]);
                        $message = 'Products deleted successfully.';
                    } catch (Exception $e) {
                        Log::error('Failed to delete products via bulk action', [
                            'product_ids' => $productIds,
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);
                        throw $e;
                    }
                    break;
                default:
                    Log::warning('Invalid bulk action attempted', ['action' => $action]);
                    return back()->with('error', 'Invalid action.');
            }

            return back()->with('success', $message);
        } catch (Exception $e) {
            Log::error('Bulk action failed', [
                'action' => $request->action,
                'product_ids' => $request->product_ids,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Failed to perform bulk action. Please try again.');
        }
    }

    public function uploadImage(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $path = $request->file('image')->store('products', 'public');
            Log::info('Image uploaded via uploadImage method', ['path' => $path]);
            
            return response()->json([
                'success' => true,
                'path' => $path,
                'url' => asset('storage/' . $path)
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Image upload validation failed', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('Failed to upload image', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image. Please try again.'
            ], 500);
        }
    }
} 