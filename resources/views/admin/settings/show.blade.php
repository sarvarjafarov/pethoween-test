@extends('layouts.admin')

@section('title', 'Setting Details: ' . $setting->key)

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Setting Details: {{ $setting->key }}</h1>
        <a href="{{ route('admin.settings.edit', $setting) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Edit Setting</a>
    </div>
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Key</dt>
                        <dd class="text-sm text-gray-900">{{ $setting->key }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Type</dt>
                        <dd class="text-sm text-gray-900">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ ucfirst($setting->type) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Group</dt>
                        <dd class="text-sm text-gray-900">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ ucfirst($setting->group) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                        <dd class="text-sm text-gray-900">{{ $setting->description ?: 'N/A' }}</dd>
                    </div>
                </dl>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Value</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    @if($setting->type === 'image' && $setting->value)
                        <div class="mb-4">
                            <img src="{{ Storage::url($setting->value) }}" alt="{{ $setting->key }}" class="w-full max-w-md h-auto rounded">
                        </div>
                        <p class="text-sm text-gray-600">Image Path: {{ $setting->value }}</p>
                    @elseif($setting->type === 'boolean')
                        <span class="px-3 py-1 rounded-full text-sm font-medium {{ $setting->value ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $setting->value ? 'True' : 'False' }}
                        </span>
                    @elseif($setting->type === 'json')
                        <pre class="text-sm text-gray-900 bg-white p-3 rounded border overflow-x-auto">{{ json_encode(json_decode($setting->value), JSON_PRETTY_PRINT) }}</pre>
                    @else
                        <p class="text-sm text-gray-900 break-words">{{ $setting->value ?: 'No value set' }}</p>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Timestamps</h3>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Created At</dt>
                    <dd class="text-sm text-gray-900">{{ $setting->created_at->format('M d, Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Updated At</dt>
                    <dd class="text-sm text-gray-900">{{ $setting->updated_at->format('M d, Y H:i') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection
