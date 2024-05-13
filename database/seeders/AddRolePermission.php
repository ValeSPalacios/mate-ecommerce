<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AddRolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Permission::create(['name'=>'users.index']);
        // Permission::create(['name'=>'users.edit']);
        // Permission::create(['name'=>'users.show']);
        // Permission::create(['name'=>'users.create']);
        // Permission::create(['name'=>'users.destroy']);

        // Permission::create(['name'=>'products.index']);
        // Permission::create(['name'=>'products.edit']);
        // Permission::create(['name'=>'products.show']);
        // Permission::create(['name'=>'products.create']);
        // Permission::create(['name'=>'products.destroy']);
        Permission::create(['name'=>'admin.index']);

        $rolAdmin=Role::create(['name'=>'Admin']);
        Role::create(['name'=>'Client']);

        $rolAdmin->givePermissionTo([
            'admin.index'
        ]);
        $user=User::create([
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('0123456789')
        ]);
        $user->assignRole('Admin');

    }
}
