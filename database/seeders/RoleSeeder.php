<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Enums\PermissionType;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Super Admin (Full Access)
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(array_map(fn($case) => $case->value, PermissionType::cases()));

        // 2. Pengelola Situs (Staf Teknis / Juru Pelihara)
        $pengelolaSitus = Role::firstOrCreate(['name' => 'pengelola_situs', 'guard_name' => 'web']);
        $pengelolaSitus->syncPermissions([
            PermissionType::MANAGE_HERITAGE_SITES->value,
            PermissionType::MANAGE_SITE_CATEGORIES->value,
            PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value,
            PermissionType::MANAGE_SITE_CONDITION_REPORTS->value,
            PermissionType::MANAGE_REPORTS->value,
        ]);

        // 3. Pimpinan (Kepala Balai)
        $pimpinan = Role::firstOrCreate(['name' => 'pimpinan', 'guard_name' => 'web']);
        // Pimpinan basically can view. If we only have MANAGE_, we give them MANAGE_REPORTS 
        // We'll need to define view access in policies, but for now we sync MANAGE_REPORTS
        $pimpinan->syncPermissions([
            PermissionType::MANAGE_REPORTS->value,
        ]);

        // 4. Pemohon (Masyarakat)
        $pemohon = Role::firstOrCreate(['name' => 'pemohon', 'guard_name' => 'web']);
        // Pemohon can only manage their own requests, which is handled via policy.
        $pemohon->syncPermissions([
            PermissionType::MANAGE_FACILITY_USAGE_REQUESTS->value,
        ]);
    }
}
