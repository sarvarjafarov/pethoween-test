@extends('layouts.admin')

@section('title', 'Media')
@section('page-title', 'Media Library')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">Media Library</h2>
        <a href="{{ route('admin.media.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
            Upload New File
        </a>
    </div>

    <!-- Media Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
        @forelse($media as $item)
            <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                <div class="aspect-square bg-gray-100 flex items-center justify-center">
                    @if(str_starts_with($item->mime_type, 'image/'))
                        <img src="{{ $item->url }}" alt="{{ $item->alt_text }}" class="w-full h-full object-cover">
                    @else
                        <div class="text-center p-4">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-xs text-gray-500">{{ $item->original_name }}</p>
                        </div>
                    @endif
                </div>
                
                <div class="p-3">
                    <h3 class="text-sm font-medium text-gray-900 truncate" title="{{ $item->original_name }}">
                        {{ $item->original_name }}
                    </h3>
                    <p class="text-xs text-gray-500 mt-1">{{ $item->formatted_size }}</p>
                    <p class="text-xs text-gray-500">{{ $item->created_at->format('M d, Y') }}</p>
                    
                    <div class="mt-2 flex justify-between items-center">
                        <a href="{{ $item->url }}" target="_blank" class="text-blue-600 hover:text-blue-900 text-xs">View</a>
                        <div class="flex space-x-1">
                            <a href="{{ route('admin.media.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 text-xs">Edit</a>
                            <form method="POST" action="{{ route('admin.media.destroy', $item) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this file?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-xs">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No media files found</h3>
                <p class="text-gray-600 mb-4">Upload your first file to get started.</p>
                <a href="{{ route('admin.media.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                    Upload File
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($media->hasPages())
        <div class="mt-6">
            {{ $media->links() }}
        </div>
    @endif
</div>
@endsection
