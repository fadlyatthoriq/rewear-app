<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
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

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'condition' => 'required|in:new,like_new,good,fair',
            'status' => 'required|in:active,inactive,sold'
        ]);

        if ($request->hasFile('image')) {
            $result = $this->cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'products',
                    'resource_type' => 'image',
                    'transformation' => [
                        'width' => 800,
                        'height' => 800,
                        'crop' => 'fill'
                    ]
                ]
            );
            
            $imageUrl = $result['secure_url'];
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imageUrl,
            'condition' => $request->condition,
            'status' => $request->status,
            'user_id' => auth()->id()
        ]);

        Alert::success('Success', 'Product created successfully');
        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        if (request()->ajax()) {
            return response()->json($product);
        }
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|mimes:jpeg,png,jpg,avif,webp|max:2048',
            'condition' => 'required|in:new,like_new,good,fair',
            'status' => 'required|in:active,inactive,sold'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image from Cloudinary if exists
            if ($product->image) {
                $publicId = $this->getPublicIdFromUrl($product->image);
                if ($publicId) {
                    $this->cloudinary->uploadApi()->destroy($publicId);
                }
            }

            // Upload new image
            $result = $this->cloudinary->uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'products',
                    'resource_type' => 'image',
                    'transformation' => [
                        'width' => 800,
                        'height' => 800,
                        'crop' => 'fill'
                    ]
                ]
            );
            
            $imageUrl = $result['secure_url'];
        } else {
            $imageUrl = $product->image;
        }

        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'category_id' => $validatedData['category_id'],
            'image' => $imageUrl,
            'condition' => $validatedData['condition'],
            'status' => $validatedData['status']
        ]);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Product updated successfully']);
        }
        
        Alert::success('Success', 'Product updated successfully');
        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        // Delete image from Cloudinary if exists
        if ($product->image) {
            $publicId = $this->getPublicIdFromUrl($product->image);
            if ($publicId) {
                $this->cloudinary->uploadApi()->destroy($publicId);
            }
        }

        $product->delete();

        if(request()->ajax()) {
            return response()->json(['success' => true]);
        }

        Alert::success('Success', 'Product deleted successfully');
        return redirect()->route('admin.products.index');
    }

    private function getPublicIdFromUrl($url)
    {
        $pattern = '/\/v\d+\/([^\/]+)\./';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }

    private function validateProduct(Request $request, $product = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'images.*' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048', // 2MB max
                'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000'
            ],
            'images' => 'array|max:5', // Maximum 5 images
        ];

        if (!$product) {
            $rules['images'] = 'required|array|min:1|max:5';
            $rules['images.*'] = 'required|' . $rules['images.*'];
        }

        return $request->validate($rules);
    }

    private function handleImageUpload($request, $product = null)
    {
        if (!$request->hasFile('images')) {
            return $product ? $product->images : [];
        }

        $uploadedImages = [];
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];

        foreach ($request->file('images') as $image) {
            // Validate mime type
            if (!in_array($image->getMimeType(), $allowedMimeTypes)) {
                throw new \Exception('Invalid file type. Only JPEG, PNG, and WebP images are allowed.');
            }

            // Validate file size (2MB max)
            if ($image->getSize() > 2048 * 1024) {
                throw new \Exception('Image size should not exceed 2MB.');
            }

            // Generate unique filename
            $filename = uniqid('product_') . '_' . time() . '.' . $image->getClientOriginalExtension();
            
            // Upload to Cloudinary with additional security options
            $result = Cloudinary::upload($image->getRealPath(), [
                'public_id' => 'products/' . $filename,
                'resource_type' => 'image',
                'eager' => [
                    ['width' => 300, 'height' => 300, 'crop' => 'fill'],
                    ['width' => 600, 'height' => 600, 'crop' => 'fill']
                ],
                'eager_async' => true,
                'eager_notification_url' => config('app.url') . '/api/cloudinary/notification',
                'overwrite' => true,
                'invalidate' => true
            ]);

            $uploadedImages[] = $result['secure_url'];
        }

        // If updating, delete old images from Cloudinary
        if ($product && $product->images) {
            foreach ($product->images as $oldImage) {
                $publicId = $this->getCloudinaryPublicId($oldImage);
                if ($publicId) {
                    Cloudinary::destroy($publicId);
                }
            }
        }

        return $uploadedImages;
    }

    private function getCloudinaryPublicId($url)
    {
        $pattern = '/\/v\d+\/([^\/]+)\./';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
} 