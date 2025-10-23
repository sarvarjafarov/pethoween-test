<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            ProductSeeder::class,
        ]);

        // Create admin user
        $adminRole = \App\Models\Role::where('slug', 'admin')->first();
        
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role_id' => $adminRole->id,
        ]);

        // Create editor user
        $editorRole = \App\Models\Role::where('slug', 'editor')->first();
        
        User::factory()->create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'role_id' => $editorRole->id,
        ]);
    }
}
