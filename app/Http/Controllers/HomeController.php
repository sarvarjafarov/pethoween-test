<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::published()
            ->featured()
            ->with(['category'])
            ->latest()
            ->limit(6)
            ->get();

        $recentProducts = Product::published()
            ->with(['category'])
            ->latest()
            ->limit(6)
            ->get();

        $categories = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->limit(6)
            ->get();

        return view('frontend.home', compact('featuredProducts', 'recentProducts', 'categories'));
    }
}
