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
            // sys-admin
            array('permission_id' => 1, 'role_id' => 1), // manage-users
            array('permission_id' => 2, 'role_id' => 1), // manage-banks
            array('permission_id' => 3, 'role_id' => 1), // manage-currencies
            array('permission_id' => 4, 'role_id' => 1), // manage-countries
            array('permission_id' => 5, 'role_id' => 1), // manage-postal-codes
            array('permission_id' => 6, 'role_id' => 1), // manage-roles
            array('permission_id' => 7, 'role_id' => 1), // manage-permissions

            // admin
            array('permission_id' => 1, 'role_id' => 2), // manage-users
            array('permission_id' => 2, 'role_id' => 2), // manage-banks
            array('permission_id' => 3, 'role_id' => 2), // manage-currencies
            array('permission_id' => 4, 'role_id' => 2), // manage-countries
            array('permission_id' => 5, 'role_id' => 2), // manage-postal-codes

            // bidder
            array('permission_id' => 5, 'role_id' => 3), // manage-postal-codes

            // depositor
            array('permission_id' => 5, 'role_id' => 4), // manage-postal-codes
        );

        $roles = array(
            array(
                'id'         => 1,
                'name'       => 'sys-admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 2,
                'name'       => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 3,
                'name'       => 'bidder',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 4,
                'name'       => 'depositor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        );

        DB::table('roles')->insert($roles);
        DB::table('role_has_permissions')->insert($roleHasPermissions);
    }
}
