@extends('layouts.frontend')

@section('title', 'My Wishlist')
@section('description', 'View your saved items')

@section('content')
<x-page-header 
    title="My Wishlist" 
    subtitle="View your saved items"
    background="bg-gradient-to-br from-red-50 to-red-100"
/>

<!-- Wishlist Content -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($wishlistItems->count() > 0)
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Your Wishlist ({{ $wishlistItems->count() }} items)</h2>
                <button class="text-red-600 hover:text-red-800 font-medium" onclick="clearWishlist()">
                    Clear All
                </button>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($wishlistItems as $item)
                    <x-product-card :product="$item->product" :showQuickActions="true" />
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Your Wishlist is Empty</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">Start adding items to your wishlist by clicking the heart icon on any product.</p>
                <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition duration-300">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</section>

<script>
function clearWishlist() {
    if (confirm('Are you sure you want to clear your entire wishlist?')) {
        fetch('/wishlist/clear', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}
</script>
@endsection
