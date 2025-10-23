@extends('layouts.frontend')

@section('title', 'Posts')
@section('description', 'Browse all our posts and articles')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">All Posts</h1>
        <p class="text-lg text-gray-600">Discover our latest content and articles</p>
    </div>

    <!-- Search and Filters -->
    <div class="mb-8">
        <form method="GET" action="{{ route('posts.index') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search posts..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="md:w-64">
                <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->posts_count }})
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Search
            </button>
        </form>
    </div>

    <!-- Posts Grid -->
    @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    @if($post->featured_image)
                        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                            <span class="text-white text-4xl font-bold">{{ $post->title[0] }}</span>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            @if($post->category)
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full" style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }}">
                                    {{ $post->category->name }}
                                </span>
                            @endif
                        </div>
                        
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600 transition duration-300">
                                {{ $post->title }}
                            </a>
                        </h3>
                        
                        @if($post->excerpt)
                            <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt, 120) }}</p>
                        @endif
                        
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>By {{ $post->user->name }}</span>
                            <span>{{ $post->published_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-gray-400 mb-4">
                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No posts found</h3>
            <p class="text-gray-600">Try adjusting your search criteria or check back later for new content.</p>
        </div>
    @endif
</div>
@endsection
