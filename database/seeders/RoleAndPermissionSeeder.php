<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::firstOrCreate(['name' => 'create surat-keluar']);
        Permission::firstOrCreate(['name' => 'create arsip-surat']);
        Permission::firstOrCreate(['name' => 'delete surat-keluar']);
        Permission::firstOrCreate(['name' => 'delete arsip-surat']);
        Permission::firstOrCreate(['name' => 'manage karyawan']);

        // create roles and assign created permissions
        $role = Role::firstOrCreate(['name' => 'karyawan'])
            ->givePermissionTo(['create surat-keluar', 'create arsip-surat']);

        $role = Role::firstOrCreate(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        // assign roles to users
        $user = User::find(1);
        if ($user) {
            $user->assignRole('admin');
        }
    }
}
