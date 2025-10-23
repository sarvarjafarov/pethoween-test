<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')
            ->whereHas('products')
            ->orderBy('name')
            ->get();
        
        $featuredProducts = Product::published()
            ->featured()
            ->take(8)
            ->get();
        
        return view('frontend.catalogs.index', compact('categories', 'featuredProducts'));
    }
}
