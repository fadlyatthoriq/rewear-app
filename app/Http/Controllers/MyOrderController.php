<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

class MyOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['items.product'])
            ->where('user_id', auth()->id());

        // Filter by status if provided
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by date range if provided
        if ($request->has('duration')) {
            $query->when($request->duration === 'this week', function ($q) {
                return $q->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            })
            ->when($request->duration === 'this month', function ($q) {
                return $q->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
            })
            ->when($request->duration === 'last 3 months', function ($q) {
                return $q->whereBetween('created_at', [now()->subMonths(3), now()]);
            })
            ->when($request->duration === 'last 6 months', function ($q) {
                return $q->whereBetween('created_at', [now()->subMonths(6), now()]);
            })
            ->when($request->duration === 'this year', function ($q) {
                return $q->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()]);
            });
        }

        // Handle sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        $allowedSortFields = [
            'created_at' => 'Date',
            'total_amount' => 'Price',
            'status' => 'Status'
        ];

        if (!array_key_exists($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }

        $query->orderBy($sortField, $sortDirection);

        $transactions = $query->paginate(10);
        $transactions->appends($request->query());

        return view('my-orders', compact('transactions', 'sortField', 'sortDirection', 'allowedSortFields'));
    }

    public function show(Transaction $transaction)
    {
        // Ensure the transaction belongs to the authenticated user
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $transaction->load(['items.product']);

        return view('order-details', compact('transaction'));
    }

    public function cancel(Transaction $transaction)
    {
        // Ensure the transaction belongs to the authenticated user
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        // Only allow cancellation if the transaction is pending
        if ($transaction->status !== 'pending') {
            return back()->with('error', 'This order cannot be cancelled.');
        }

        $transaction->update([
            'status' => 'cancelled',
            'payment_status' => 'cancelled'
        ]);

        return back()->with('success', 'Order cancelled successfully.');
    }

    public function reorder(Transaction $transaction)
    {
        // Ensure the transaction belongs to the authenticated user
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        // Get or create the user's cart
        $cart = auth()->user()->cart()->firstOrCreate([]);

        // Add items from the old transaction to the cart
        $notAddedItems = [];
        foreach ($transaction->items as $item) {
            // Get the product to check stock
            $product = $item->product;

            if (!$product || $product->stock <= 0) {
                // Skip if product does not exist or is out of stock
                $notAddedItems[] = $item->product->name ?? 'Unknown Product';
                continue;
            }

            // Determine the quantity to add (cannot exceed available stock)
            $quantityToAdd = min($item->quantity, $product->stock);

            // Find or create the cart item for the product
            $cartItem = $cart->items()->where('product_id', $item->product_id)->first();

            if ($cartItem) {
                // If item exists, calculate new quantity considering stock
                $newQuantity = $cartItem->quantity + $quantityToAdd;
                $cartItem->quantity = min($newQuantity, $product->stock); // Ensure not more than stock
                $cartItem->save();

                if ($newQuantity > $product->stock) {
                     $notAddedItems[] = $product->name . ' (limited to ' . $product->stock . ' due to stock)';
                }

            } else {
                // If item does not exist, create a new cart item considering stock
                 if ($quantityToAdd > 0) {
                    $cart->items()->create([
                        'product_id' => $item->product_id,
                        'quantity' => $quantityToAdd,
                        'price' => $item->price, // Assuming price is stored on transaction items
                    ]);
                 } else {
                     $notAddedItems[] = $product->name . ' (out of stock)';
                 }
            }
        }

        // Recalculate cart totals (optional, but good practice)
        $cart->load('items'); // Reload items to include newly added ones
        $cart->total = $cart->items->sum(function($cartItem) {
            return $cartItem->price * $cartItem->quantity;
        });
        // Assuming tax and savings might be calculated based on total, update them here if necessary
        // $cart->tax = ...;
        // $cart->savings = ...;
        $cart->save();

        $message = 'Items added to cart successfully.';
        if (!empty($notAddedItems)) {
            $message .= ' Some items could not be added in full quantity or were out of stock: ' . implode(', ', $notAddedItems);
        }

        return redirect()->route('cart.index')->with('success', $message);
    }

    public function complete(Transaction $transaction)
    {
        // Ensure the transaction belongs to the authenticated user
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        // Only allow completion if the transaction is shipped
        if ($transaction->status !== 'shipped') {
            return back()->with('error', 'This order cannot be completed.');
        }

        $transaction->update([
            'status' => 'completed'
        ]);

        return back()->with('success', 'Order marked as completed successfully.');
    }
} 