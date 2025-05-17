<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured products (new arrivals)
        $newArrivals = Product::latest()
            ->take(4)
            ->get();

        // Get trending products (most sold)
        $trendingProducts = Product::withCount('transactionItems')
            ->orderBy('transaction_items_count', 'desc')
            ->take(4)
            ->get();

        // Get all categories
        $categories = Category::all();

        return view('index', compact('newArrivals', 'trendingProducts', 'categories'));
    }
} 