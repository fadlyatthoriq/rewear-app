<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        \Log::info('Creating transaction', [
            'request_data' => $request->all(),
            'user_id' => Auth::id()
        ]);

        // Validate request
        $request->validate([
            'total' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'delivery_method' => 'required|string'
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        
        if (!$cart) {
            \Log::error('Cart not found', ['user_id' => $user->id]);
            return response()->json([
                'status' => 'error',
                'message' => 'Cart not found'
            ], 404);
        }

        try {
            DB::beginTransaction();

            \Log::info('Creating transaction record', [
                'user_id' => $user->id,
                'total' => $request->total,
                'payment_method' => $request->payment_method,
                'delivery_method' => $request->delivery_method
            ]);

            // Create transaction
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'total_price' => $request->total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'delivery_method' => $request->delivery_method
            ]);

            \Log::info('Transaction created', ['transaction_id' => $transaction->id]);

            // Create transaction items
            foreach ($cart->items as $item) {
                \Log::info('Creating transaction item', [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);

                $transaction->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);
            }

            // Clear cart
            $cart->items()->delete();
            $cart->delete();

            // Clear checkout session
            session()->forget('checkout');

            DB::commit();

            \Log::info('Transaction completed successfully', ['transaction_id' => $transaction->id]);

            return response()->json([
                'status' => 'success',
                'transaction_id' => $transaction->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Transaction creation failed', [
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
} 