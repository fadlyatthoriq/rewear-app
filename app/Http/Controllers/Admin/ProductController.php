<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('category', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Sorting functionality
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        // Validate sort field to prevent SQL injection
        $allowedSortFields = ['name', 'price', 'stock', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }

        $query->orderBy($sortField, $sortDirection);

        $products = $query->paginate(10)->appends(request()->query());
        $categories = Category::all();
        
        return view('admin.product', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image_url'] = $imagePath;
        }

        Product::create($data);

        Alert::success('Success', 'Product created successfully');
        return redirect()->route('admin.products.index');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image_url'] = $imagePath;
        }

        $product->update($data);

        Alert::success('Success', 'Product updated successfully');
        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }
        
        $product->delete();

        if(request()->ajax()) {
            return response()->json(['success' => true]);
        }

        Alert::success('Success', 'Product deleted successfully');
        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        return response()->json($product);
    }
} 