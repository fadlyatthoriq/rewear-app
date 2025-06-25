<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class TransactionItemController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    // List all transaction items for the seller
    public function index()
    {
        $orderItems = TransactionItem::with(['transaction.user', 'product'])
            ->whereHas('product', function($q) {
                $q->where('user_id', Auth::id());
            })
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('seller.order-items.index', compact('orderItems'));
    }

    // Show edit form for a transaction item
    public function edit($id)
    {
        $item = TransactionItem::with(['transaction.user', 'product'])
            ->where('id', $id)
            ->whereHas('product', function($q) {
                $q->where('user_id', Auth::id());
            })
            ->firstOrFail();

        return view('seller.order-items.edit', compact('item'));
    }

    // Update shipping status and tracking number for a transaction item
    public function update(Request $request, $id)
    {
        $item = TransactionItem::where('id', $id)
            ->whereHas('product', function($q) {
                $q->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $request->validate([
            'shipping_status' => 'required|in:pending,processing,shipped,delivered',
            'tracking_number' => 'nullable|string|max:255'
        ]);

        if ($request->shipping_status === 'shipped' && !$request->tracking_number) {
            return back()->withErrors(['tracking_number' => 'Tracking number wajib diisi jika status shipped']);
        }

        $item->shipping_status = $request->shipping_status;
        $item->tracking_number = $request->shipping_status === 'shipped' ? $request->tracking_number : null;
        $item->save();

        // Notifikasi ke user (optional)
        // $this->notificationService->createShippingNotificationPerItem($item);

        return redirect()->route('seller.order-items.index')->with('success', 'Status updated!');
    }
}
