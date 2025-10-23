@extends('layouts.admin')

@section('title', 'Content Block Details: ' . $contentBlock->name)

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Content Block Details: {{ $contentBlock->name }}</h1>
        <a href="{{ route('admin.content-blocks.edit', $contentBlock) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Edit Content Block</a>
    </div>
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="text-sm text-gray-900">{{ $contentBlock->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Type</dt>
                        <dd class="text-sm text-gray-900">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ ucfirst($contentBlock->type) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Location</dt>
                        <dd class="text-sm text-gray-900">{{ $contentBlock->location ?: 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Sort Order</dt>
                        <dd class="text-sm text-gray-900">{{ $contentBlock->sort_order }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $contentBlock->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $contentBlock->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Timestamps</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Created At</dt>
                        <dd class="text-sm text-gray-900">{{ $contentBlock->created_at->format('M d, Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Updated At</dt>
                        <dd class="text-sm text-gray-900">{{ $contentBlock->updated_at->format('M d, Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Content</h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="prose max-w-none">
                    {!! $contentBlock->content !!}
                </div>
            </div>
        </div>
        
        @if($contentBlock->settings)
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Settings</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <pre class="text-sm text-gray-900 overflow-x-auto">{{ json_encode($contentBlock->settings, JSON_PRETTY_PRINT) }}</pre>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
