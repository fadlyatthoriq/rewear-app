<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $wishlistItems = Auth::user()->wishlist()->with('product')->get();
        return view('wishlist', compact('wishlistItems'));
    }

    public function add(Product $product)
    {
        $user = Auth::user();
        
        // Check if product is already in wishlist
        $exists = $user->wishlist()->where('product_id', $product->id)->exists();
        
        if (!$exists) {
            $user->wishlist()->create([
                'product_id' => $product->id
            ]);
            
            $message = 'Product added to wishlist successfully!';
        } else {
            $message = 'Product is already in your wishlist!';
        }

        if (request()->ajax()) {
            return response()->json([
                'message' => $message,
                'wishlistCount' => $user->wishlist()->count()
            ]);
        }
        
        return redirect()->back()->with('success', $message);
    }

    public function remove(Product $product)
    {
        $user = Auth::user();
        $user->wishlist()->where('product_id', $product->id)->delete();

        if (request()->ajax()) {
            return response()->json([
                'message' => 'Product removed from wishlist successfully!',
                'wishlistCount' => $user->wishlist()->count()
            ]);
        }

        return redirect()->back()->with('success', 'Product removed from wishlist successfully!');
    }
} 