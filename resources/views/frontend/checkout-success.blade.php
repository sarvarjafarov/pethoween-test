@extends('layouts.frontend')

@section('title', 'Order Confirmation')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Order Confirmed!</h1>
            <p class="text-lg text-gray-600">Thank you for your purchase. Your order has been placed successfully.</p>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Order Details</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Order Information</h3>
                        <div class="space-y-2">
                            <p><span class="font-medium text-gray-700">Order Number:</span> {{ $order->order_number }}</p>
                            <p><span class="font-medium text-gray-700">Order Date:</span> {{ $order->created_at->format('M d, Y') }}</p>
                            <p><span class="font-medium text-gray-700">Status:</span> 
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                            <p><span class="font-medium text-gray-700">Total:</span> ${{ number_format($order->total, 2) }}</p>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Shipping Information</h3>
                        <div class="space-y-2">
                            <p><span class="font-medium text-gray-700">Name:</span> {{ $order->first_name }} {{ $order->last_name }}</p>
                            <p><span class="font-medium text-gray-700">Email:</span> {{ $order->email }}</p>
                            @if($order->phone)
                                <p><span class="font-medium text-gray-700">Phone:</span> {{ $order->phone }}</p>
                            @endif
                            <p><span class="font-medium text-gray-700">Address:</span> {{ $order->address }}</p>
                            <p><span class="font-medium text-gray-700">City:</span> {{ $order->city }}, {{ $order->state }} {{ $order->postal_code }}</p>
                            <p><span class="font-medium text-gray-700">Country:</span> {{ $order->country }}</p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Order Items</h3>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    @if($item->product->image)
                                        <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product_name }}" class="h-16 w-16 object-cover rounded-lg">
                                    @else
                                        <div class="h-16 w-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <span class="text-gray-500 text-lg font-bold">{{ $item->product_name[0] }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-gray-900">{{ $item->product_name }}</h4>
                                    <p class="text-sm text-gray-500">SKU: {{ $item->product_sku }}</p>
                                    <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">${{ number_format($item->price, 2) }} each</p>
                                    <p class="text-sm font-medium text-gray-900">${{ number_format($item->total, 2) }} total</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6 mt-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Order Summary</h3>
                        </div>
                        <div class="text-right">
                            <div class="space-y-1">
                                <p class="text-sm text-gray-600">Subtotal: ${{ number_format($order->subtotal, 2) }}</p>
                                <p class="text-sm text-gray-600">Tax: ${{ number_format($order->tax, 2) }}</p>
                                <p class="text-sm text-gray-600">Shipping: 
                                    @if($order->shipping > 0)
                                        ${{ number_format($order->shipping, 2) }}
                                    @else
                                        Free
                                    @endif
                                </p>
                                <p class="text-lg font-semibold text-gray-900">Total: ${{ number_format($order->total, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-center space-x-4">
            <a href="{{ route('shop') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                Continue Shopping
            </a>
            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Back to Home
            </a>
        </div>
    </div>
</section>
@endsection
