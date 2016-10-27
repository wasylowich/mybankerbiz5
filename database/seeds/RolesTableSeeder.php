<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('role_has_permissions')->delete();
        DB::table('roles')->delete();

        $roleHasPermissions = array(
            // depositor
            array('permission_id' => 5, 'role_id' => 1), // manage-postal-codes

            // bidder
            array('permission_id' => 5, 'role_id' => 2), // manage-postal-codes

            // admin
            array('permission_id' => 1, 'role_id' => 3), // manage-users
            array('permission_id' => 2, 'role_id' => 3), // manage-banks
            array('permission_id' => 3, 'role_id' => 3), // manage-currencies
            array('permission_id' => 4, 'role_id' => 3), // manage-countries
            array('permission_id' => 5, 'role_id' => 3), // manage-postal-codes

            // sys-admin
            array('permission_id' => 1, 'role_id' => 4), // manage-users
            array('permission_id' => 2, 'role_id' => 4), // manage-banks
            array('permission_id' => 3, 'role_id' => 4), // manage-currencies
            array('permission_id' => 4, 'role_id' => 4), // manage-countries
            array('permission_id' => 5, 'role_id' => 4), // manage-postal-codes
            array('permission_id' => 6, 'role_id' => 4), // manage-roles
            array('permission_id' => 7, 'role_id' => 4), // manage-permissions
        );

        $roles = array(
            array(
                'id'         => 1,
                'name'       => 'depositor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 2,
                'name'       => 'bidder',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 3,
                'name'       => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 4,
                'name'       => 'sys-admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        );

        DB::table('roles')->insert($roles);
        DB::table('role_has_permissions')->insert($roleHasPermissions);
    }
}
