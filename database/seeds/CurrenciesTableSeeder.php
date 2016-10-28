<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('currencies')->delete();

        $currencies = array(
            array(
                'id'         => 208,
                'name'       => 'Danish Krone',
                'code'       => 'DKK',
                'precision'  => 2,
                'is_enabled' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ),

            array(
                'id'         => 578,
                'name'       => 'Norwegian Krone',
                'code'       => 'NOK',
                'precision'  => 2,
                'is_enabled' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ),

            array(
                'id'         => 752,
                'name'       => 'Swedish Krone',
                'code'       => 'SEK',
                'precision'  => 2,
                'is_enabled' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ),

            array(
                'id'         => 826,
                'name'       => 'Pound Sterling',
                'code'       => 'GBP',
                'precision'  => 2,
                'is_enabled' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ),

            array(
                'id'         => 840,
                'name'       => 'US Dollar',
                'code'       => 'USD',
                'precision'  => 2,
                'is_enabled' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ),

            array(
                'id'         => 978,
                'name'       => 'Euro',
                'code'       => 'EUR',
                'precision'  => 2,
                'is_enabled' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            )
        );

        DB::table('currencies')->insert($currencies);
    }
}

