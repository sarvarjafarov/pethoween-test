<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $sessionId = Session::getId();
        $userId = auth()->id();
        
        $cartItems = Cart::with('product')
            ->where(function($query) use ($sessionId, $userId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->get();
        
        $subtotal = $cartItems->sum('total');
        $tax = $subtotal * 0.1; // 10% tax
        $shipping = $subtotal > 50 ? 0 : 10; // Free shipping over $50
        $total = $subtotal + $tax + $shipping;
        
        return view('frontend.cart', compact('cartItems', 'subtotal', 'tax', 'shipping', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock_quantity,
        ]);

        $sessionId = Session::getId();
        $userId = auth()->id();
        
        // Check if product already in cart
        $existingCartItem = Cart::where('product_id', $product->id)
            ->where(function($query) use ($sessionId, $userId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->first();

        if ($existingCartItem) {
            $existingCartItem->quantity += $request->quantity;
            $existingCartItem->save();
        } else {
            Cart::create([
                'session_id' => $userId ? null : $sessionId,
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->current_price,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cart->product->stock_quantity,
        ]);

        $cart->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function remove(Cart $cart)
    {
        $cart->delete();
        
        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function clear()
    {
        $sessionId = Session::getId();
        $userId = auth()->id();
        
        Cart::where(function($query) use ($sessionId, $userId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->delete();
        
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
}
