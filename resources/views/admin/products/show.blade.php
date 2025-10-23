@extends('layouts.admin')

@section('title', $product->name)
@section('page-title', 'View Product')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                    <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                        <span>SKU: {{ $product->sku }}</span>
                        <span>•</span>
                        <span>Created {{ $product->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                        Edit Product
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition duration-300">
                        Back to Products
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-6 py-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Product Image -->
                <div>
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg">
                    @else
                        <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                            <span class="text-gray-500 text-lg">No image available</span>
                        </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="space-y-6">
                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center gap-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 
                               ($product->status === 'inactive' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($product->status) }}
                        </span>
                        
                        @if($product->category)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" style="background-color: {{ $product->category->color }}20; color: {{ $product->category->color }}">
                                {{ $product->category->name }}
                            </span>
                        @endif
                        
                        @if($product->featured)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Featured
                            </span>
                        @endif

                        @if($product->on_sale)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                On Sale
                            </span>
                        @endif
                    </div>

                    <!-- Pricing -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Pricing</h3>
                        <div class="flex items-center space-x-4">
                            <span class="text-2xl font-bold text-gray-900">${{ number_format($product->current_price, 2) }}</span>
                            @if($product->original_price)
                                <span class="text-lg text-gray-500 line-through">${{ number_format($product->original_price, 2) }}</span>
                            @endif
                        </div>
                        @if($product->discount_percentage > 0)
                            <p class="text-sm text-green-600 mt-1">{{ $product->discount_percentage }}% off</p>
                        @endif
                    </div>

                    <!-- Inventory -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Inventory</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-gray-500">Stock Quantity</span>
                                <p class="text-lg font-semibold">{{ $product->stock_quantity }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Availability</span>
                                <p class="text-lg font-semibold {{ $product->in_stock ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Short Description -->
                    @if($product->short_description)
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Short Description</h3>
                            <p class="text-gray-700">{{ $product->short_description }}</p>
                        </div>
                    @endif

                    <!-- Description -->
                    @if($product->description)
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                            <div class="prose max-w-none">
                                <p class="text-gray-700">{{ $product->description }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    Last updated: {{ $product->updated_at->format('M d, Y g:i A') }}
                </div>
                <div class="flex space-x-2">
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300">
                            Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
