<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         //Permission list
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.show']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.destroy']);

        //SuperAdmin
        $superAdmin = Role::create(['name' => 'SuperAdmin']);

        $superAdmin->givePermissionTo(Permission::all());

        //Admin
        $admin = Role::create(['name' => 'Admin']);

        $admin->givePermissionTo([
            'users.create',
            'users.index',
            'users.show'
        ]);

        //Admin
        $guest = Role::create(['name' => 'Guest']);

        $guest->givePermissionTo([
            'users.index',
            'users.show'
        ]);

        //User Super Admin
        $superAdmin = User::find(1);
        $superAdmin->assignRole('SuperAdmin');

        //User Admin
        $admin = User::find(2);
        $admin->assignRole('Admin');
    }
}
