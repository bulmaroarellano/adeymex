<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list remitentes']);
        Permission::create(['name' => 'view remitentes']);
        Permission::create(['name' => 'create remitentes']);
        Permission::create(['name' => 'update remitentes']);
        Permission::create(['name' => 'delete remitentes']);

        Permission::create(['name' => 'list destinatarios']);
        Permission::create(['name' => 'view destinatarios']);
        Permission::create(['name' => 'create destinatarios']);
        Permission::create(['name' => 'update destinatarios']);
        Permission::create(['name' => 'delete destinatarios']);

        Permission::create(['name' => 'list sucursales']);
        Permission::create(['name' => 'view sucursales']);
        Permission::create(['name' => 'create sucursales']);
        Permission::create(['name' => 'update sucursales']);
        Permission::create(['name' => 'delete sucursales']);

        Permission::create(['name' => 'list suministros']);
        Permission::create(['name' => 'view suministros']);
        Permission::create(['name' => 'create suministros']);
        Permission::create(['name' => 'update suministros']);
        Permission::create(['name' => 'delete suministros']);

        Permission::create(['name' => 'list empresas']);
        Permission::create(['name' => 'view empresas']);
        Permission::create(['name' => 'create empresas']);
        Permission::create(['name' => 'update empresas']);
        Permission::create(['name' => 'delete empresas']);

        Permission::create(['name' => 'list mercancias']);
        Permission::create(['name' => 'view mercancias']);
        Permission::create(['name' => 'create mercancias']);
        Permission::create(['name' => 'update mercancias']);
        Permission::create(['name' => 'delete mercancias']);

        Permission::create(['name' => 'list unidades']);
        Permission::create(['name' => 'view unidades']);
        Permission::create(['name' => 'create unidades']);
        Permission::create(['name' => 'update unidades']);
        Permission::create(['name' => 'delete unidades']);

        Permission::create(['name' => 'list monedas']);
        Permission::create(['name' => 'view monedas']);
        Permission::create(['name' => 'create monedas']);
        Permission::create(['name' => 'update monedas']);
        Permission::create(['name' => 'delete monedas']);

        Permission::create(['name' => 'list tipoclientes']);
        Permission::create(['name' => 'view tipoclientes']);
        Permission::create(['name' => 'create tipoclientes']);
        Permission::create(['name' => 'update tipoclientes']);
        Permission::create(['name' => 'delete tipoclientes']);

        Permission::create(['name' => 'list codigopostales']);
        Permission::create(['name' => 'view codigopostales']);
        Permission::create(['name' => 'create codigopostales']);
        Permission::create(['name' => 'update codigopostales']);
        Permission::create(['name' => 'delete codigopostales']);

        Permission::create(['name' => 'list encargados']);
        Permission::create(['name' => 'view encargados']);
        Permission::create(['name' => 'create encargados']);
        Permission::create(['name' => 'update encargados']);
        Permission::create(['name' => 'delete encargados']);

        Permission::create(['name' => 'list clientes']);
        Permission::create(['name' => 'view clientes']);
        Permission::create(['name' => 'create clientes']);
        Permission::create(['name' => 'update clientes']);
        Permission::create(['name' => 'delete clientes']);

        Permission::create(['name' => 'list paises']);
        Permission::create(['name' => 'view paises']);
        Permission::create(['name' => 'create paises']);
        Permission::create(['name' => 'update paises']);
        Permission::create(['name' => 'delete paises']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
