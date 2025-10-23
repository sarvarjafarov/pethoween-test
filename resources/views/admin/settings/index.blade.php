@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Settings</h1>
        <a href="{{ route('admin.settings.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Add New Setting</a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @foreach($settings as $group => $groupSettings)
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 capitalize">{{ $group }} Settings</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($groupSettings as $setting)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-gray-900">{{ $setting->key }}</h3>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.settings.edit', $setting) }}" class="text-blue-600 hover:text-blue-900 text-sm">Edit</a>
                                    <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this setting?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">{{ $setting->description }}</p>
                            <div class="text-sm">
                                <span class="font-medium">Type:</span> {{ $setting->type }}
                            </div>
                            <div class="text-sm mt-1">
                                <span class="font-medium">Value:</span> 
                                @if($setting->type === 'image' && $setting->value)
                                    <img src="{{ Storage::url($setting->value) }}" alt="{{ $setting->key }}" class="w-16 h-16 object-cover rounded mt-1">
                                @else
                                    {{ Str::limit($setting->value, 50) }}
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
