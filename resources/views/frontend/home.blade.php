@extends('layouts.frontend')

@section('title', 'Welcome')
@section('description', 'Dealers - Your Premium Fashion Destination')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <div class="space-y-4">
                    <h1 class="text-6xl md:text-8xl font-bold leading-tight">
                        {{ setting('hero_title', 'Madewell') }}
                    </h1>
                    <h2 class="text-2xl md:text-3xl text-gray-300 font-light">
                        {{ setting('hero_subtitle', 'Summer Collection') }}
                    </h2>
                </div>
                <div class="flex items-center space-x-6">
                    <span class="text-5xl font-bold">{{ setting('hero_price', '$1,499') }}</span>
                    @if(setting('hero_original_price'))
                        <span class="text-2xl line-through text-gray-400">{{ setting('hero_original_price') }}</span>
                    @endif
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('shop') }}" class="bg-white text-gray-900 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 text-lg">
                        {{ setting('hero_button_text', 'Shop Now') }}
                    </a>
                    <a href="{{ route('collection.men') }}" class="border border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-gray-900 transition duration-300 text-lg">
                        View Collection
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="w-full h-[600px] bg-gray-200 rounded-2xl flex items-center justify-center shadow-2xl">
                    <span class="text-gray-500 text-xl">Hero Product Image</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-bold text-gray-900 mb-6">Featured Products</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Discover our handpicked selection of premium fashion items</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($featuredProducts as $product)
                <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative overflow-hidden">
                        <div class="w-full h-80 bg-gray-100 flex items-center justify-center">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <span class="text-gray-400 text-4xl font-bold">{{ $product->name[0] }}</span>
                            @endif
                        </div>
                        @if($product->on_sale)
                            <div class="absolute top-4 left-4">
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Sale</span>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition duration-300">
                            <button class="p-3 bg-white rounded-full shadow-lg hover:bg-gray-50 transition duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $product->short_description }}</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-2xl font-bold text-gray-900">${{ number_format($product->current_price, 2) }}</span>
                            @if($product->original_price)
                                <span class="text-lg text-gray-500 line-through">${{ number_format($product->original_price, 2) }}</span>
                            @endif
                        </div>
                        <div class="space-y-3">
                            @if($product->in_stock)
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full bg-gray-900 text-white py-3 rounded-lg font-semibold hover:bg-gray-800 transition duration-300">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <button class="w-full bg-gray-400 text-white py-3 rounded-lg font-semibold cursor-not-allowed" disabled>
                                    Out of Stock
                                </button>
                            @endif
                            <a href="{{ route('products.show', $product) }}" class="w-full border border-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-50 transition duration-300 block text-center">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Featured Products</h3>
                    <p class="text-gray-600 mb-6">We're working on adding some amazing featured products.</p>
                    <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition duration-300">
                        Browse All Products
                    </a>
                </div>
            @endforelse
        </div>
        
        @if($featuredProducts->count() > 0)
            <div class="text-center mt-12">
                <a href="{{ route('shop') }}" class="inline-flex items-center px-8 py-4 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition duration-300 text-lg">
                    View All Products
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Collection Banner -->
<section class="py-24 bg-gradient-to-r from-gray-900 to-gray-800 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center space-y-8">
            <div class="space-y-4">
                <h2 class="text-5xl md:text-7xl font-bold">#New Summer Collection 2024</h2>
                <h3 class="text-3xl md:text-4xl text-gray-300 font-light">Premium Jackets</h3>
            </div>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">Discover our latest collection of premium jackets crafted with the finest materials</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('collection.men') }}" class="bg-white text-gray-900 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 text-lg">
                    Shop Men's Collection
                </a>
                <a href="{{ route('collection.women') }}" class="border border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-gray-900 transition duration-300 text-lg">
                    Shop Women's Collection
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Collections Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-bold text-gray-900 mb-6">Shop by Collection</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Explore our curated collections designed for every style and occasion</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Men's Collection -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="h-96 bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center">
                    <div class="text-center text-white">
                        <h3 class="text-4xl font-bold mb-4">Men's</h3>
                        <p class="text-xl opacity-90">Premium Collection</p>
                    </div>
                </div>
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition duration-300"></div>
                <div class="absolute bottom-6 left-6 right-6">
                    <a href="{{ route('collection.men') }}" class="bg-white text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 block text-center">
                        Shop Men's Collection
                    </a>
                </div>
            </div>

            <!-- Women's Collection -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="h-96 bg-gradient-to-br from-pink-600 to-pink-800 flex items-center justify-center">
                    <div class="text-center text-white">
                        <h3 class="text-4xl font-bold mb-4">Women's</h3>
                        <p class="text-xl opacity-90">Elegant Collection</p>
                    </div>
                </div>
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition duration-300"></div>
                <div class="absolute bottom-6 left-6 right-6">
                    <a href="{{ route('collection.women') }}" class="bg-white text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 block text-center">
                        Shop Women's Collection
                    </a>
                </div>
            </div>

            <!-- Children's Collection -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="h-96 bg-gradient-to-br from-green-600 to-green-800 flex items-center justify-center">
                    <div class="text-center text-white">
                        <h3 class="text-4xl font-bold mb-4">Children's</h3>
                        <p class="text-xl opacity-90">Fun Collection</p>
                    </div>
                </div>
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition duration-300"></div>
                <div class="absolute bottom-6 left-6 right-6">
                    <a href="{{ route('collection.children') }}" class="bg-white text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 block text-center">
                        Shop Children's Collection
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA Section -->
<section class="py-24 bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center space-y-8">
            <div class="space-y-4">
                <h2 class="text-5xl md:text-7xl font-bold">#New Summer Collection 2024</h2>
                <h3 class="text-3xl md:text-4xl text-gray-300 font-light">Premium Denim Collection</h3>
            </div>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">Experience the perfect blend of style and comfort with our latest denim collection</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('shop') }}" class="bg-white text-gray-900 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 text-lg">
                    Shop Now
                </a>
                <a href="{{ route('catalogs.index') }}" class="border border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-gray-900 transition duration-300 text-lg">
                    Browse Catalogs
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Stay Updated</h2>
        <p class="text-lg text-gray-600 mb-8">Subscribe to our newsletter for the latest updates and exclusive offers</p>
        <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
            <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900">
            <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition duration-300">
                Subscribe
            </button>
        </form>
    </div>
</section>
@endsection