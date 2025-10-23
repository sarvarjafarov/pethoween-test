<?php

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return \App\Models\Setting::get($key, $default);
    }
}

if (!function_exists('menu')) {
    function menu($location = null)
    {
        $query = \App\Models\Menu::active()->root()->ordered();
        
        if ($location) {
            $query->where('location', $location);
        }
        
        return $query->with('children')->get();
    }
}

if (!function_exists('content_block')) {
    function content_block($type, $location = null)
    {
        $query = \App\Models\ContentBlock::active()->byType($type);
        
        if ($location) {
            $query->byLocation($location);
        }
        
        return $query->ordered()->get();
    }
}
