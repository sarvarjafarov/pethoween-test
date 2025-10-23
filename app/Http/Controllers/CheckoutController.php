<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
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
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        $subtotal = $cartItems->sum('total');
        $tax = $subtotal * 0.1; // 10% tax
        $shipping = $subtotal > 50 ? 0 : 10; // Free shipping over $50
        $total = $subtotal + $tax + $shipping;
        
        return view('frontend.checkout', compact('cartItems', 'subtotal', 'tax', 'shipping', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

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
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        $subtotal = $cartItems->sum('total');
        $tax = $subtotal * 0.1;
        $shipping = $subtotal > 50 ? 0 : 10;
        $total = $subtotal + $tax + $shipping;

        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'user_id' => $userId,
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => $total,
                'notes' => $request->notes,
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_name' => $cartItem->product->name,
                    'product_sku' => $cartItem->product->sku,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'total' => $cartItem->total,
                ]);
            }

            // Clear cart
            Cart::where(function($query) use ($sessionId, $userId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })->delete();

            DB::commit();

            return redirect()->route('checkout.success', $order)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function success(Order $order)
    {
        return view('frontend.checkout-success', compact('order'));
    }
}
