@extends('layouts.admin')

@section('title', $post->title)
@section('page-title', 'View Post')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $post->title }}</h1>
                    <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                        <span>By {{ $post->user->name }}</span>
                        <span>•</span>
                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                        @if($post->published_at)
                            <span>•</span>
                            <span>Published {{ $post->published_at->format('M d, Y') }}</span>
                        @endif
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.posts.edit', $post) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                        Edit Post
                    </a>
                    <a href="{{ route('admin.posts.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition duration-300">
                        Back to Posts
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-6 py-6">
            <!-- Meta Information -->
            <div class="mb-6 flex flex-wrap items-center gap-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 
                       ($post->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                    {{ ucfirst($post->status) }}
                </span>
                
                @if($post->category)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }}">
                        {{ $post->category->name }}
                    </span>
                @endif
                
                @if($post->featured)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        Featured
                    </span>
                @endif
            </div>

            <!-- Excerpt -->
            @if($post->excerpt)
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Excerpt</h3>
                    <p class="text-gray-700">{{ $post->excerpt }}</p>
                </div>
            @endif

            <!-- Content -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Content</h3>
                <div class="prose max-w-none">
                    <div class="text-gray-800 whitespace-pre-wrap">{{ $post->content }}</div>
                </div>
            </div>

            <!-- Featured Image -->
            @if($post->featured_image)
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Featured Image</h3>
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="max-w-md rounded-lg shadow-md">
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    Last updated: {{ $post->updated_at->format('M d, Y g:i A') }}
                </div>
                <div class="flex space-x-2">
                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300">
                            Delete Post
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
