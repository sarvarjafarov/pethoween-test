<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'url',
        'icon',
        'parent_id',
        'sort_order',
        'is_active',
        'target',
        'attributes',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'attributes' => 'array',
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($menu) {
            if (empty($menu->slug)) {
                $menu->slug = Str::slug($menu->name);
            }
        });
    }
}
