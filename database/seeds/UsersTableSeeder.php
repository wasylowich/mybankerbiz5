<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_has_roles')->delete();
        DB::table('users')->delete();

        $userHasRoles = array(
            // Clark Kent (sys-admin)
            array('role_id' => 4, 'user_id' => 1), // manage-postal-codes

            // Admin
            array('role_id' => 3, 'user_id' => 2), // manage-postal-codes

            // Bidder
            array('role_id' => 2, 'user_id' => 3), // manage-users

            // Depositor
            array('role_id' => 1, 'user_id' => 4), // manage-users
        );

        $users = array(
            array(
                'id'         => 1,
                'bank_id'    => null,
                'name'       => 'Clark Kent',
                'email'      => 'sup@man.com',
                'password'   => bcrypt('secret'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 2,
                'bank_id'    => null,
                'name'       => 'Administrator',
                'email'      => 'adm@man.com',
                'password'   => bcrypt('secret'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 3,
                'bank_id'    => 1,
                'name'       => 'Bidder',
                'email'      => 'bid@man.com',
                'password'   => bcrypt('secret'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 4,
                'bank_id'    => null,
                'name'       => 'Depositor',
                'email'      => 'dep@man.com',
                'password'   => bcrypt('secret'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        );

        DB::table('users')->insert($users);
        DB::table('user_has_roles')->insert($userHasRoles);
    }
}
