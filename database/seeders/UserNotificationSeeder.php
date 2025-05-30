<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Notification;
use App\Models\Product;

class UserNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find all users with the role 'user'
        $users = User::where('role', 'user')->get();

        if ($users->isEmpty()) {
            \Illuminate\Support\Facades\Log::info('No users with role "user" found. Skipping UserNotificationSeeder.');
            return;
        }

        // Get some sample products (adjust the number as needed)
        $products = Product::inRandomOrder()->limit(5)->get();

        if ($products->isEmpty()) {
             \Illuminate\Support\Facades\Log::info('No products found. Cannot create specific product links in UserNotificationSeeder.');
             // Fallback to generic links or skip creating product-related notifications if no products
             // For now, we'll log and proceed without specific links, or you could add a fallback.
        }

        // Create sample notifications for each user
        foreach ($users as $user) {
            // Create New Product notification linking to a random product
            if ($products->isNotEmpty()) {
                $randomProduct = $products->random();
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'new_product',
                    'title' => 'New Product Available!',
                    'message' => 'Check out our latest additions like ' . $randomProduct->name . '.',
                    'link' => route('product.show', $randomProduct->id),
                    'is_read' => false,
                ]);

                // Create Discount notification linking to another random product (or the same)
                $randomProductForDiscount = $products->random();
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'discount',
                    'title' => 'Special Discount for You',
                    'message' => 'Enjoy a special discount on items like ' . $randomProductForDiscount->name . '.',
                    'link' => route('product.show', $randomProductForDiscount->id),
                    'is_read' => (bool)random_int(0, 1),
                ]);
            } else {
                 // Fallback if no products are available
                 Notification::create([
                    'user_id' => $user->id,
                    'type' => 'info',
                    'title' => 'Site Update',
                    'message' => 'Check out the latest updates on our shop.',
                    'link' => route('shop'),
                    'is_read' => false,
                ]);
            }

            // Add more notification types as needed, potentially without product links
            Notification::create([
                 'user_id' => $user->id,
                 'type' => 'general',
                 'title' => 'Welcome Message',
                 'message' => 'Welcome to Rewear! Explore our collections.',
                 'link' => route('shop'),
                 'is_read' => false,
             ]);
        }

        \Illuminate\Support\Facades\Log::info('UserNotificationSeeder finished. Created notifications for ' . $users->count() . ' users.');
    }
} 