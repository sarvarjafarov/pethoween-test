@php
    use Illuminate\Support\Facades\Storage;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Welcome') - {{ setting('site_name', config('app.name', 'Laravel CMS')) }}</title>
    <meta name="description" content="@yield('description', setting('site_description', 'A modern Laravel CMS built with Tailwind CSS'))">
    <meta name="keywords" content="{{ setting('site_keywords', '') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Custom CSS for Dealers theme -->
    <style>
        .dealers-nav {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .hero-gradient {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .product-card {
            transition: all 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .sale-badge {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Top Navigation Bar -->
    <div class="bg-gray-800 text-white py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center text-sm">
                <div class="flex items-center space-x-4">
                    <span>{{ setting('header_welcome_text', 'Welcome to our store!') }}</span>
                    <span>{{ setting('header_shipping_text', 'Free shipping on orders over $50') }}</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span>{{ setting('header_phone', 'Call us: +1 234 567 890') }}</span>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300">Admin</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-gray-300">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-gray-300">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-gray-300">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="bg-white/95 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                        @if(setting('site_logo'))
                            <img src="{{ Storage::url(setting('site_logo')) }}" alt="{{ setting('site_name', 'Dealers') }}" class="h-10 w-auto">
                        @else
                            <h1 class="text-2xl font-bold text-gray-900">{{ setting('site_name', 'Dealers') }}</h1>
                        @endif
                    </a>
                </div>
                
                <!-- Navigation Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    @foreach(menu() as $menuItem)
                        @if($menuItem->children->count() > 0)
                            <div class="relative group">
                                <button class="text-gray-700 hover:text-gray-900 px-4 py-2 rounded-lg text-sm font-medium flex items-center transition-colors duration-200">
                                    {{ $menuItem->name }}
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="absolute left-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                    @foreach($menuItem->children as $child)
                                        <a href="{{ $child->url }}" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-200 first:rounded-t-xl last:rounded-b-xl">{{ $child->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ $menuItem->url }}" class="text-gray-700 hover:text-gray-900 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->url() === url($menuItem->url) ? 'text-gray-900 bg-gray-100' : '' }}">
                                {{ $menuItem->name }}
                            </a>
                        @endif
                    @endforeach
                </div>
                
                <!-- Search and Cart -->
                <div class="flex items-center space-x-6">
                    <div class="relative hidden lg:block">
                        <input type="text" placeholder="Search products..." class="w-72 px-4 py-3 pl-10 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent bg-gray-50">
                        <button class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                      <a href="{{ route('wishlist.index') }}" class="relative p-3 text-gray-700 hover:text-gray-900 transition-colors duration-200 rounded-lg hover:bg-gray-50">
                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                          </svg>
                          @php
                              $wishlistCount = \App\Models\Wishlist::where(function($query) {
                                  if (auth()->check()) {
                                      $query->where('user_id', auth()->id());
                                  } else {
                                      $query->where('session_id', session()->getId());
                                  }
                              })->count();
                          @endphp
                          @if($wishlistCount > 0)
                              <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-semibold">{{ $wishlistCount }}</span>
                          @endif
                      </a>
                      <a href="{{ route('cart.index') }}" class="relative p-3 text-gray-700 hover:text-gray-900 transition-colors duration-200 rounded-lg hover:bg-gray-50">
                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                          </svg>
                          @php
                              $cartCount = \App\Models\Cart::where(function($query) {
                                  if (auth()->check()) {
                                      $query->where('user_id', auth()->id());
                                  } else {
                                      $query->where('session_id', session()->getId());
                                  }
                              })->sum('quantity');
                          @endphp
                          @if($cartCount > 0)
                              <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-semibold">{{ $cartCount }}</span>
                          @endif
                      </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About Us -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ setting('footer_about_title', 'About Us') }}</h3>
                    <p class="text-gray-300">{{ setting('footer_about_text', 'We are a premium fashion destination offering the latest trends and timeless classics.') }}</p>
                    <button class="bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">
                        Subscribe
                    </button>
                </div>
                
                <!-- Quick Links -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ setting('footer_quick_links_title', 'Quick Links') }}</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="/shop" class="text-gray-300 hover:text-white">Shop</a></li>
                        <li><a href="/about" class="text-gray-300 hover:text-white">About</a></li>
                        <li><a href="/contact" class="text-gray-300 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                
                <!-- More -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ setting('footer_more_title', 'More') }}</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">My Account</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Order Tracking</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Wishlist</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Terms</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ setting('footer_contact_title', 'Contact Info') }}</h3>
                    <div class="space-y-2 text-gray-300">
                        <p>{{ setting('footer_address', '123 Fashion Street, Style City, SC 12345') }}</p>
                        <p>{{ setting('footer_phone', '+1 (555) 123-4567') }}</p>
                        <p>{{ setting('footer_email', 'info@dealers.com') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 pt-8 border-t border-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        {{ setting('footer_copyright', 'Copyright © ' . date('Y') . ' All rights reserved | This template is made with ❤️ by Colorlib') }}
                    </p>
                    <div class="flex space-x-4 mt-4 md:mt-0">
                        @if(setting('social_facebook'))
                            <a href="{{ setting('social_facebook') }}" class="text-gray-400 hover:text-white transition duration-300" target="_blank">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                        @endif
                        @if(setting('social_twitter'))
                            <a href="{{ setting('social_twitter') }}" class="text-gray-400 hover:text-white transition duration-300" target="_blank">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                        @endif
                        @if(setting('social_instagram'))
                            <a href="{{ setting('social_instagram') }}" class="text-gray-400 hover:text-white transition duration-300" target="_blank">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                                </svg>
                            </a>
                        @endif
                        @if(setting('social_pinterest'))
                            <a href="{{ setting('social_pinterest') }}" class="text-gray-400 hover:text-white transition duration-300" target="_blank">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <script>
        // Wishlist functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Handle wishlist toggle
            document.querySelectorAll('.wishlist-toggle').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const productId = this.getAttribute('data-product-id');
                    const heartIcon = this.querySelector('.heart-icon');
                    
                    fetch(`/wishlist/toggle/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update heart icon
                            if (data.in_wishlist) {
                                heartIcon.classList.add('text-red-500');
                                heartIcon.classList.remove('text-gray-500');
                                this.title = 'Remove from Wishlist';
                            } else {
                                heartIcon.classList.remove('text-red-500');
                                heartIcon.classList.add('text-gray-500');
                                this.title = 'Add to Wishlist';
                            }
                            
                            // Show notification
                            showNotification(data.message, data.in_wishlist ? 'success' : 'info');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Something went wrong. Please try again.', 'error');
                    });
                });
            });
        });
        
        // Notification function
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${
                type === 'success' ? 'bg-green-500 text-white' : 
                type === 'error' ? 'bg-red-500 text-white' : 
                'bg-blue-500 text-white'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Animate out and remove
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    </script>
</body>
</html>
