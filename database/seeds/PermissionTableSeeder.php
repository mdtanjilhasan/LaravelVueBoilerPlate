<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            //User Permission

             [
                 'name' => 'user-read',
                 'display_name' => 'Display User List',
                 'description' => 'See only Listing Of User'
             ],
             [
                 'name' => 'user-show',
                 'display_name' => 'Display User menu',
                 'description' => 'See only who has permission'
             ],
             [
                 'name' => 'single-user-show',
                 'display_name' => 'Display single User',
                 'description' => 'See specific role'
             ],
             [
                 'name' => 'user-create',
                 'display_name' => 'Create User',
                 'description' => 'Create New User'
             ],
             [
                 'name' => 'user-edit',
                 'display_name' => 'Edit User',
                 'description' => 'Edit User'
             ],
             [
                 'name' => 'user-delete',
                 'display_name' => 'Delete User',
                 'description' => 'Delete User'
             ],

            // Role Permission

             [
                 'name' => 'role-read',
                 'display_name' => 'Display Role List',
                 'description' => 'See only Listing Of Role'
             ],
             [
                 'name' => 'role-show',
                 'display_name' => 'Display Role menu',
                 'description' => 'See only who has permission'
             ],
             [
                 'name' => 'single-role-show',
                 'display_name' => 'Display single Role',
                 'description' => 'See specific role'
             ],
             [
                 'name' => 'role-create',
                 'display_name' => 'Create Role',
                 'description' => 'Create New Role'
             ],
             [
                 'name' => 'role-edit',
                 'display_name' => 'Edit Role',
                 'description' => 'Edit Role'
             ],
             [
                 'name' => 'role-delete',
                 'display_name' => 'Delete Role',
                 'description' => 'Delete Role'
             ],
        ];

        foreach ($permissions as $key=>$value){
            Permission::create($value);
        }
    }
}
