@extends('layouts.frontend')

@section('title', 'Shop')
@section('description', 'Browse our complete collection of premium fashion items')

@section('content')
<x-page-header 
    title="Shop Collection" 
    subtitle="Discover our complete range of premium fashion items"
    background="bg-gradient-to-br from-gray-50 to-gray-100"
/>

<!-- Advanced Search and Filters -->
<section class="py-8 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Search Bar -->
            <div class="flex-1">
                <div class="relative">
                    <input type="text" placeholder="Search products..." class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent bg-gray-50">
                    <button class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Quick Filters -->
            <div class="flex items-center space-x-4">
                <select class="px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 bg-gray-50">
                    <option>All Categories</option>
                    <option>Men</option>
                    <option>Women</option>
                    <option>Children</option>
                </select>
                <select class="px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 bg-gray-50">
                    <option>Sort by</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Newest</option>
                    <option>Most Popular</option>
                </select>
                <button class="px-4 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 transition duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Products Grid -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <div class="lg:w-1/4">
                <x-filter-sidebar :categories="$categories ?? []" :priceRange="[0, 1000]" />
            </div>
            
            <!-- Products Grid -->
            <div class="lg:w-3/4">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">Showing {{ $products->count() }} products</span>
                        <div class="flex space-x-2">
                            <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition duration-200" title="Grid View">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                            </button>
                            <button class="p-2 border border-gray-300 rounded-lg bg-gray-100" title="List View">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($products as $product)
                        <x-product-card :product="$product" />
                    @empty
                        <div class="col-span-full text-center py-16">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Products Found</h3>
                            <p class="text-gray-600 mb-6">We couldn't find any products matching your criteria.</p>
                            <button class="inline-flex items-center px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition duration-300">
                                Clear Filters
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
            <div class="mt-16 flex justify-center">
                <nav class="flex items-center space-x-2">
                    @if($products->onFirstPage())
                        <span class="px-4 py-2 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">Previous</a>
                    @endif
                    
                    @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if($page == $products->currentPage())
                            <span class="px-4 py-2 bg-gray-900 text-white rounded-lg">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">{{ $page }}</a>
                        @endif
                    @endforeach
                    
                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">Next</a>
                    @else
                        <span class="px-4 py-2 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">Next</span>
                    @endif
                </nav>
            </div>
        @endif
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Stay in Style</h2>
        <p class="text-lg text-gray-600 mb-8">Subscribe to our newsletter for the latest fashion trends and exclusive offers</p>
        <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
            <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900">
            <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition duration-300">
                Subscribe
            </button>
        </form>
    </div>
</section>
@endsection
