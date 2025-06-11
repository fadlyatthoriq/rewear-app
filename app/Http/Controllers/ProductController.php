<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Cloudinary;
use App\Services\NotificationService;

class ProductController extends Controller
{
    protected $cloudinary;
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->middleware('auth')->except(['show']);
        $this->middleware('seller')->except(['show', 'index']);
        $this->cloudinary = app('cloudinary');
        $this->notificationService = $notificationService;
    }

    public function show(Product $product)
    {
        // If product is not active, show 404
        if ($product->status !== 'active') {
            abort(404);
        }

        return view('product', [
            'product' => $product->load('seller', 'category'),
            'relatedProducts' => Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->where('status', 'active')
                ->take(4)
                ->get()
        ]);
    }

    public function index()
    {
        $products = Product::where('user_id', auth()->id())
            ->with('category')
            ->latest()
            ->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'condition' => 'required|in:new,like_new,good,fair',
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

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imageUrl,
            'condition' => $request->condition,
            'user_id' => Auth::id(),
            'status' => 'active',
        ]);

        // Create notification for new product
        $this->notificationService->createNewProductNotification($product);

        return redirect()->route('product.show', $product)
            ->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        
        return view('products.edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'condition' => 'required|in:new,like_new,good,fair',
            'status' => 'required|in:active,inactive,sold',
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

        // If status is changing to inactive or sold, remove from cart
        if ($request->status !== $product->status && in_array($request->status, ['inactive', 'sold'])) {
            $product->cartItems()->delete();
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imageUrl,
            'condition' => $request->condition,
            'status' => $request->status,
        ]);

        // Create notification if price is reduced (discount)
        if ($request->price < $product->getOriginal('price')) {
            $this->notificationService->createDiscountNotification($product);
        }

        return redirect()->route('seller.dashboard')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        
        // Delete image from Cloudinary if exists
        if ($product->image) {
            $publicId = $this->getPublicIdFromUrl($product->image);
            if ($publicId) {
                $this->cloudinary->uploadApi()->destroy($publicId);
            }
        }

        $product->delete();

        return redirect()->route('seller.dashboard')
            ->with('success', 'Product deleted successfully!');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
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
            
            return response()->json([
                'success' => true,
                'url' => $result['secure_url']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getPublicIdFromUrl($url)
    {
        // Extract public_id from Cloudinary URL
        // Example URL: https://res.cloudinary.com/your-cloud-name/image/upload/v1234567890/products/image.jpg
        $pattern = '/\/v\d+\/([^\/]+)\./';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
} 