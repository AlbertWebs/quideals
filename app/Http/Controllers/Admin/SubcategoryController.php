<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Subcategory::with(['category', 'products'])->withCount('products');

        // Filter by category if provided
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->status !== null) {
            $query->where('is_active', $request->status);
        }

        $subcategories = $query->orderBy('sort_order')->paginate(15);
        $categories = Category::active()->ordered()->get();

        return view('admin.subcategories.index', compact('subcategories', 'categories'));
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Subcategory::create($validated);

        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory created successfully.');
    }

    public function show($id)
    {
        $subcategory = Subcategory::with(['category', 'products'])->findOrFail($id);
        return view('admin.subcategories.show', compact('subcategory'));
    }

    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::active()->ordered()->get();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $subcategory->update($validated);

        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory updated successfully.');
    }

    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        
        // Check if subcategory has products
        if ($subcategory->products()->count() > 0) {
            return back()->with('error', 'Cannot delete subcategory with existing products.');
        }

        $subcategory->delete();
        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory deleted successfully.');
    }
}
