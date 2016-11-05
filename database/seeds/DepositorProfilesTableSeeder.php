<?php

use Mybankerbiz\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DepositorProfilesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('da_DK');

        DB::table('depositor_types')->delete();
        DB::table('depositor_profiles')->delete();

        $depositorTypes = array(
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

        DB::table('depositor_types')->insert($depositorTypes);

        $collDepositorTypes = collect($depositorTypes);

        $depositorProfiles = [];

        foreach (User::all() as $user) {
            $depositorType = $collDepositorTypes->random(1);
            $name          = $user->name . ' (' .$depositorType['name'] . ')';
            $vatin         = null;
            $pin           = $faker->cpr;

            if (!in_array($depositorType['name'], ['personal', 'coop'])) {
                $vatin = $faker->cvr;
            }

            $depositorProfiles[] = [
                'user_id'           => $user->id,
                'depositor_type_id' => $depositorType['id'],
                'name'              => $name,
                'vatin'             => $vatin,
                'pin'               => $pin,
                'is_primary'        => true,
                'is_active'         => true,
            ];
        }

        DB::table('depositor_profiles')->insert($depositorProfiles);
    }
}
