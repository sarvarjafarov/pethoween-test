@extends('layouts.frontend')

@section('title', 'Children\'s Collection')
@section('description', 'Discover our premium children\'s fashion collection')

@section('content')
<x-page-header 
    title="Children's Collection" 
    subtitle="Discover our premium children's fashion collection"
    background="bg-gradient-to-br from-green-50 to-green-100"
/>

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
                        <span class="text-gray-600">Showing {{ $products->count() }} children's products</span>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Children's Products Found</h3>
                            <p class="text-gray-600 mb-6">We're working on adding amazing children's products to our collection.</p>
                            <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition duration-300">
                                Browse All Products
                            </a>
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
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Stay Updated with Children's Fashion</h2>
        <p class="text-lg text-gray-600 mb-8">Subscribe to our newsletter for the latest children's fashion trends and exclusive offers</p>
        <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
            <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900">
            <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition duration-300">
                Subscribe
            </button>
        </form>
    </div>
</section>
@endsection
