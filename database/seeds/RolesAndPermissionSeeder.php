<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit webspace']);
        Permission::create(['name' => 'delete webspace']);
        Permission::create(['name' => 'add webspace']);

        Permission::create(['name' => 'edit owner']);
        Permission::create(['name' => 'delete owner']);
        Permission::create(['name' => 'add owner']);

        Permission::create(['name' => 'edit department']);
        Permission::create(['name' => 'delete department']);
        Permission::create(['name' => 'add department']);

        Permission::create(['name' => 'edit designation']);
        Permission::create(['name' => 'delete designation']);
        Permission::create(['name' => 'add designation']);

        Permission::create(['name' => 'edit platform']);
        Permission::create(['name' => 'delete platform']);
        Permission::create(['name' => 'add platform']);

        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'add user']);

        Permission::create(['name' => 'export webspace']);
        Permission::create(['name' => 'edit configuration']);
        Permission::create(['name' => 'view objects']); 

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'editor'])
            ->givePermissionTo(['edit webspace','edit owner','edit department',
                            'edit designation','edit platform','edit user','export webspace'
        ]);

        // or may be done by chaining
        $role = Role::create(['name' => 'subscriber'])
            ->givePermissionTo(['export webspace']);
        
        $role = Role::create(['name' => 'subscriber'])
            ->givePermissionTo(['export webspace']);

        $role = Role::create(['name' => 'super-admin'])
            ->givePermissionTo(Permission::all());
    }
}
