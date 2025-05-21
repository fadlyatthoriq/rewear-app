<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Cart;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        
        if (!$cart) {
            return redirect()->route('cart.index');
        }

        $items = $cart->items()->with('product')->get();
        $subtotal = $items->sum(function($item) {
            return $item->price * $item->quantity;
        });
        
        $tax = $subtotal * 0.1; // 10% tax
        $total = $subtotal + $tax;

        return view('checkout', [
            'items' => $items,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total
        ]);
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'delivery_method' => 'required|string'
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        
        if (!$cart) {
            return redirect()->route('cart.index');
        }

        $items = $cart->items()->with('product')->get();
        $subtotal = $items->sum(function($item) {
            return $item->price * $item->quantity;
        });
        
        $tax = $subtotal * 0.1; // 10% tax
        $total = $subtotal + $tax;

        // Store checkout data in session
        session([
            'checkout' => [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'payment_method' => $request->payment_method,
                'delivery_method' => $request->delivery_method
            ]
        ]);

        return view('order-summary', [
            'items' => $items,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'checkout' => session('checkout')
        ]);
    }

    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        
        if (!$cart) {
            return redirect()->route('cart.index');
        }

        $items = $cart->items()->with('product')->get();
        $subtotal = $items->sum(function($item) {
            return $item->price * $item->quantity;
        });
        
        $tax = $subtotal * 0.1; // 10% tax
        $total = $subtotal + $tax;

        // Get checkout data from session
        $checkout = session('checkout');
        if (!$checkout) {
            return redirect()->route('checkout');
        }

        return view('order-summary', [
            'items' => $items,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'checkout' => $checkout
        ]);
    }

    public function createTransaction(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'total' => 'required|numeric|min:0',
                'payment_method' => 'required|string',
                'delivery_method' => 'required|string'
            ]);

            // Get checkout data from session
            $checkout = session('checkout');
            if (!$checkout) {
                return back()->with('error', 'Checkout data not found. Please try again.');
            }

            // Get cart
            $cart = Cart::where('user_id', auth()->id())->first();
            if (!$cart || $cart->items->isEmpty()) {
                return back()->with('error', 'Your cart is empty.');
            }

            DB::beginTransaction();

            try {
                // Create transaction
                $transaction = Transaction::create([
                    'user_id' => auth()->id(),
                    'total_amount' => $request->total,
                    'status' => 'pending',
                    'payment_method' => $request->payment_method,
                    'delivery_method' => $request->delivery_method,
                    'customer_name' => $checkout['name'],
                    'customer_email' => $checkout['email'],
                    'customer_phone' => $checkout['phone'],
                    'customer_address' => $checkout['address']
                ]);

                if (!$transaction) {
                    throw new \Exception('Failed to create transaction');
                }

                // Create transaction items from cart
                foreach ($cart->items as $item) {
                    $transactionItem = TransactionItem::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price
                    ]);

                    if (!$transactionItem) {
                        throw new \Exception('Failed to create transaction item');
                    }
                }

                // Create payment with Midtrans
                $midtransService = new MidtransService();
                $payment = $midtransService->createTransaction($transaction);

                // Check if Midtrans transaction creation was successful
                if (!isset($payment['status']) || $payment['status'] !== 'success') {
                    // Log the payment response for debugging
                    Log::error('Midtrans transaction creation failed. Payment response:', $payment);
                    throw new \Exception('Failed to create payment with Midtrans: ' . ($payment['message'] ?? 'Unknown error'));
                }

                // Update transaction with Midtrans data
                $transaction->update([
                    'midtrans_order_id' => $payment['order_id'],
                    'midtrans_payment_token' => $payment['snap_token'],
                    'payment_expiry' => now()->addHours(24)
                ]);

                // Clear cart after successful transaction
                $cart->items()->delete();

                // Clear checkout session
                session()->forget('checkout');

                DB::commit();

                // Redirect to Midtrans payment page
                return redirect($payment['redirect_url']);

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            Log::error('Transaction creation failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to create transaction: ' . $e->getMessage());
        }
    }
} 