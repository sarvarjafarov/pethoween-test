@extends('layouts.frontend')

@section('title', 'Product Catalogs')
@section('description', 'Browse our complete product catalogs by category')

@section('content')
<x-page-header 
    title="Product Catalogs" 
    subtitle="Browse our complete product catalogs by category"
    background="bg-gradient-to-br from-purple-50 to-purple-100"
/>

<!-- Categories Grid -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Shop by Category</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Explore our products organized by category</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($categories as $category)
                <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-white font-bold text-2xl shadow-lg" style="background-color: {{ $category->color }}">
                                {{ $category->name[0] }}
                            </div>
                            <div class="ml-6">
                                <h3 class="text-2xl font-bold text-gray-900">{{ $category->name }}</h3>
                                <p class="text-gray-600 font-medium">{{ $category->products->count() }} products</p>
                            </div>
                        </div>
                        @if($category->description)
                            <p class="text-gray-600 mb-6 text-lg leading-relaxed">{{ $category->description }}</p>
                        @endif
                        <a href="{{ route('shop') }}?category={{ $category->slug }}" class="inline-flex items-center px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition duration-300">
                            View Products
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Categories Found</h3>
                    <p class="text-gray-600 mb-6">We're working on organizing our products into categories.</p>
                    <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition duration-300">
                        Browse All Products
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Featured Products</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Discover our handpicked featured products</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @if(isset($featuredProducts) && $featuredProducts->count() > 0)
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            @else
                @for($i = 0; $i < 4; $i++)
                    <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="relative overflow-hidden">
                            <div class="w-full h-80 bg-gray-100 flex items-center justify-center">
                                <span class="text-gray-400 text-4xl font-bold">Product {{ $i + 1 }}</span>
                            </div>
                            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition duration-300">
                                <button class="p-3 bg-white rounded-full shadow-lg hover:bg-gray-50 transition duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Featured Product {{ $i + 1 }}</h3>
                            <p class="text-gray-600 mb-4">Product description here</p>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-gray-900">$99.99</span>
                                <span class="text-lg text-gray-500 line-through">$129.99</span>
                            </div>
                            <button class="w-full bg-gray-900 text-white py-3 rounded-lg font-semibold hover:bg-gray-800 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Stay Updated</h2>
        <p class="text-lg text-gray-600 mb-8">Subscribe to our newsletter for the latest product updates and exclusive offers</p>
        <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
            <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900">
            <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition duration-300">
                Subscribe
            </button>
        </form>
    </div>
</section>
@endsection
