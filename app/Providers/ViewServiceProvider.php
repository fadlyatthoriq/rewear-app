<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Share categories with all views that use the master layout
        View::composer('layouts.master', function ($view) {
            $view->with('categories', Category::all());

            // Get cart count
            $cartCount = 0;
            $wishlistCount = 0;
            
            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->first();
                if ($cart) {
                    $cartCount = $cart->items()->sum('quantity');
                }
                $wishlistCount = Auth::user()->wishlist()->count();
            }

            $view->with([
                'cartCount' => $cartCount,
                'wishlistCount' => $wishlistCount
            ]);
        });
    }
} 