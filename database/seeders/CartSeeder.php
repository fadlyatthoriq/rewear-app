<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        // Get admin user
        $admin = User::where('email', 'admin@rewear.com')->first();
        
        if (!$admin) {
            $this->command->error('Admin user not found!');
            return;
        }

        // Get some sample products
        $products = Product::take(3)->get();
        
        if ($products->isEmpty()) {
            $this->command->error('No products found!');
            return;
        }

        // Create cart items
        $cart = [];
        
        foreach ($products as $product) {
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => rand(1, 3),
                'price' => $product->price,
                'image' => $product->image_url
            ];
        }

        // Store cart in session
        Session::put('cart', $cart);
        
        $this->command->info('Cart seeded successfully for admin user!');
    }
} 