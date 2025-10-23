@extends('layouts.admin')

@section('title', 'Create Category')
@section('page-title', 'Create New Category')

@section('content')
<div class="max-w-2xl mx-auto">
    <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6">
        @csrf
        
        <div class="bg-white shadow rounded-lg p-6">
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                           placeholder="Enter category name">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                              placeholder="Brief description of the category">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                    <div class="flex items-center space-x-4">
                        <input type="color" name="color" id="color" value="{{ old('color', '#3B82F6') }}" required
                               class="h-10 w-20 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('color') border-red-500 @enderror">
                        <input type="text" name="color_text" id="color_text" value="{{ old('color', '#3B82F6') }}" required
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('color') border-red-500 @enderror"
                               placeholder="#3B82F6" pattern="^#[0-9A-Fa-f]{6}$">
                    </div>
                    @error('color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Choose a color for this category</p>
                </div>

                <!-- Preview -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                    <div class="p-4 border border-gray-200 rounded-md bg-gray-50">
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full mr-3" id="color-preview" style="background-color: {{ old('color', '#3B82F6') }}"></div>
                            <span id="name-preview" class="text-lg font-medium">{{ old('name', 'Category Name') }}</span>
                        </div>
                        @if(old('description'))
                            <p id="description-preview" class="mt-2 text-gray-600">{{ old('description') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex space-x-3">
                <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300">
                    Create Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-300 text-center">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const colorInput = document.getElementById('color');
    const colorTextInput = document.getElementById('color_text');
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    
    const colorPreview = document.getElementById('color-preview');
    const namePreview = document.getElementById('name-preview');
    const descriptionPreview = document.getElementById('description-preview');
    
    // Update preview when inputs change
    colorInput.addEventListener('input', function() {
        colorTextInput.value = this.value;
        colorPreview.style.backgroundColor = this.value;
    });
    
    colorTextInput.addEventListener('input', function() {
        if (this.value.match(/^#[0-9A-Fa-f]{6}$/)) {
            colorInput.value = this.value;
            colorPreview.style.backgroundColor = this.value;
        }
    });
    
    nameInput.addEventListener('input', function() {
        namePreview.textContent = this.value || 'Category Name';
    });
    
    descriptionInput.addEventListener('input', function() {
        if (this.value) {
            descriptionPreview.textContent = this.value;
            descriptionPreview.style.display = 'block';
        } else {
            descriptionPreview.style.display = 'none';
        }
    });
});
</script>
@endsection
