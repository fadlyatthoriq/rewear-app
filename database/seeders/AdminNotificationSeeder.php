<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;

class AdminNotificationSeeder extends Seeder
{
    public function run(): void
    {
        // Get all admin users
        $admins = User::where('role', 'admin')->get();

        if ($admins->isEmpty()) {
            $this->command->info('No admin users found. Creating notifications skipped.');
            return;
        }

        // Get some sample transactions (adjust the number as needed)
        $transactions = Transaction::inRandomOrder()->limit(5)->get();

        if ($transactions->isEmpty()) {
             $this->command->info('No transactions found. Cannot create specific transaction links in AdminNotificationSeeder.');
             // Fallback to generic links or skip creating transaction-related notifications
             return; // Skip creating notifications if no transactions
        }

        // Sample notification data (using dynamic links)
        $notifications = [
            [
                'type' => 'admin_notification',
                'title' => 'New Order Received',
                'message' => 'New order has been placed.',
            ]
            // We will create notifications dynamically based on fetched transactions
        ];

        // Create notifications for each admin using fetched transactions
        foreach ($admins as $admin) {
            foreach ($transactions as $transaction) {
                Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'admin_notification',
                    'title' => 'New Order Received',
                    'message' => 'New order #' . $transaction->id . ' has been placed by ' . $transaction->user->name,
                    'link' => route('admin.transactions.show', $transaction->id),
                    'is_read' => false,
                    'created_at' => $transaction->created_at, // Use transaction creation time
                    'updated_at' => $transaction->created_at
                ]);
            }
        }

        $this->command->info('Admin notifications seeded successfully.');
    }
} 