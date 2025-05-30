<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function createOrderStatusNotification($user, $order, $status)
    {
        return Notification::create([
            'user_id' => $user->id,
            'type' => 'order_status',
            'title' => 'Order Status Updated',
            'message' => "Your order #{$order->id} status has been updated to {$status}",
            'link' => route('orders.show', $order->id)
        ]);
    }

    public function createNewProductNotification($product)
    {
        $users = User::where('role', 'user')->get();
        
        $productLink = route('product.show', $product->id);
        Log::info('Generated product notification link: ' . $productLink);

        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'type' => 'new_product',
                'title' => 'New Product Available',
                'message' => "New product {$product->name} is now available!",
                'link' => $productLink
            ]);
        }
    }

    public function createDiscountNotification($product)
    {
        $users = User::where('role', 'user')->get();
        
        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'type' => 'discount',
                'title' => 'Product Discount',
                'message' => "{$product->name} is now on sale!",
                'link' => route('product.show', $product->id)
            ]);
        }
    }

    public function createAdminCheckoutNotification($order)
    {
        $admins = User::where('role', 'admin')->get();
        
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'admin_notification',
                'title' => 'New Order Received',
                'message' => "New order #{$order->id} has been placed by {$order->user->name}",
                'link' => route('admin.orders.show', $order->id)
            ]);
        }
    }
} 