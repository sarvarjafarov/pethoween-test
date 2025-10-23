@extends('layouts.frontend')

@section('title', $product->name)
@section('description', $product->short_description)

@section('content')
<!-- Breadcrumb -->
<section class="py-4 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('shop') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Shop</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>

<!-- Product Detail Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <!-- Product Image -->
            <div class="space-y-4">
                <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-[600px] object-cover">
                    @else
                        <div class="w-full h-[600px] bg-gray-100 flex items-center justify-center">
                            <span class="text-gray-400 text-6xl font-bold">{{ $product->name[0] }}</span>
                        </div>
                    @endif
                    
                    @if($product->on_sale)
                        <div class="absolute top-6 left-6">
                            <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-semibold">Sale</span>
                        </div>
                    @endif
                    
                    @if($product->featured)
                        <div class="absolute top-6 right-6">
                            <span class="bg-yellow-500 text-white px-4 py-2 rounded-full text-sm font-semibold">Featured</span>
                        </div>
                    @endif
                </div>
                
                <!-- Thumbnail Images (if gallery exists) -->
                <div class="grid grid-cols-4 gap-4">
                    @for($i = 0; $i < 4; $i++)
                        <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden cursor-pointer hover:opacity-75 transition duration-200">
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="text-gray-400 text-sm">{{ $i + 1 }}</span>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Product Info -->
            <div class="space-y-8">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                    @if($product->category)
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium" style="background-color: {{ $product->category->color }}20; color: {{ $product->category->color }}">
                            {{ $product->category->name }}
                        </span>
                    @endif
                </div>

                @if($product->short_description)
                    <p class="text-xl text-gray-600 leading-relaxed">{{ $product->short_description }}</p>
                @endif

                <!-- Pricing -->
                <div class="flex items-center space-x-6">
                    <span class="text-4xl font-bold text-gray-900">${{ number_format($product->current_price, 2) }}</span>
                    @if($product->original_price)
                        <span class="text-2xl text-gray-500 line-through">${{ number_format($product->original_price, 2) }}</span>
                    @endif
                    @if($product->discount_percentage > 0)
                        <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold">
                            {{ $product->discount_percentage }}% OFF
                        </span>
                    @endif
                </div>

                <!-- Stock Status -->
                <div class="flex items-center space-x-3">
                    @if($product->in_stock)
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-green-600 font-semibold">In Stock</span>
                        </div>
                        <span class="text-gray-500">({{ $product->stock_quantity }} available)</span>
                    @else
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <span class="text-red-600 font-semibold">Out of Stock</span>
                        </div>
                    @endif
                </div>

                <!-- Size and Color Selection -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Size</h3>
                        <div class="flex flex-wrap gap-3">
                            @foreach(['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                                <button class="px-6 py-3 border-2 border-gray-300 rounded-lg hover:border-gray-900 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 transition duration-200 font-medium">
                                    {{ $size }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Color</h3>
                        <div class="flex flex-wrap gap-3">
                            @foreach(['Black', 'White', 'Red', 'Blue', 'Green', 'Yellow'] as $color)
                                <button class="w-12 h-12 rounded-full border-2 border-gray-300 hover:border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 transition duration-200" 
                                        style="background-color: {{ strtolower($color) === 'black' ? '#000000' : (strtolower($color) === 'white' ? '#ffffff' : '#' . substr(md5($color), 0, 6)) }}"
                                        title="{{ $color }}">
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Add to Cart -->
                @if($product->in_stock)
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="flex items-center space-x-4">
                            <label for="quantity" class="text-lg font-medium text-gray-700">Quantity:</label>
                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <button type="button" class="px-4 py-2 hover:bg-gray-50 transition duration-200">-</button>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" class="w-20 px-4 py-2 text-center border-0 focus:outline-none">
                                <button type="button" class="px-4 py-2 hover:bg-gray-50 transition duration-200">+</button>
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <button type="submit" class="flex-1 bg-gray-900 text-white px-8 py-4 rounded-lg font-semibold hover:bg-gray-800 transition duration-300 text-lg">
                                Add to Cart
                            </button>
                            <button class="px-6 py-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                @else
                    <div class="space-y-4">
                        <button class="w-full bg-gray-400 text-white px-8 py-4 rounded-lg font-semibold cursor-not-allowed text-lg" disabled>
                            Out of Stock
                        </button>
                    </div>
                @endif

                <!-- Product Description -->
                @if($product->description)
                    <div class="pt-8 border-t border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">Description</h3>
                        <div class="prose max-w-none">
                            <p class="text-gray-700 text-lg leading-relaxed">{{ $product->description }}</p>
                        </div>
                    </div>
                @endif

                <!-- Product Details -->
                <div class="pt-8 border-t border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Product Details</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">SKU:</span>
                            <span class="font-semibold">{{ $product->sku }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Category:</span>
                            <span class="font-semibold">{{ $product->category->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Stock:</span>
                            <span class="font-semibold">{{ $product->stock_quantity }} available</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Condition:</span>
                            <span class="font-semibold">New</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">You Might Also Like</h2>
            <p class="text-xl text-gray-600">Discover more products from our collection</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @if(isset($relatedProducts) && $relatedProducts->count() > 0)
                @foreach($relatedProducts as $relatedProduct)
                    <x-product-card :product="$relatedProduct" />
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
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Related Product {{ $i + 1 }}</h3>
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
@endsection
