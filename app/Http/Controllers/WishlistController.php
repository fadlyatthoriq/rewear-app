<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function add(Product $product)
    {
        $wishlist = session()->get('wishlist', []);

        if (!isset($wishlist[$product->id])) {
            $wishlist[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image_url
            ];
            session()->put('wishlist', $wishlist);
            return redirect()->back()->with('success', 'Product added to wishlist successfully!');
        }

        return redirect()->back()->with('info', 'Product is already in your wishlist!');
    }

    public function remove(Product $product)
    {
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$product->id])) {
            unset($wishlist[$product->id]);
            session()->put('wishlist', $wishlist);
        }

        return redirect()->back()->with('success', 'Product removed from wishlist successfully!');
    }
} 