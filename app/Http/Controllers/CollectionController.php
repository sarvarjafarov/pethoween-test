<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function men()
    {
        $products = Product::with('category')
            ->whereHas('category', function($query) {
                $query->where('name', 'like', '%men%')
                      ->orWhere('name', 'like', '%male%')
                      ->orWhere('name', 'like', '%gentleman%');
            })
            ->published()
            ->paginate(12);
        
        return view('frontend.collection.men', compact('products'));
    }

    public function women()
    {
        $products = Product::with('category')
            ->whereHas('category', function($query) {
                $query->where('name', 'like', '%women%')
                      ->orWhere('name', 'like', '%female%')
                      ->orWhere('name', 'like', '%lady%');
            })
            ->published()
            ->paginate(12);
        
        return view('frontend.collection.women', compact('products'));
    }

    public function children()
    {
        $products = Product::with('category')
            ->whereHas('category', function($query) {
                $query->where('name', 'like', '%children%')
                      ->orWhere('name', 'like', '%kids%')
                      ->orWhere('name', 'like', '%child%');
            })
            ->published()
            ->paginate(12);
        
        return view('frontend.collection.children', compact('products'));
    }
}
