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
        // Format agar $cart di blade tetap associative array seperti sebelumnya
        $cartArray = [];
        foreach ($items as $item) {
            $cartArray[$item->product_id] = [
                'name' => $item->product->name,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'image' => $item->product->image_url
            ];
        }
        return view('cart', [
            'cart' => $cartArray,
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

    public function remove(Product $product)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        if ($cart) {
            $item = $cart->items()->where('product_id', $product->id)->first();
            if ($item) {
                $item->delete();
                Alert::success('Success', 'Product removed from cart successfully!');
                return redirect()->back();
            }
        }
        Alert::error('Error', 'Product not found in cart!');
        return redirect()->back();
    }

    public function update(Request $request, Product $product)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        if ($cart) {
            $item = $cart->items()->where('product_id', $product->id)->first();
            if ($item) {
                if ($request->has('action')) {
                    if ($request->action === 'increase') {
                        // Check if increasing would exceed stock
                        if ($item->quantity >= $product->stock) {
                            Alert::error('Error', 'Sorry, you cannot add more of this item. Stock limit reached!');
                            return redirect()->back();
                        }
                        $item->quantity++;
                    } else if ($request->action === 'decrease') {
                        $item->quantity--;
                        // If quantity reaches 0, delete the item
                        if ($item->quantity <= 0) {
                            $item->delete();
                            Alert::success('Success', 'Item removed from cart!');
                            return redirect()->back();
                        }
                    }
                } else {
                    $request->validate([
                        'quantity' => 'required|integer|min:0'
                    ]);
                    // If quantity is 0, delete the item
                    if ($request->quantity == 0) {
                        $item->delete();
                        Alert::success('Success', 'Item removed from cart!');
                        return redirect()->back();
                    }
                    // Check if requested quantity exceeds stock
                    if ($request->quantity > $product->stock) {
                        Alert::error('Error', 'Sorry, requested quantity exceeds available stock!');
                        return redirect()->back();
                    }
                    $item->quantity = $request->quantity;
                }
                $item->save();
                Alert::success('Success', 'Cart updated successfully!');
                return redirect()->back();
            }
        }
        Alert::error('Error', 'Product not found in cart!');
        return redirect()->back();
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