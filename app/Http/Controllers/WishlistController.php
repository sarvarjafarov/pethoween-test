<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where(function($query) {
            if (auth()->check()) {
                $query->where('user_id', auth()->id());
            } else {
                $query->where('session_id', session()->getId());
            }
        })->with('product')->get();

        return view('frontend.wishlist', compact('wishlistItems'));
    }

    public function add(Product $product)
    {
        $userId = auth()->check() ? auth()->id() : null;
        $sessionId = auth()->check() ? null : session()->getId();

        // Check if already in wishlist
        $existing = Wishlist::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->where('product_id', $product->id)->first();

        if (!$existing) {
            Wishlist::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'product_id' => $product->id,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Added to wishlist']);
    }

    public function remove(Product $product)
    {
        $userId = auth()->check() ? auth()->id() : null;
        $sessionId = auth()->check() ? null : session()->getId();

        Wishlist::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->where('product_id', $product->id)->delete();

        return response()->json(['success' => true, 'message' => 'Removed from wishlist']);
    }

    public function toggle(Product $product)
    {
        $userId = auth()->check() ? auth()->id() : null;
        $sessionId = auth()->check() ? null : session()->getId();

        $existing = Wishlist::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->where('product_id', $product->id)->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['success' => true, 'in_wishlist' => false, 'message' => 'Removed from wishlist']);
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'product_id' => $product->id,
            ]);
            return response()->json(['success' => true, 'in_wishlist' => true, 'message' => 'Added to wishlist']);
        }
    }

    public function clear()
    {
        $userId = auth()->check() ? auth()->id() : null;
        $sessionId = auth()->check() ? null : session()->getId();

        Wishlist::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->delete();

        return response()->json(['success' => true, 'message' => 'Wishlist cleared']);
    }
}