<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userAdmin = User::create([
        	'name' => 'Hardik Savani', 
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('0'),
            'email_verified_at' => now()
        ]);
        $userEditor = User::create([
            "name"  => "John DOE",
            "email" => "editor@gmail.com",
            "password" =>bcrypt("0"),
            'email_verified_at' => now()
        ]);

        $roleAdmin = Role::create(['name' => 'Admin']);
        $permissionsAdmin = Permission::pluck('id','id')->all();
        $roleAdmin->syncPermissions($permissionsAdmin);
        $userAdmin->assignRole([$roleAdmin->id]);

        $roleEditor = Role::create(["name" => "Editor"]);

        $perms = [];

        $permissions = Permission::pluck("id","id")->all();

        foreach ($permissions as $permission){
            if(strpos($permission,"edit") ||
                strpos($permission,"show") ||
                strpos($permission,"list")){

                $perms[] = $permission ;
            }
        }

        $roleEditor->syncPermissions($perms);

        $userEditor->assignRole([$roleEditor->id]);
    }
}