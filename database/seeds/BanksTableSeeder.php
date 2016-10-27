<?php

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{
    const DENMARK = 208;

    public function run()
    {
        $faker = Faker::create('da_DK');

        DB::table('banks')->delete();
        DB::table('rebate_types')->delete();
        DB::table('interest_conventions')->delete();
        DB::table('interest_terms')->delete();
        DB::table('bank_types')->delete();

        $bankTypes = array(
            array(
                'id'         => 1,
                'type'       => 'standard',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 2,
                'type'       => 'pro',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        );

        $interestConventions = array(
            array(
                'id'         => 1,
                'convention' => 'A/A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 2,
                'convention' => 'A/360',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 3,
                'convention' => 'A/365',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 4,
                'convention' => '30/360',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        );

        $interestTerms = array(
            array(
                'id'         => 1,
                'term'       => 'on_expiry',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 2,
                'term'       => 'annual_payout',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 3,
                'term'       => 'annual_attribution',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        );

        $rebateTypes = array(
            array(
                'id'         => 1,
                'type'       => 'full',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 2,
                'type'       => 'none',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 3,
                'type'       => 'partial',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 4,
                'type'       => 'unknown',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        );

        $collBankTypes           = collect($bankTypes);
        $collInterestConventions = collect($interestConventions);
        $collInterestTerms       = collect($interestTerms);
        $collRebateTypes         = collect($rebateTypes);

        $banks = array(
            array(
                'id'                             => 1,
                'country_id'                     => self::DENMARK,
                'bank_type_id'                   => $collBankTypes->random(1)['id'],
                'interest_convention_id'         => $collInterestConventions->random(1)['id'],
                'interest_term_id'               => $collInterestTerms->random(1)['id'],
                'pension_interest_convention_id' => $collInterestConventions->random(1)['id'],
                'rebate_type_id'                 => $collRebateTypes->random(1)['id'],
                'name'                           => $faker->company,
                'vatin'                          => $faker->cvr,
                'website'                        => 'www.' . $faker->domainName,
                'change_of_control'              => $faker->boolean(50),
                'rebate_message'                 => $faker->paragraph(3),
                'is_active'                      => $faker->boolean(50),
                'created_at'                     => Carbon::now(),
                'updated_at'                     => Carbon::now()
            ),

            array(
                'id'                             => 2,
                'country_id'                     => self::DENMARK,
                'bank_type_id'                   => $collBankTypes->random(1)['id'],
                'interest_convention_id'         => $collInterestConventions->random(1)['id'],
                'interest_term_id'               => $collInterestTerms->random(1)['id'],
                'pension_interest_convention_id' => $collInterestConventions->random(1)['id'],
                'rebate_type_id'                 => $collRebateTypes->random(1)['id'],
                'name'                           => $faker->company,
                'vatin'                          => $faker->cvr,
                'website'                        => 'www.' . $faker->domainName,
                'change_of_control'              => $faker->boolean(50),
                'rebate_message'                 => $faker->paragraph(3),
                'is_active'                      => $faker->boolean(50),
                'created_at'                     => Carbon::now(),
                'updated_at'                     => Carbon::now()
            ),

            array(
                'id'                             => 3,
                'country_id'                     => self::DENMARK,
                'bank_type_id'                   => $collBankTypes->random(1)['id'],
                'interest_convention_id'         => $collInterestConventions->random(1)['id'],
                'interest_term_id'               => $collInterestTerms->random(1)['id'],
                'pension_interest_convention_id' => $collInterestConventions->random(1)['id'],
                'rebate_type_id'                 => $collRebateTypes->random(1)['id'],
                'name'                           => $faker->company,
                'vatin'                          => $faker->cvr,
                'website'                        => 'www.' . $faker->domainName,
                'change_of_control'              => $faker->boolean(50),
                'rebate_message'                 => $faker->paragraph(3),
                'is_active'                      => $faker->boolean(50),
                'created_at'                     => Carbon::now(),
                'updated_at'                     => Carbon::now()
            ),

            array(
                'id'                             => 4,
                'country_id'                     => self::DENMARK,
                'bank_type_id'                   => $collBankTypes->random(1)['id'],
                'interest_convention_id'         => $collInterestConventions->random(1)['id'],
                'interest_term_id'               => $collInterestTerms->random(1)['id'],
                'pension_interest_convention_id' => $collInterestConventions->random(1)['id'],
                'rebate_type_id'                 => $collRebateTypes->random(1)['id'],
                'name'                           => $faker->company,
                'vatin'                          => $faker->cvr,
                'website'                        => 'www.' . $faker->domainName,
                'change_of_control'              => $faker->boolean(50),
                'rebate_message'                 => $faker->paragraph(3),
                'is_active'                      => $faker->boolean(50),
                'created_at'                     => Carbon::now(),
                'updated_at'                     => Carbon::now()
            ),
        );

        DB::table('bank_types')->insert($bankTypes);
        DB::table('interest_terms')->insert($interestTerms);
        DB::table('interest_conventions')->insert($interestConventions);
        DB::table('rebate_types')->insert($rebateTypes);
        DB::table('banks')->insert($banks);
    }
}
