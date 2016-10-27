<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostalCodesTableSeeder extends Seeder
{
    const DENMARK = 208;

    public function run()
    {
        DB::table('postal_codes')->delete();

        $postalCodes = array(
            array(
                'id'         => 1,
                'country_id' => self::DENMARK,
                'code'       => '1415',
                'city'       => 'København K',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 2,
                'country_id' => self::DENMARK,
                'code'       => '2000',
                'city'       => 'Frederiksberg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 3,
                'country_id' => self::DENMARK,
                'code'       => '2300',
                'city'       => 'København S',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 4,
                'country_id' => self::DENMARK,
                'code'       => '2400',
                'city'       => 'København NV',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 5,
                'country_id' => self::DENMARK,
                'code'       => '2450',
                'city'       => 'København SV',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 6,
                'country_id' => self::DENMARK,
                'code'       => '4140',
                'city'       => 'Borup',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 7,
                'country_id' => self::DENMARK,
                'code'       => '5200',
                'city'       => 'Odense V',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 8,
                'country_id' => self::DENMARK,
                'code'       => '5260',
                'city'       => 'Odense S',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 9,
                'country_id' => self::DENMARK,
                'code'       => '8000',
                'city'       => 'Århus C',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 10,
                'country_id' => self::DENMARK,
                'code'       => '8200',
                'city'       => 'Århus N',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );

        DB::table('postal_codes')->insert($postalCodes);
    }
}
