@extends('layouts.admin')

@section('title', 'Create Setting')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Create New Setting</h1>
    
    <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="key" class="block text-sm font-medium text-gray-700 mb-2">Key *</label>
                <input type="text" name="key" id="key" value="{{ old('key') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('key')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                <select name="type" id="type" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Type</option>
                    <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
                    <option value="textarea" {{ old('type') == 'textarea' ? 'selected' : '' }}>Textarea</option>
                    <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Image</option>
                    <option value="boolean" {{ old('type') == 'boolean' ? 'selected' : '' }}>Boolean</option>
                    <option value="json" {{ old('type') == 'json' ? 'selected' : '' }}>JSON</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="group" class="block text-sm font-medium text-gray-700 mb-2">Group *</label>
                <select name="group" id="group" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Group</option>
                    <option value="general" {{ old('group') == 'general' ? 'selected' : '' }}>General</option>
                    <option value="header" {{ old('group') == 'header' ? 'selected' : '' }}>Header</option>
                    <option value="footer" {{ old('group') == 'footer' ? 'selected' : '' }}>Footer</option>
                    <option value="seo" {{ old('group') == 'seo' ? 'selected' : '' }}>SEO</option>
                    <option value="social" {{ old('group') == 'social' ? 'selected' : '' }}>Social</option>
                    <option value="hero" {{ old('group') == 'hero' ? 'selected' : '' }}>Hero</option>
                </select>
                @error('group')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mt-6">
            <label for="value" class="block text-sm font-medium text-gray-700 mb-2">Value</label>
            <div id="value-input-container">
                <input type="text" name="value" id="value" value="{{ old('value') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            @error('value')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.settings.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600 transition duration-300 mr-4">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">Create Setting</button>
        </div>
    </form>
</div>

<script>
document.getElementById('type').addEventListener('change', function() {
    const container = document.getElementById('value-input-container');
    const type = this.value;
    
    if (type === 'textarea') {
        container.innerHTML = '<textarea name="value" id="value" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old("value") }}</textarea>';
    } else if (type === 'image') {
        container.innerHTML = '<input type="file" name="value" id="value" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">';
    } else if (type === 'boolean') {
        container.innerHTML = '<select name="value" id="value" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><option value="1">True</option><option value="0">False</option></select>';
    } else {
        container.innerHTML = '<input type="text" name="value" id="value" value="{{ old("value") }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">';
    }
});
</script>
@endsection
