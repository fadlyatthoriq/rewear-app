<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $items = $cart->items()->with('product')->get();
        $total = $items->sum(function($item) {
            return $item->price * $item->quantity;
        });

        return view('cart', [
            'cart' => $items,
            'total' => $total
        ]);
    }

    public function add(Product $product)
    {
        try {
            $user = Auth::user();
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);
            $item = $cart->items()->where('product_id', $product->id)->first();

            // Check if product has stock
            if ($product->stock <= 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Sorry, this product is out of stock!'
                ]);
            }

            if ($item) {
                // Check if adding one more would exceed stock
                if ($item->quantity >= $product->stock) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Sorry, you cannot add more of this item. Stock limit reached!'
                    ]);
                }
                $item->quantity++;
                $item->save();
            } else {
                $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price
                ]);
            }

            // Get updated cart count
            $cartCount = $cart->items()->sum('quantity');

            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart successfully!',
                'cartCount' => $cartCount
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while adding the product to cart.'
            ], 500);
        }
    }

    public function update(Request $request, Product $product)
    {
        try {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->first();
            
            if (!$cart) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cart not found'
                ], 404);
            }

            $item = $cart->items()->where('product_id', $product->id)->first();
            
            if (!$item) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Item not found in cart'
                ], 404);
            }

            // Check if product is still available
            if ($product->stock <= 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Sorry, this product is out of stock!'
                ]);
            }

            $action = $request->input('action');
            $currentQuantity = $request->input('quantity');

            if ($action === 'increase') {
                // Check if adding one more would exceed stock
                if ($currentQuantity >= $product->stock) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Cannot add more items. Only ' . $product->stock . ' items left in stock!'
                    ]);
                }
                $item->quantity = $currentQuantity + 1;
                $item->save();
            } else if ($action === 'decrease') {
                if ($currentQuantity > 1) {
                    $item->quantity = $currentQuantity - 1;
                    $item->save();
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Quantity cannot be less than 1'
                    ]);
                }
            }

            // Get updated cart count
            $cartCount = $cart->items()->sum('quantity');

            return response()->json([
                'status' => 'success',
                'message' => 'Cart updated successfully',
                'cartCount' => $cartCount,
                'newQuantity' => $item->quantity,
                'stock' => $product->stock
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while updating the cart'
            ], 500);
        }
    }

    public function remove(Product $product)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        
        if ($cart) {
            $cart->items()->where('product_id', $product->id)->delete();
        }

        return redirect()->route('cart.index');
    }

    public function clear()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        if ($cart) {
            $cart->items()->delete();
        }
        Alert::success('Success', 'Cart cleared successfully!');
        return redirect()->back();
    }
} 