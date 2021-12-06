<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        //Crea usuario admin
        $admin = User::create([
            "name"=>"admin",
            'last_name'=>"admin",
            "email"=>"admin@admin.com",
            "password"=>bcrypt("admin"),
        ]);

        $testCommonUser = User::create([
            "name"=>"CommonUser",
            'last_name'=>"CommonUser",
            "email"=>"commonuser@test.com",
            "password"=>bcrypt("test"),
        ]);

        //Crea los Roles
        $adminRole = Role::create([
            "name"=>"admin"
        ]);

        $commonUserRole = Role::create([
            "name"=>"common_user"
        ]);

        //Creando permisos
        $permissionInsertUser = Permission::create(['name'=>'insert user']);
        $permissionUpdateUser = Permission::create(['name'=>'update user']);
        $permissionDeleteUser = Permission::create(['name'=>'delete user']);
        $permissionListUser = Permission::create(['name'=>'list user']);

        //Asignando Permisos a los Roles

        //Admin Role
        $permissionInsertUser->assignRole($adminRole);
        $permissionUpdateUser->assignRole($adminRole);
        $permissionDeleteUser->assignRole($adminRole);
        $permissionListUser->assignRole($adminRole);

        //CommonUser Role
        $permissionListUser->assignRole($commonUserRole);

        //Asignando Roles
        $admin->assignRole("admin");
        $testCommonUser->assignRole("common_user");
    }
}
