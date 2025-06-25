<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use App\Services\NotificationService;

class TransactionController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        
        $query = Transaction::with(['user', 'items.product'])
            ->whereHas('items', function($query) use ($user) {
                $query->whereHas('product', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            });

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhere('shipping_status', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('shipping_status', $request->status);
        }

        // Sorting functionality
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        // Validate sort field to prevent SQL injection
        $allowedSortFields = ['id', 'status', 'shipping_status', 'total_amount', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }

        $query->orderBy($sortField, $sortDirection);

        $transactions = $query->paginate(10)->appends(request()->query());
        return view('seller.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $user = auth()->user();
        
        // Ensure the transaction contains products from this seller
        $hasSellerProducts = $transaction->items()->whereHas('product', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->exists();

        if (!$hasSellerProducts) {
            abort(403, 'You can only view transactions containing your products.');
        }

        $transaction->load(['user', 'items.product']);
        
        // Filter items to only show seller's products
        $sellerItems = $transaction->items()->whereHas('product', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('product')->get();

        return view('seller.transactions.show', compact('transaction', 'sellerItems'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $user = auth()->user();
        
        // Ensure the transaction contains products from this seller
        $hasSellerProducts = $transaction->items()->whereHas('product', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->exists();

        if (!$hasSellerProducts) {
            Alert::error('Error', 'You can only update transactions containing your products.');
            return redirect()->back();
        }

        Log::info('Seller updating transaction', [
            'transaction_id' => $transaction->id,
            'seller_id' => $user->id,
            'current_shipping_status' => $transaction->shipping_status,
            'request_data' => $request->all()
        ]);

        $validated = $request->validate([
            'shipping_status' => 'required|in:pending,processing,shipped,delivered,failed',
            'tracking_number' => 'nullable|string|max:255'
        ]);

        // If status is being changed to shipped, require tracking number
        if ($validated['shipping_status'] === 'shipped' && empty($validated['tracking_number'])) {
            Alert::error('Error', 'Tracking number is required when marking order as shipped');
            return redirect()->back();
        }

        $updateData = ['shipping_status' => $validated['shipping_status']];
        
        // Add tracking number if provided
        if (!empty($validated['tracking_number'])) {
            $updateData['tracking_number'] = $validated['tracking_number'];
        }

        $transaction->update($updateData);
        
        // Send shipping notification if status is changed to shipped
        if ($validated['shipping_status'] === 'shipped' && !empty($validated['tracking_number'])) {
            $this->notificationService->createShippingNotification($transaction);
        }
        
        Log::info('Seller transaction status updated', [
            'transaction_id' => $transaction->id,
            'seller_id' => $user->id,
            'old_shipping_status' => $transaction->getOriginal('shipping_status'),
            'new_shipping_status' => $validated['shipping_status'],
            'tracking_number' => $validated['tracking_number'] ?? null
        ]);

        Alert::success('Success', 'Transaction status updated successfully');
        return redirect()->route('seller.transactions.index');
    }

    public function edit(Transaction $transaction)
    {
        $user = auth()->user();
        
        // Ensure the transaction contains products from this seller
        $hasSellerProducts = $transaction->items()->whereHas('product', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->exists();

        if (!$hasSellerProducts) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json([
            'id' => $transaction->id,
            'shipping_status' => $transaction->shipping_status,
            'tracking_number' => $transaction->tracking_number
        ]);
    }
}
