@extends('layouts.frontend')

@section('title', 'Checkout')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
            <a href="{{ route('cart.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">Back to Cart</a>
        </div>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Checkout Form -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Shipping Information</h2>
                
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', auth()->user()->name ?? '') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('first_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('last_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email ?? '') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Street Address *</label>
                        <textarea name="address" id="address" rows="3" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                            <input type="text" name="city" id="city" value="{{ old('city') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('city')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                            <input type="text" name="state" id="state" value="{{ old('state') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('state')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Postal Code *</label>
                            <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('postal_code')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country *</label>
                        <select name="country" id="country" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Country</option>
                            <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>United States</option>
                            <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>Canada</option>
                            <option value="GB" {{ old('country') == 'GB' ? 'selected' : '' }}>United Kingdom</option>
                            <option value="AU" {{ old('country') == 'AU' ? 'selected' : '' }}>Australia</option>
                            <option value="DE" {{ old('country') == 'DE' ? 'selected' : '' }}>Germany</option>
                            <option value="FR" {{ old('country') == 'FR' ? 'selected' : '' }}>France</option>
                            <option value="IT" {{ old('country') == 'IT' ? 'selected' : '' }}>Italy</option>
                            <option value="ES" {{ old('country') == 'ES' ? 'selected' : '' }}>Spain</option>
                            <option value="NL" {{ old('country') == 'NL' ? 'selected' : '' }}>Netherlands</option>
                            <option value="BE" {{ old('country') == 'BE' ? 'selected' : '' }}>Belgium</option>
                        </select>
                        @error('country')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Order Notes (Optional)</label>
                        <textarea name="notes" id="notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                        Place Order
                    </button>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Order Summary</h2>
                
                <div class="space-y-4 mb-6">
                    @foreach($cartItems as $item)
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                @if($item->product->image)
                                    <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product->name }}" class="h-16 w-16 object-cover rounded-lg">
                                @else
                                    <div class="h-16 w-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <span class="text-gray-500 text-lg font-bold">{{ $item->product->name[0] }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">${{ number_format($item->total, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <div class="space-y-2">
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
                        <div class="border-t border-gray-200 pt-2">
                            <div class="flex justify-between">
                                <span class="text-lg font-semibold text-gray-900">Total</span>
                                <span class="text-lg font-semibold text-gray-900">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
