<?php

use Mybankerbiz\Bank;
use Mybankerbiz\OfferChance;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class OffersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('da_DK');

        DB::table('offers')->delete();

        $banks = Bank::with('users')->whereIsActive(true)->get();

        $offers = [];

        foreach (OfferChance::with('enquiry')->get() as $offerChance) {
            foreach ($banks as $bank) {
                $makeAnOffer = $faker->boolean(50);

                if ($makeAnOffer && $bank->users->count()) {
                    $interest = round(mt_rand(50, 5000) / 1000, 3);
                    $amount   = $offerChance->enquiry->amount * $interest;

                    $offers[] = [
                        'bank_id'                => $bank->id,
                        'bidder_id'              => $bank->users->random(1)->id,
                        'enquiry_id'             => $offerChance->enquiry_id,
                        'currency_id'            => $offerChance->enquiry->currency_id,
                        'offer_chance_id'        => $offerChance->id,
                        'interest_convention_id' => $bank->interest_convention_id,
                        'interest_term_id'       => $bank->interest_term_id,
                        'interest'               => $interest,
                        'amount'                 => $amount,
                        'state'                  => 'active',
                        'created_at'             => Carbon::now(),
                        'updated_at'             => Carbon::now(),
                        'deleted_at'             => null,
                    ];

                    $offerChance->accept()->save();
                }
            }
        }

        DB::table('offers')->insert($offers);
    }
}
