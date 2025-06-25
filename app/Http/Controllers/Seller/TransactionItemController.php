<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\NotificationService;

class TransactionItemController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function updateStatus(Request $request, TransactionItem $item)
    {
        $user = auth()->user();
        if ($item->product->user_id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'shipping_status' => 'required|in:pending,processing,shipped,delivered,failed',
            'tracking_number' => 'nullable|string|max:255',
        ]);

        if ($request->shipping_status === 'shipped' && !$request->tracking_number) {
            return back()->with('error', 'Tracking number is required when shipping.');
        }

        $item->update([
            'shipping_status' => $request->shipping_status,
            'tracking_number' => $request->tracking_number,
        ]);

        // Notifikasi ke user (optional: bisa custom message per produk)
        if ($request->shipping_status === 'shipped') {
            $this->notificationService->createShippingNotificationPerItem($item);
        }

        Alert::success('Success', 'Product status updated!');
        return back();
    }
}
