<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function create(Request $request)
    {
        try {
            Log::info('Starting transaction creation', [
                'request_data' => $request->all(),
                'user_id' => Auth::id()
            ]);

            $request->validate([
                'total' => 'required|numeric',
                'payment_method' => 'required|string',
                'delivery_method' => 'required|string',
            ]);

            DB::beginTransaction();

            $user = Auth::user();
            Log::info('User found', ['user_id' => $user->id]);

            $cart = Cart::where('user_id', $user->id)->first();
            Log::info('Cart found', ['cart' => $cart ? $cart->toArray() : null]);
            
            if (!$cart) {
                throw new \Exception('Cart not found');
            }

            // Create transaction
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'total_price' => $request->total,
                'payment_method' => $request->payment_method,
                'delivery_method' => $request->delivery_method,
                'status' => 'pending',
            ]);
            Log::info('Transaction created', ['transaction' => $transaction->toArray()]);

            // Get cart items with product relationship
            $cartItems = CartItem::with('product')->where('cart_id', $cart->id)->get();
            Log::info('Cart items found', ['cart_items' => $cartItems->toArray()]);

            // Create transaction items
            foreach ($cartItems as $item) {
                $transactionItem = TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
                Log::info('Transaction item created', ['transaction_item' => $transactionItem->toArray()]);
            }

            // Clear cart
            CartItem::where('cart_id', $cart->id)->delete();
            $cart->delete();
            Log::info('Cart cleared');

            DB::commit();

            return response()->json([
                'status' => 'success',
                'transaction_id' => $transaction->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaction creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,paid,failed,cancelled',
            'payment_status' => 'required|in:pending,processing,paid,failed,cancelled',
            'shipping_status' => 'required|in:pending,processing,shipped,delivered,failed'
        ]);

        $transaction->update($validated);

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaction status updated successfully');
    }

    public function edit(Transaction $transaction)
    {
        return response()->json([
            'id' => $transaction->id,
            'status' => $transaction->status,
            'payment_status' => $transaction->payment_status,
            'shipping_status' => $transaction->shipping_status
        ]);
    }
} 