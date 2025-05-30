<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    protected $cloudinary;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->cloudinary = app('cloudinary');
    }

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

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $result = $this->cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'categories',
                    'resource_type' => 'image',
                    'transformation' => [
                        'width' => 400,
                        'height' => 400,
                        'crop' => 'fill'
                    ]
                ]
            );
            
            $imageUrl = $result['secure_url'];
        }

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageUrl
        ]);

        Alert::success('Success', 'Category created successfully');
        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image from Cloudinary if exists
            if ($category->image) {
                $publicId = $this->getPublicIdFromUrl($category->image);
                if ($publicId) {
                    $this->cloudinary->uploadApi()->destroy($publicId);
                }
            }

            // Upload new image
            $result = $this->cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'categories',
                    'resource_type' => 'image',
                    'transformation' => [
                        'width' => 400,
                        'height' => 400,
                        'crop' => 'fill'
                    ]
                ]
            );
            
            $imageUrl = $result['secure_url'];
        } else {
            $imageUrl = $category->image;
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageUrl
        ]);

        Alert::success('Success', 'Category updated successfully');
        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        // Delete image from Cloudinary if exists
        if ($category->image) {
            $publicId = $this->getPublicIdFromUrl($category->image);
            if ($publicId) {
                $this->cloudinary->uploadApi()->destroy($publicId);
            }
        }

        $category->delete();

        Alert::success('Success', 'Category deleted successfully');
        return redirect()->route('admin.categories.index');
    }

    private function getPublicIdFromUrl($url)
    {
        $pattern = '/\/v\d+\/([^\/]+)\./';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
} 