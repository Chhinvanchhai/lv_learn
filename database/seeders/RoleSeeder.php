<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Admin', 'guard_name' => 'web'],
            ['name' => 'Standard', 'guard_name' => 'web'],
            ['name' => 'User', 'guard_name' => 'web'],
        ];

        Role::upsert($roles, ['name']);
    }
}
