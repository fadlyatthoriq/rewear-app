<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Filter by category
        if ($request->has('category') && $request->category !== '') {
            $query->where('category_id', $request->category);
        }

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        
        switch ($sort) {
            case 'price':
                $query->orderBy('price', $direction);
                break;
            case 'name':
                $query->orderBy('name', $direction);
                break;
            default:
                $query->latest();
        }

        $products = $query->paginate(8)->appends(request()->query());
        $categories = Category::all();

        return view('shop', compact('products', 'categories'));
    }
} 