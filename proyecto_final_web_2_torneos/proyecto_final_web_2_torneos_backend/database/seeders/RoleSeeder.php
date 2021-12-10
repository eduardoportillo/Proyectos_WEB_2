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

        $test1 = User::create([
            "name"=>"Test1",
            'last_name'=>"CommonUser",
            "email"=>"test1@test.com",
            "password"=>bcrypt("test"),
        ]);
        $test2 = User::create([
            "name"=>"Test2",
            'last_name'=>"CommonUser",
            "email"=>"test2@test.com",
            "password"=>bcrypt("test"),
        ]);
        $test3 = User::create([
            "name"=>"Test3",
            'last_name'=>"CommonUser",
            "email"=>"test3@test.com",
            "password"=>bcrypt("test"),
        ]);
        $test4 = User::create([
            "name"=>"Test4",
            'last_name'=>"CommonUser",
            "email"=>"test4@test.com",
            "password"=>bcrypt("test"),
        ]);
        $test5 = User::create([
            "name"=>"Test5",
            'last_name'=>"CommonUser",
            "email"=>"test5@test.com",
            "password"=>bcrypt("test"),
        ]);
        $test6 = User::create([
            "name"=>"Test6",
            'last_name'=>"CommonUser",
            "email"=>"test6@test.com",
            "password"=>bcrypt("test"),
        ]);
        $test7 = User::create([
            "name"=>"Test7",
            'last_name'=>"CommonUser",
            "email"=>"test7@test.com",
            "password"=>bcrypt("test"),
        ]);
        $test8 = User::create([
            "name"=>"Test8",
            'last_name'=>"CommonUser",
            "email"=>"test8@test.com",
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

        $permissionListMisTorneo =   Permission::create(['name'=>'acceso torneo MT&TO']);
        $permissionIniciarTorneo = Permission::create(['name'=>'iniciar torneo']);

        //Creando permisos Equipo
        $permissionListEquipo =   Permission::create(['name'=>'list equipo']);
        $permissionInsertEquipo = Permission::create(['name'=>'insert equipo']);
        $permissionUpdateEquipo = Permission::create(['name'=>'update equipo']);
        $permissionDeleteEquipo = Permission::create(['name'=>'delete equipo']);

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

        $permissionIniciarTorneo->assignRole($adminRole);

        $permissionListEquipo->assignRole($adminRole);
        $permissionInsertEquipo->assignRole($adminRole);
        $permissionUpdateEquipo->assignRole($adminRole);
        $permissionDeleteEquipo->assignRole($adminRole);

        $permissionListMisTorneo->assignRole($adminRole);
        //CommonUser Role
        //Torneos
        $permissionListUser->assignRole($commonUserRole);
        $permissionInsertTorneo->assignRole($commonUserRole);
        $permissionUpdateTorneo->assignRole($commonUserRole);

        $permissionListMisTorneo->assignRole($commonUserRole);

        $permissionListTorneo->assignRole($commonUserRole);
        $permissionIniciarTorneo->assignRole($commonUserRole);

        $permissionListEquipo->assignRole($commonUserRole);
        $permissionInsertEquipo->assignRole($commonUserRole);
        $permissionUpdateEquipo->assignRole($commonUserRole);
        $permissionDeleteEquipo->assignRole($commonUserRole);

        $permissionListMisTorneo->assignRole($commonUserRole);

        //Asignando Roles a los Usuarios Creador por Default
        $admin->assignRole("admin");
        $test1->assignRole("common_user");
        $test2->assignRole("common_user");
        $test3->assignRole("common_user");
        $test4->assignRole("common_user");
        $test5->assignRole("common_user");
        $test6->assignRole("common_user");
        $test7->assignRole("common_user");
        $test8->assignRole("common_user");
    }
}
