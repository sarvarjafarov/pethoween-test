<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContentBlock extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'location',
        'content',
        'settings',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByLocation($query, $location)
    {
        return $query->where('location', $location);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($block) {
            if (empty($block->slug)) {
                $block->slug = Str::slug($block->name);
            }
        });
    }
}
