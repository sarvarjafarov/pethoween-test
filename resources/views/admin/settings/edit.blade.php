@extends('layouts.admin')

@section('title', 'Edit Setting: ' . $setting->key)

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Setting: {{ $setting->key }}</h1>
    
    <form action="{{ route('admin.settings.update', $setting) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="key" class="block text-sm font-medium text-gray-700 mb-2">Key *</label>
                <input type="text" name="key" id="key" value="{{ old('key', $setting->key) }}" required
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
                    <option value="text" {{ old('type', $setting->type) == 'text' ? 'selected' : '' }}>Text</option>
                    <option value="textarea" {{ old('type', $setting->type) == 'textarea' ? 'selected' : '' }}>Textarea</option>
                    <option value="image" {{ old('type', $setting->type) == 'image' ? 'selected' : '' }}>Image</option>
                    <option value="boolean" {{ old('type', $setting->type) == 'boolean' ? 'selected' : '' }}>Boolean</option>
                    <option value="json" {{ old('type', $setting->type) == 'json' ? 'selected' : '' }}>JSON</option>
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
                    <option value="general" {{ old('group', $setting->group) == 'general' ? 'selected' : '' }}>General</option>
                    <option value="header" {{ old('group', $setting->group) == 'header' ? 'selected' : '' }}>Header</option>
                    <option value="footer" {{ old('group', $setting->group) == 'footer' ? 'selected' : '' }}>Footer</option>
                    <option value="seo" {{ old('group', $setting->group) == 'seo' ? 'selected' : '' }}>SEO</option>
                    <option value="social" {{ old('group', $setting->group) == 'social' ? 'selected' : '' }}>Social</option>
                    <option value="hero" {{ old('group', $setting->group) == 'hero' ? 'selected' : '' }}>Hero</option>
                </select>
                @error('group')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $setting->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mt-6">
            <label for="value" class="block text-sm font-medium text-gray-700 mb-2">Value</label>
            <div id="value-input-container">
                @if($setting->type === 'textarea')
                    <textarea name="value" id="value" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('value', $setting->value) }}</textarea>
                @elseif($setting->type === 'image')
                    <div>
                        @if($setting->value)
                            <div class="mb-2">
                                <img src="{{ Storage::url($setting->value) }}" alt="{{ $setting->key }}" class="w-32 h-32 object-cover rounded">
                            </div>
                        @endif
                        <input type="file" name="value" id="value" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                @elseif($setting->type === 'boolean')
                    <select name="value" id="value" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="1" {{ old('value', $setting->value) == '1' ? 'selected' : '' }}>True</option>
                        <option value="0" {{ old('value', $setting->value) == '0' ? 'selected' : '' }}>False</option>
                    </select>
                @else
                    <input type="text" name="value" id="value" value="{{ old('value', $setting->value) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @endif
            </div>
            @error('value')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.settings.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600 transition duration-300 mr-4">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">Update Setting</button>
        </div>
    </form>
</div>

<script>
document.getElementById('type').addEventListener('change', function() {
    const container = document.getElementById('value-input-container');
    const type = this.value;
    const currentValue = '{{ old("value", $setting->value) }}';
    
    if (type === 'textarea') {
        container.innerHTML = '<textarea name="value" id="value" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">' + currentValue + '</textarea>';
    } else if (type === 'image') {
        container.innerHTML = '<input type="file" name="value" id="value" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">';
    } else if (type === 'boolean') {
        const selected = currentValue == '1' ? 'selected' : '';
        container.innerHTML = '<select name="value" id="value" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><option value="1" ' + selected + '>True</option><option value="0" ' + (selected ? '' : 'selected') + '>False</option></select>';
    } else {
        container.innerHTML = '<input type="text" name="value" id="value" value="' + currentValue + '" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">';
    }
});
</script>
@endsection
