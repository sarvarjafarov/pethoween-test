<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Menu;
use App\Models\ContentBlock;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Site Settings
        Setting::set('site_name', 'Dealers', 'text', 'general', 'Site name');
        Setting::set('site_tagline', 'Your Premium Fashion Destination', 'text', 'general', 'Site tagline');
        Setting::set('site_description', 'Discover our complete range of premium fashion items', 'textarea', 'seo', 'Site description');
        Setting::set('site_keywords', 'fashion, clothing, premium, style, deals', 'text', 'seo', 'Site keywords');
        Setting::set('site_logo', '', 'image', 'header', 'Site logo');
        Setting::set('site_favicon', '', 'image', 'general', 'Site favicon');
        
        // Header Settings
        Setting::set('header_phone', '+1 (555) 123-4567', 'text', 'header', 'Header phone number');
        Setting::set('header_email', 'info@dealers.com', 'text', 'header', 'Header email');
        Setting::set('header_welcome_text', 'Welcome to our store!', 'text', 'header', 'Welcome message');
        Setting::set('header_shipping_text', 'Free shipping on orders over $50', 'text', 'header', 'Shipping message');
        
        // Footer Settings
        Setting::set('footer_about_title', 'About Us', 'text', 'footer', 'Footer about title');
        Setting::set('footer_about_text', 'We are a premium fashion destination offering the latest trends and timeless classics.', 'textarea', 'footer', 'Footer about text');
        Setting::set('footer_quick_links_title', 'Quick Links', 'text', 'footer', 'Footer quick links title');
        Setting::set('footer_more_title', 'More', 'text', 'footer', 'Footer more title');
        Setting::set('footer_contact_title', 'Contact Info', 'text', 'footer', 'Footer contact title');
        Setting::set('footer_address', '123 Fashion Street, Style City, SC 12345', 'textarea', 'footer', 'Footer address');
        Setting::set('footer_phone', '+1 (555) 123-4567', 'text', 'footer', 'Footer phone');
        Setting::set('footer_email', 'info@dealers.com', 'text', 'footer', 'Footer email');
        Setting::set('footer_copyright', '© 2024 Dealers. All rights reserved.', 'text', 'footer', 'Footer copyright');
        
        // Social Media
        Setting::set('social_facebook', 'https://facebook.com/dealers', 'text', 'social', 'Facebook URL');
        Setting::set('social_twitter', 'https://twitter.com/dealers', 'text', 'social', 'Twitter URL');
        Setting::set('social_instagram', 'https://instagram.com/dealers', 'text', 'social', 'Instagram URL');
        Setting::set('social_pinterest', 'https://pinterest.com/dealers', 'text', 'social', 'Pinterest URL');
        
        // Hero Section
        Setting::set('hero_title', 'Madewell', 'text', 'hero', 'Hero title');
        Setting::set('hero_subtitle', 'Summer Collection', 'text', 'hero', 'Hero subtitle');
        Setting::set('hero_price', '$1,499', 'text', 'hero', 'Hero price');
        Setting::set('hero_original_price', '$1,999', 'text', 'hero', 'Hero original price');
        Setting::set('hero_button_text', 'Shop Now', 'text', 'hero', 'Hero button text');
        Setting::set('hero_image', '', 'image', 'hero', 'Hero image');
        
        // Navigation Menu
        $homeMenu = Menu::create([
            'name' => 'Home',
            'url' => '/',
            'sort_order' => 1,
        ]);
        
        $collectionMenu = Menu::create([
            'name' => 'Collection',
            'url' => '#',
            'sort_order' => 2,
        ]);
        
        // Collection submenu
        Menu::create([
            'name' => 'Men',
            'url' => '/collection/men',
            'parent_id' => $collectionMenu->id,
            'sort_order' => 1,
        ]);
        
        Menu::create([
            'name' => 'Women',
            'url' => '/collection/women',
            'parent_id' => $collectionMenu->id,
            'sort_order' => 2,
        ]);
        
        Menu::create([
            'name' => 'Children',
            'url' => '/collection/children',
            'parent_id' => $collectionMenu->id,
            'sort_order' => 3,
        ]);
        
        Menu::create([
            'name' => 'Shop',
            'url' => '/shop',
            'sort_order' => 3,
        ]);
        
        Menu::create([
            'name' => 'Catalogs',
            'url' => '/catalogs',
            'sort_order' => 4,
        ]);
        
        Menu::create([
            'name' => 'Contact',
            'url' => '/contact',
            'sort_order' => 5,
        ]);
        
        // Content Blocks
        ContentBlock::create([
            'name' => 'Header Top Bar',
            'type' => 'header',
            'location' => 'top',
            'content' => '<div class="bg-gray-800 text-white py-2">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center text-sm">
                        <div class="flex items-center space-x-4">
                            <span>{{ setting("header_welcome_text") }}</span>
                            <span>{{ setting("header_shipping_text") }}</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span>{{ setting("header_phone") }}</span>
                            <span>{{ setting("header_email") }}</span>
                        </div>
                    </div>
                </div>
            </div>',
            'settings' => ['show_phone' => true, 'show_email' => true],
        ]);
        
        ContentBlock::create([
            'name' => 'Footer About',
            'type' => 'footer',
            'location' => 'about',
            'content' => '<div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900">{{ setting("footer_about_title") }}</h3>
                <p class="text-gray-600">{{ setting("footer_about_text") }}</p>
                <button class="bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">
                    Subscribe
                </button>
            </div>',
        ]);
        
        ContentBlock::create([
            'name' => 'Footer Quick Links',
            'type' => 'footer',
            'location' => 'quick_links',
            'content' => '<div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900">{{ setting("footer_quick_links_title") }}</h3>
                <ul class="space-y-2">
                    <li><a href="/" class="text-gray-600 hover:text-gray-900">Home</a></li>
                    <li><a href="/shop" class="text-gray-600 hover:text-gray-900">Shop</a></li>
                    <li><a href="/about" class="text-gray-600 hover:text-gray-900">About</a></li>
                    <li><a href="/contact" class="text-gray-600 hover:text-gray-900">Contact</a></li>
                </ul>
            </div>',
        ]);
        
        ContentBlock::create([
            'name' => 'Footer Contact',
            'type' => 'footer',
            'location' => 'contact',
            'content' => '<div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900">{{ setting("footer_contact_title") }}</h3>
                <div class="space-y-2 text-gray-600">
                    <p>{{ setting("footer_address") }}</p>
                    <p>{{ setting("footer_phone") }}</p>
                    <p>{{ setting("footer_email") }}</p>
                </div>
            </div>',
        ]);
    }
}
