@extends('layouts.admin')

@section('title', 'Menu Item Details: ' . $menu->name)

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Menu Item Details: {{ $menu->name }}</h1>
        <a href="{{ route('admin.menus.edit', $menu) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Edit Menu Item</a>
    </div>
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="text-sm text-gray-900">{{ $menu->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">URL</dt>
                        <dd class="text-sm text-gray-900">{{ $menu->url ?: 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Icon</dt>
                        <dd class="text-sm text-gray-900">{{ $menu->icon ?: 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Parent Menu</dt>
                        <dd class="text-sm text-gray-900">{{ $menu->parent ? $menu->parent->name : 'Root Level' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Sort Order</dt>
                        <dd class="text-sm text-gray-900">{{ $menu->sort_order }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Target</dt>
                        <dd class="text-sm text-gray-900">{{ $menu->target }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $menu->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $menu->is_active ? 'Active' : 'Inactive' }}
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
                        <dd class="text-sm text-gray-900">{{ $menu->created_at->format('M d, Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Updated At</dt>
                        <dd class="text-sm text-gray-900">{{ $menu->updated_at->format('M d, Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        
        @if($menu->children->count() > 0)
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Child Menu Items</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <ul class="space-y-2">
                        @foreach($menu->children as $child)
                            <li class="flex items-center justify-between py-2 px-3 bg-white rounded border">
                                <span class="text-sm text-gray-900">{{ $child->name }}</span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.menus.show', $child) }}" class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                                    <a href="{{ route('admin.menus.edit', $child) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">Edit</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
