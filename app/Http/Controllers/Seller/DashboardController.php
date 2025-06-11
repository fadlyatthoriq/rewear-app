<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get seller's products
        $products = Product::where('user_id', $user->id)->latest()->take(5)->get();
        
        // Get seller's recent transactions
        $transactions = Transaction::whereHas('items', function($query) use ($user) {
            $query->whereHas('product', function($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })->latest()->take(5)->get();
        
        // Get seller's statistics
        $stats = [
            'total_products' => Product::where('user_id', $user->id)->count(),
            'total_sales' => Transaction::whereHas('items', function($query) use ($user) {
                $query->whereHas('product', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            })->where('status', 'success')->sum('total_amount'),
            'total_orders' => Transaction::whereHas('items', function($query) use ($user) {
                $query->whereHas('product', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            })->count(),
            'pending_orders' => Transaction::whereHas('items', function($query) use ($user) {
                $query->whereHas('product', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            })->where('status', 'pending')->count(),
        ];

        return view('dashboard-seller', compact('products', 'transactions', 'stats'));
    }
} 