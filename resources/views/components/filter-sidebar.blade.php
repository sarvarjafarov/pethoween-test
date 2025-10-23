@props(['categories' => [], 'priceRange' => [0, 1000]])

<div class="bg-white rounded-2xl shadow-lg p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Filters</h3>
    
    <!-- Categories -->
    <div class="mb-8">
        <h4 class="text-sm font-medium text-gray-900 mb-4">Categories</h4>
        <div class="space-y-3">
            <label class="flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-gray-900 focus:ring-gray-900">
                <span class="ml-3 text-sm text-gray-700">All Categories</span>
            </label>
            @foreach($categories as $category)
                <label class="flex items-center">
                    <input type="checkbox" class="rounded border-gray-300 text-gray-900 focus:ring-gray-900">
                    <span class="ml-3 text-sm text-gray-700">{{ $category->name }}</span>
                    <span class="ml-auto text-xs text-gray-500">({{ $category->products_count }})</span>
                </label>
            @endforeach
        </div>
    </div>
    
    <!-- Price Range -->
    <div class="mb-8">
        <h4 class="text-sm font-medium text-gray-900 mb-4">Price Range</h4>
        <div class="space-y-4">
            <div class="flex items-center space-x-4">
                <input type="number" placeholder="Min" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900" value="{{ $priceRange[0] }}">
                <span class="text-gray-500">to</span>
                <input type="number" placeholder="Max" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900" value="{{ $priceRange[1] }}">
            </div>
            <div class="relative">
                <input type="range" min="{{ $priceRange[0] }}" max="{{ $priceRange[1] }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
            </div>
        </div>
    </div>
    
    <!-- Size -->
    <div class="mb-8">
        <h4 class="text-sm font-medium text-gray-900 mb-4">Size</h4>
        <div class="grid grid-cols-3 gap-2">
            @foreach(['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                <button class="px-3 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900">
                    {{ $size }}
                </button>
            @endforeach
        </div>
    </div>
    
    <!-- Color -->
    <div class="mb-8">
        <h4 class="text-sm font-medium text-gray-900 mb-4">Color</h4>
        <div class="flex flex-wrap gap-2">
            @foreach(['Black', 'White', 'Red', 'Blue', 'Green', 'Yellow', 'Purple', 'Pink'] as $color)
                <button class="w-8 h-8 rounded-full border-2 border-gray-300 hover:border-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900" 
                        style="background-color: {{ strtolower($color) === 'black' ? '#000000' : (strtolower($color) === 'white' ? '#ffffff' : '#' . substr(md5($color), 0, 6)) }}"
                        title="{{ $color }}">
                </button>
            @endforeach
        </div>
    </div>
    
    <!-- Clear Filters -->
    <button class="w-full bg-gray-100 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-200 transition duration-300">
        Clear All Filters
    </button>
</div>
