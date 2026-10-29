<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cache permission Spatie
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat daftar Role
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);
        $authorRole = Role::create(['name' => 'author']);
        $subscriberRole = Role::create(['name' => 'subscriber']);

        // 2. Buat akun dummy Admin untuk pengetesan
        $admin = User::factory()->create([
            'name' => 'Admin Blog',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Pasangkan role admin ke user tersebut
        $admin->assignRole($adminRole);
    }
}
