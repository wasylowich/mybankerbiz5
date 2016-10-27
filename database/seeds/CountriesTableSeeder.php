<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('countries')->delete();

        $countries = array(
            array(
                'id'               => 208,
                'currency_id'      => 208,
                'name'             => 'Denmark',
                'local_short_form' => 'Danmark',
                'abbreviation'     => '',
                'iso_alpha_2'      => 'DK',
                'iso_alpha_3'      => 'DNK',
                'telephone_code'   => '45',
                'tld'              => '.dk',
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
                'deleted_at'       => null
            ),

            array(
                'id'               => 752,
                'currency_id'      => 752,
                'name'             => 'Sweden',
                'local_short_form' => 'Sverige',
                'abbreviation'     => '',
                'iso_alpha_2'      => 'SE',
                'iso_alpha_3'      => 'SWE',
                'telephone_code'   => '46',
                'tld'              => '.se',
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
                'deleted_at'       => null
            ),

            array(
                'id'               => 826,
                'currency_id'      => 826,
                'name'             => 'United Kingdom',
                'local_short_form' => 'United Kingdom',
                'abbreviation'     => 'UK',
                'iso_alpha_2'      => 'GB',
                'iso_alpha_3'      => 'GBR',
                'telephone_code'   => '44',
                'tld'              => '.uk',
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
                'deleted_at'       => Carbon::now()
            ),
        );

        DB::table('countries')->insert($countries);
    }
}
