<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin',
            'password' => 'password',
        ]);
        \App\Models\User::factory(1000)->create();
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class
        ]);
    }
}
