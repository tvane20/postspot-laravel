<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Crée les permissions si elles n'existent pas
        $permissions = [
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crée les rôles et assigne les permissions
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->givePermissionTo($permissions);

        $auteurRole = Role::firstOrCreate(['name' => 'Auteur']);
        $auteurRole->givePermissionTo(['create posts', 'edit posts']);
        
        // Ajoute le rôle Visiteur sans permissions
        Role::firstOrCreate(['name' => 'Visiteur']);
    }
}
