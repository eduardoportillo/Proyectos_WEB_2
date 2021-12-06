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

        //Permisos
        //Creando permisos User
        $permissionListUser =   Permission::create(['name'=>'list user']);
        $permissionInsertUser = Permission::create(['name'=>'insert user']);
        $permissionUpdateUser = Permission::create(['name'=>'update user']);
        $permissionDeleteUser = Permission::create(['name'=>'delete user']);

        //Creando permisos Torneo
        $permissionListTorneo =   Permission::create(['name'=>'list torneo']);
        $permissionInsertTorneo = Permission::create(['name'=>'insert torneo']);
        $permissionUpdateTorneo = Permission::create(['name'=>'update torneo']);
        $permissionDeleteTorneo = Permission::create(['name'=>'delete torneo']);

        //Asignando Permisos a los Roles
        //Admin Role
        $permissionListUser->assignRole($adminRole);
        $permissionInsertUser->assignRole($adminRole);
        $permissionUpdateUser->assignRole($adminRole);
        $permissionDeleteUser->assignRole($adminRole);


        $permissionListTorneo->assignRole($adminRole);
        $permissionInsertTorneo->assignRole($adminRole);
        $permissionUpdateTorneo->assignRole($adminRole);
        $permissionDeleteTorneo->assignRole($adminRole);

        //CommonUser Role
        $permissionListUser->assignRole($commonUserRole);

        $permissionListTorneo->assignRole($commonUserRole);
        $permissionInsertTorneo->assignRole($commonUserRole);

        //Asignando Roles a los Usuarios Creador por Default
        $admin->assignRole("admin");
        $testCommonUser->assignRole("common_user");
    }
}
