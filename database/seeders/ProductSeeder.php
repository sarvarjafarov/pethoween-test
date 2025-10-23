<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('email', 'admin@example.com')->first();
        $categories = Category::all();

        $products = [
            [
                'name' => 'Premium Leather Jacket',
                'description' => 'High-quality leather jacket perfect for any occasion. Made from genuine leather with excellent craftsmanship.',
                'short_description' => 'Men\'s Collection',
                'price' => 399.99,
                'sale_price' => 299.99,
                'on_sale' => true,
                'featured' => true,
                'stock_quantity' => 50,
                'category_id' => $categories->where('name', 'Technology')->first()?->id,
            ],
            [
                'name' => 'Designer Handbag',
                'description' => 'Elegant designer handbag made from premium materials. Perfect for both casual and formal occasions.',
                'short_description' => 'Women\'s Collection',
                'price' => 199.99,
                'sale_price' => null,
                'on_sale' => false,
                'featured' => true,
                'stock_quantity' => 30,
                'category_id' => $categories->where('name', 'Business')->first()?->id,
            ],
            [
                'name' => 'Classic Sneakers',
                'description' => 'Comfortable and stylish sneakers suitable for everyday wear. Available in multiple colors.',
                'short_description' => 'Unisex Collection',
                'price' => 149.99,
                'sale_price' => null,
                'on_sale' => false,
                'featured' => false,
                'stock_quantity' => 100,
                'category_id' => $categories->where('name', 'Lifestyle')->first()?->id,
            ],
            [
                'name' => 'Elegant Dress',
                'description' => 'Beautiful evening dress perfect for special occasions. Made from high-quality fabric.',
                'short_description' => 'Women\'s Collection',
                'price' => 179.99,
                'sale_price' => null,
                'on_sale' => false,
                'featured' => false,
                'stock_quantity' => 25,
                'category_id' => $categories->where('name', 'Business')->first()?->id,
            ],
            [
                'name' => 'Casual T-Shirt',
                'description' => 'Comfortable cotton t-shirt perfect for casual wear. Available in various sizes and colors.',
                'short_description' => 'Men\'s Collection',
                'price' => 39.99,
                'sale_price' => 29.99,
                'on_sale' => true,
                'featured' => false,
                'stock_quantity' => 75,
                'category_id' => $categories->where('name', 'Lifestyle')->first()?->id,
            ],
            [
                'name' => 'Luxury Watch',
                'description' => 'Premium wristwatch with automatic movement. Perfect for business and formal occasions.',
                'short_description' => 'Accessories',
                'price' => 599.99,
                'sale_price' => null,
                'on_sale' => false,
                'featured' => true,
                'stock_quantity' => 15,
                'category_id' => $categories->where('name', 'Technology')->first()?->id,
            ],
            [
                'name' => 'Denim Jeans',
                'description' => 'Classic denim jeans made from high-quality denim. Perfect fit and comfort guaranteed.',
                'short_description' => 'Men\'s Collection',
                'price' => 89.99,
                'sale_price' => null,
                'on_sale' => false,
                'featured' => false,
                'stock_quantity' => 60,
                'category_id' => $categories->where('name', 'Lifestyle')->first()?->id,
            ],
            [
                'name' => 'Summer Blouse',
                'description' => 'Light and airy blouse perfect for summer weather. Made from breathable fabric.',
                'short_description' => 'Women\'s Collection',
                'price' => 49.99,
                'sale_price' => null,
                'on_sale' => false,
                'featured' => false,
                'stock_quantity' => 40,
                'category_id' => $categories->where('name', 'Health')->first()?->id,
            ],
        ];

        foreach ($products as $productData) {
            Product::create(array_merge($productData, [
                'user_id' => $adminUser->id,
            ]));
        }
    }
}
