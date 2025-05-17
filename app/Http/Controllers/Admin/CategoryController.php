<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sorting functionality
        $sortField = $request->get('sort', 'name');
        $sortDirection = $request->get('direction', 'asc');
        
        // Validate sort field to prevent SQL injection
        $allowedSortFields = ['name', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'name';
        }

        $query->orderBy($sortField, $sortDirection);

        $categories = $query->paginate(10)->appends(request()->query());
        return view('admin.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:6000'
        ]);

        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/categories', $imageName);
            $data['image_url'] = 'storage/categories/' . $imageName;
        }

        Category::create($data);

        Alert::success('Success', 'Category created successfully');
        return redirect()->route('admin.categories.index');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:6000'
        ]);

        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image_url) {
                $oldImagePath = str_replace('storage/', 'public/', $category->image_url);
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/categories', $imageName);
            $data['image_url'] = 'storage/categories/' . $imageName;
        }

        $category->update($data);

        Alert::success('Success', 'Category updated successfully');
        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        // Delete image if exists
        if ($category->image_url) {
            $imagePath = str_replace('storage/', 'public/', $category->image_url);
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }

        $category->delete();

        Alert::success('Success', 'Category deleted successfully');
        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        try {
            return response()->json($category);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch category data'], 500);
        }
    }
} 