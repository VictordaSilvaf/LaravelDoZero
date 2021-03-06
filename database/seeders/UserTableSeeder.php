<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'user']);
        Permission::create(['name' => 'admin']);

        $role1 = Role::create(['name' => 'user']);
        $role2 = Role::create(['name' => 'admin']);

        $user = User::create([
            'name' => 'Victor Vendedor',
            'email' => 'victor.vendedor@gmail.com',
            'password' => bcrypt('password'),
        ])->givePermissionTo('user');
        $user->assignRole($role1);

        $user = User::create([
            'name' => 'Thiago Vendedor',
            'email' => 'thiago.vendedor@gmail.com',
            'password' => bcrypt('password'),
        ])->givePermissionTo('user');
        $user->assignRole($role1);

        $user = User::create([
            'name' => 'Robson Vendedor',
            'email' => 'robson.vendedor@gmail.com',
            'password' => bcrypt('password'),
        ])->givePermissionTo('user');
        $user->assignRole($role1);

        $user = User::create([
            'name' => 'Victor Admin',
            'email' => 'victor.admin@gmail.com',
            'password' => bcrypt('padmin123'),
        ])->givePermissionTo('admin');
        $user->assignRole($role2);

        $user = User::create([
            'name' => 'Thiago Admin',
            'email' => 'thiago.admin@gmail.com',
            'password' => bcrypt('padmin123'),
        ])->givePermissionTo('admin');
        $user->assignRole($role2);

        $user = User::create([
            'name' => 'Robson Admin',
            'email' => 'robson.admin@gmail.com',
            'password' => bcrypt('padmin123'),
        ])->givePermissionTo('admin');
        $user->assignRole($role2);

        /*
        *  Usuarios Padr??es 
        */

        $user = User::create([
            'name' => 'Eduarda Vendedor',
            'email' => 'eduarda.vendedor@gmail.com',
            'password' => bcrypt('password'),
        ])->givePermissionTo('user');
        $user->assignRole($role1);

        $user = User::create([
            'name' => 'Anderson Vendedor',
            'email' => 'anderson.vendedor@gmail.com',
            'password' => bcrypt('password'),
        ])->givePermissionTo('user');
        $user->assignRole($role1);
    }
}
