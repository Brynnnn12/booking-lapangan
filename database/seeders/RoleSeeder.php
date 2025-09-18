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
        /**
         * membuat role Admin dan User
         */
        $roles = ['Admin', 'User'];

        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::create(['name' => $role]);
        }

        /**
         * membuat user admin
         */
        $admin = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $admin->assignRole('Admin');

        /**
         * membuat user biasa
         */
        $user = \App\Models\User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $user->assignRole('User');
    }
}
