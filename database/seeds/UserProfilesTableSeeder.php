<?php

use Mybankerbiz\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserProfilesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('da_DK');

        DB::table('memberships')->delete();
        DB::table('user_profiles')->delete();

        $memberships = array(
            array(
                'id'         => 1,
                'name'       => 'bank',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 2,
                'name'       => 'company',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 3,
                'name'       => 'coop',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 4,
                'name'       => 'ifa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 5,
                'name'       => 'pension_fund',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 6,
                'name'       => 'personal',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 7,
                'name'       => 'public',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        );

        DB::table('memberships')->insert($memberships);

        $collMemberships = collect($memberships);

        $userProfiles = [];

        foreach (User::all() as $user) {
            $userProfiles[] = [
                'id'            => $user->id,
                'user_id'       => $user->id,
                'membership_id' => $collMemberships->random(1)['id'],
                'avatar'        => null,
                'is_active'     => true,
            ];
        }

        DB::table('user_profiles')->insert($userProfiles);
    }
}
