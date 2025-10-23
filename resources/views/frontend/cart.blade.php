@extends('layouts.frontend')

@section('title', 'Shopping Cart')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Shopping Cart</h1>
            <a href="{{ route('shop') }}" class="text-blue-600 hover:text-blue-800 font-medium">Continue Shopping</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if($cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Cart Items</h2>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <div class="p-6 flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        @if($item->product->image)
                                            <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product->name }}" class="h-20 w-20 object-cover rounded-lg">
                                        @else
                                            <div class="h-20 w-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <span class="text-gray-500 text-2xl font-bold">{{ $item->product->name[0] }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $item->product->name }}</h3>
                                        <p class="text-sm text-gray-500">SKU: {{ $item->product->sku }}</p>
                                        <p class="text-sm text-gray-500">{{ $item->product->short_description }}</p>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="flex items-center space-x-2">
                                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center space-x-2">
                                                @csrf
                                                @method('PUT')
                                                <label for="quantity-{{ $item->id }}" class="text-sm font-medium text-gray-700">Qty:</label>
                                                <input type="number" name="quantity" id="quantity-{{ $item->id }}" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock_quantity }}" class="w-16 px-2 py-1 border border-gray-300 rounded text-center">
                                                <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm">Update</button>
                                            </form>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-semibold text-gray-900">${{ number_format($item->total, 2) }}</p>
                                            <p class="text-sm text-gray-500">${{ number_format($item->price, 2) }} each</p>
                                        </div>
                                        <form action="{{ route('cart.remove', $item) }}" method="POST" class="ml-4">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tax (10%)</span>
                                <span class="font-medium">${{ number_format($tax, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-medium">
                                    @if($shipping > 0)
                                        ${{ number_format($shipping, 2) }}
                                    @else
                                        <span class="text-green-600">Free</span>
                                    @endif
                                </span>
                            </div>
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-gray-900">Total</span>
                                    <span class="text-lg font-semibold text-gray-900">${{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 space-y-3">
                            <a href="{{ route('checkout.index') }}" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 text-center block">
                                Proceed to Checkout
                            </a>
                            <form action="{{ route('cart.clear') }}" method="POST" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-gray-500 text-white py-3 px-4 rounded-lg font-semibold hover:bg-gray-600 transition duration-300">
                                    Clear Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Your cart is empty</h3>
                <p class="mt-1 text-sm text-gray-500">Start adding some items to your cart.</p>
                <div class="mt-6">
                    <a href="{{ route('shop') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Continue Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
