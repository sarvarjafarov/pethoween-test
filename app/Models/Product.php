<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'sale_price',
        'sku',
        'stock_quantity',
        'in_stock',
        'featured',
        'on_sale',
        'status',
        'image',
        'gallery',
        'category_id',
        'user_id',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'on_sale' => 'boolean',
        'in_stock' => 'boolean',
        'gallery' => 'array',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeOnSale($query)
    {
        return $query->where('on_sale', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('in_stock', true);
    }

    public function getCurrentPriceAttribute()
    {
        return $this->on_sale && $this->sale_price ? $this->sale_price : $this->price;
    }

    public function getOriginalPriceAttribute()
    {
        return $this->on_sale && $this->sale_price ? $this->price : null;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->on_sale && $this->sale_price && $this->price > $this->sale_price) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
            if (empty($product->sku)) {
                $product->sku = 'PRD-' . strtoupper(Str::random(8));
            }
        });
    }
}
