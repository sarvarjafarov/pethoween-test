@props([
    'product',
    'showQuickActions' => true,
    'size' => 'default' // default, compact, large
])

@php
    $sizeClasses = [
        'compact' => 'h-64',
        'default' => 'h-80',
        'large' => 'h-96'
    ];
    
    $cardSizeClasses = [
        'compact' => 'p-4',
        'default' => 'p-6',
        'large' => 'p-8'
    ];
@endphp

<div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
    <div class="relative overflow-hidden">
        <div class="w-full {{ $sizeClasses[$size] }} bg-gray-100 flex items-center justify-center">
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
        
        @if($product->featured)
            <div class="absolute top-4 right-4">
                <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Featured</span>
            </div>
        @endif
        
        @if($showQuickActions)
            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition duration-300 space-y-2">
                <button class="wishlist-toggle p-3 bg-white rounded-full shadow-lg hover:bg-gray-50 transition duration-300" 
                        data-product-id="{{ $product->id }}" 
                        title="Add to Wishlist">
                    <svg class="w-5 h-5 heart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </button>
                <a href="{{ route('products.show', $product) }}" class="p-3 bg-white rounded-full shadow-lg hover:bg-gray-50 transition duration-300" title="Quick View">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </a>
            </div>
        @endif
    </div>
    
    <div class="{{ $cardSizeClasses[$size] }}">
        <div class="mb-4">
            <h3 class="text-xl font-semibold text-gray-900 mb-2 line-clamp-2">{{ $product->name }}</h3>
            <p class="text-gray-600 mb-4 line-clamp-2">{{ $product->short_description }}</p>
            
            @if($product->category)
                <div class="mb-3">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" style="background-color: {{ $product->category->color }}20; color: {{ $product->category->color }}">
                        {{ $product->category->name }}
                    </span>
                </div>
            @endif
        </div>
        
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
                <span class="text-2xl font-bold text-gray-900">${{ number_format($product->current_price, 2) }}</span>
                @if($product->original_price)
                    <span class="text-lg text-gray-500 line-through">${{ number_format($product->original_price, 2) }}</span>
                @endif
            </div>
            @if($product->discount_percentage > 0)
                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-medium">
                    {{ $product->discount_percentage }}% OFF
                </span>
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
