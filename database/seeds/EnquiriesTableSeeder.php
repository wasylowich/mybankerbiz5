<?php

use Mybankerbiz\Currency;
use Mybankerbiz\DepositorProfile;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class EnquiriesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('da_DK');

        DB::table('deposit_types')->delete();
        DB::table('enquiries')->delete();

        $depositTypes = array(
            array(
                'id'         => 1,
                'name'       => 'period',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            array(
                'id'         => 2,
                'name'       => 'pension',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        );

        DB::table('deposit_types')->insert($depositTypes);

        $collDepositTypes = collect($depositTypes);

        $currencies = Currency::whereIsEnabled(true)->get();

        $enquiries = [];

        foreach (DepositorProfile::all() as $depositorProfile) {
            $depositType          = $collDepositTypes->random(1);
            $currency             = $currencies->random(1);

            $enquirer_id          = $depositorProfile->user_id;
            $depositor_profile_id = $depositorProfile->id;
            $deposit_type_id      = $depositType['id'];
            $currency_id          = $currency->id;
            $biddingDeadline      = Carbon::now()->addHours(26);
            $amount               = $depositType['name'] == 'period'
                                        ? mt_rand(100, 1000) * 1000 * (10 ** $currency->precision)
                                        : mt_rand(100, 1000) * 100 * (10 ** $currency->precision);
            $fixationStart        = $depositType['name'] == 'period'
                                        ? Carbon::now()->addDays(mt_rand(2, 7))
                                        : Carbon::now()->addDays(2);
            $fixationEnd          = $depositType['name'] == 'period'
                                        ? Carbon::now()->addYear()->addDays(2)
                                        : Carbon::now()->addDays(mt_rand(365, 365 * 3));

            $enquiries[] = [
                'enquirer_id'                => $enquirer_id,
                'depositor_profile_id'       => $depositor_profile_id,
                'deposit_type_id'            => $deposit_type_id,
                'currency_id'                => $currency_id,
                'bidding_deadline'           => $biddingDeadline,
                'amount'                     => $amount,
                'fixation_period_start_date' => $fixationStart,
                'fixation_period_end_date'   => $fixationEnd,
                'is_active'                  => true,
                'created_at'                 => Carbon::now(),
                'updated_at'                 => Carbon::now(),
                'deleted_at'                 => null,
            ];
        }

        DB::table('enquiries')->insert($enquiries);
    }
}
