<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    // Taken from ISO-3166 standard

    public function run()
    {
        DB::table('countries')->delete();

        $countries = array(
            array(
                'id'                  => 208,
                'default_currency_id' => 208,
                'name'                => 'Denmark',
                'local_short_form'    => 'Danmark',
                'abbreviation'        => '',
                'iso_alpha_2'         => 'DK',
                'iso_alpha_3'         => 'DNK',
                'telephone_code'      => '45',
                'tld'                 => '.dk',
                'is_enabled'          => true,
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
                'deleted_at'          => null,
            ),

            array(
                'id'                  => 578,
                'default_currency_id' => 578,
                'name'                => 'Norway',
                'local_short_form'    => 'Norge',
                'abbreviation'        => '',
                'iso_alpha_2'         => 'NO',
                'iso_alpha_3'         => 'NOR',
                'telephone_code'      => '47',
                'tld'                 => '.no',
                'is_enabled'          => true,
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
                'deleted_at'          => null,
            ),

            array(
                'id'                  => 752,
                'default_currency_id' => 752,
                'name'                => 'Sweden',
                'local_short_form'    => 'Sverige',
                'abbreviation'        => '',
                'iso_alpha_2'         => 'SE',
                'iso_alpha_3'         => 'SWE',
                'telephone_code'      => '46',
                'tld'                 => '.se',
                'is_enabled'          => true,
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
                'deleted_at'          => null,
            ),

            array(
                'id'                  => 826,
                'default_currency_id' => 826,
                'name'                => 'United Kingdom',
                'local_short_form'    => 'United Kingdom',
                'abbreviation'        => 'UK',
                'iso_alpha_2'         => 'GB',
                'iso_alpha_3'         => 'GBR',
                'telephone_code'      => '44',
                'tld'                 => '.uk',
                'is_enabled'          => false,
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
                'deleted_at'          => null,
            ),
        );

        DB::table('countries')->insert($countries);
    }
}
