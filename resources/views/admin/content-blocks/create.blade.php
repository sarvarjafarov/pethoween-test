@extends('layouts.admin')

@section('title', 'Create Content Block')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Create New Content Block</h1>
    
    <form action="{{ route('admin.content-blocks.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                <select name="type" id="type" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Type</option>
                    <option value="header" {{ old('type') == 'header' ? 'selected' : '' }}>Header</option>
                    <option value="footer" {{ old('type') == 'footer' ? 'selected' : '' }}>Footer</option>
                    <option value="hero" {{ old('type') == 'hero' ? 'selected' : '' }}>Hero</option>
                    <option value="section" {{ old('type') == 'section' ? 'selected' : '' }}>Section</option>
                    <option value="widget" {{ old('type') == 'widget' ? 'selected' : '' }}>Widget</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="e.g., top, bottom, sidebar">
                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('sort_order')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mt-6">
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
            <textarea name="content" id="content" rows="10" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter HTML content here...">{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mt-6">
            <label for="settings" class="block text-sm font-medium text-gray-700 mb-2">Settings (JSON)</label>
            <textarea name="settings" id="settings" rows="4"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder='{"key": "value"}'>{{ old('settings') }}</textarea>
            @error('settings')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mt-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-700">Active</span>
            </label>
        </div>
        
        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.content-blocks.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600 transition duration-300 mr-4">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">Create Content Block</button>
        </div>
    </form>
</div>
@endsection
