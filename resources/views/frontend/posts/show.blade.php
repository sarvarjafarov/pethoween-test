@extends('layouts.frontend')

@section('title', $post->title)
@section('description', $post->excerpt)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumb -->
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600">Home</a></li>
            <li class="flex items-center">
                <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <a href="{{ route('posts.index') }}" class="hover:text-blue-600">Posts</a>
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-900">{{ $post->title }}</span>
            </li>
        </ol>
    </nav>

    <!-- Post Header -->
    <header class="mb-8">
        @if($post->category)
            <div class="mb-4">
                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full" style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }}">
                    {{ $post->category->name }}
                </span>
            </div>
        @endif

        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

        @if($post->excerpt)
            <p class="text-xl text-gray-600 mb-6">{{ $post->excerpt }}</p>
        @endif

        <div class="flex items-center justify-between text-sm text-gray-500 border-b border-gray-200 pb-6">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                    <span class="text-sm font-medium text-gray-700">{{ $post->user->name[0] }}</span>
                </div>
                <div>
                    <p class="font-medium text-gray-900">{{ $post->user->name }}</p>
                    <p class="text-gray-500">{{ $post->published_at->format('F d, Y') }}</p>
                </div>
            </div>
            <div class="text-right">
                <p>{{ $post->published_at->format('M d, Y') }}</p>
                <p>{{ $post->published_at->format('g:i A') }}</p>
            </div>
        </div>
    </header>

    <!-- Featured Image -->
    @if($post->featured_image)
        <div class="mb-8">
            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-64 md:h-96 object-cover rounded-lg shadow-lg">
        </div>
    @endif

    <!-- Post Content -->
    <article class="prose prose-lg max-w-none">
        <div class="text-gray-800 leading-relaxed">
            {!! nl2br(e($post->content)) !!}
        </div>
    </article>

    <!-- Related Posts -->
    @if($relatedPosts->count() > 0)
        <section class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedPosts as $relatedPost)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        @if($relatedPost->featured_image)
                            <img src="{{ Storage::url($relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}" class="w-full h-32 object-cover">
                        @else
                            <div class="w-full h-32 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                <span class="text-white text-2xl font-bold">{{ $relatedPost->title[0] }}</span>
                            </div>
                        @endif
                        
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                <a href="{{ route('posts.show', $relatedPost) }}" class="hover:text-blue-600 transition duration-300">
                                    {{ $relatedPost->title }}
                                </a>
                            </h3>
                            
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>By {{ $relatedPost->user->name }}</span>
                                <span>{{ $relatedPost->published_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <!-- Back to Posts -->
    <div class="mt-12 text-center">
        <a href="{{ route('posts.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to All Posts
        </a>
    </div>
</div>
@endsection
