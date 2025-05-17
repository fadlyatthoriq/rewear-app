<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('product', compact('product', 'relatedProducts'));
    }
} 