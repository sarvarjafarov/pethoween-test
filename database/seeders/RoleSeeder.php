<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrator',
                'slug' => 'admin',
                'description' => 'Full access to all features',
            ],
            [
                'name' => 'Editor',
                'slug' => 'editor',
                'description' => 'Can manage content and media',
            ],
            [
                'name' => 'Author',
                'slug' => 'author',
                'description' => 'Can create and edit own content',
            ],
            [
                'name' => 'Subscriber',
                'slug' => 'subscriber',
                'description' => 'Basic user access',
            ],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }
    }
}
