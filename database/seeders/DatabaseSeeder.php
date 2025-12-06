<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Insert categories
        DB::table('categories')->insert([
            ['name' => 'News', 'slug' => 'news', 'description' => 'Latest news and current events'],
            ['name' => 'Opinion', 'slug' => 'opinion', 'description' => 'Opinion pieces and editorials'],
            ['name' => 'DevCom', 'slug' => 'devcom', 'description' => 'Development communication articles'],
            ['name' => 'Feature', 'slug' => 'feature', 'description' => 'Feature stories and in-depth articles'],
            ['name' => 'Literary', 'slug' => 'literary', 'description' => 'Literary works and creative writing'],
            ['name' => 'Sci&Tech', 'slug' => 'scitech', 'description' => 'Science and technology news'],
            ['name' => 'Sports', 'slug' => 'sports', 'description' => 'Sports news and updates'],
            ['name' => 'Telesiklab', 'slug' => 'telesiklab', 'description' => 'Telesiklab content and updates'],
        ]);

        // Insert default admin user
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@cspc.edu.ph',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}
