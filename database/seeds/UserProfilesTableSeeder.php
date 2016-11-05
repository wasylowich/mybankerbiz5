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

        DB::table('user_profiles')->delete();

        $userProfiles = [];

        foreach (User::all() as $user) {
            $userProfiles[] = [
                'id'        => $user->id,
                'user_id'   => $user->id,
                'avatar'    => null,
                'is_active' => true,
            ];
        }

        DB::table('user_profiles')->insert($userProfiles);
    }
}
