<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        // Get some users
        $users = User::where('role', 'user')->take(5)->get();
        $admins = User::where('role', 'admin')->take(2)->get();
        
        // Get some products
        $products = Product::take(3)->get();
        
        // Get some transactions
        $transactions = Transaction::take(3)->get();

        // Create order status notifications
        foreach ($users as $user) {
            foreach ($transactions as $transaction) {
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'order_status',
                    'title' => 'Order Status Updated',
                    'message' => "Your order #{$transaction->id} status has been updated to processing",
                    'link' => route('my-orders.show', $transaction->id),
                    'is_read' => false,
                    'created_at' => now()->subHours(rand(1, 24))
                ]);
            }
        }

        // Create new product notifications
        foreach ($products as $product) {
            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'new_product',
                    'title' => 'New Product Available',
                    'message' => "New product {$product->name} is now available!",
                    'link' => route('product.show', $product->id),
                    'is_read' => false,
                    'created_at' => now()->subHours(rand(1, 48))
                ]);
            }
        }

        // Create discount notifications
        foreach ($products as $product) {
            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'discount',
                    'title' => 'Product Discount',
                    'message' => "{$product->name} is now on sale!",
                    'link' => route('product.show', $product->id),
                    'is_read' => false,
                    'created_at' => now()->subHours(rand(1, 72))
                ]);
            }
        }

        // Create admin notifications for new orders
        foreach ($transactions as $transaction) {
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'admin_notification',
                    'title' => 'New Order Received',
                    'message' => "New order #{$transaction->id} has been placed by {$transaction->user->name}",
                    'link' => route('admin.transactions.show', $transaction->id),
                    'is_read' => false,
                    'created_at' => now()->subHours(rand(1, 24))
                ]);
            }
        }

        // Create some read notifications
        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'type' => 'order_status',
                'title' => 'Order Delivered',
                'message' => "Your order has been delivered successfully!",
                'link' => route('my-orders.show', rand(1, 10)),
                'is_read' => true,
                'created_at' => now()->subDays(rand(1, 7))
            ]);
        }
    }
} 