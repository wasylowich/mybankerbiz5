<?php

use Mybankerbiz\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DepositorTypesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('da_DK');

        DB::table('depositor_types')->delete();

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
    }
}
