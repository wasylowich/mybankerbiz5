<?php

use Mybankerbiz\Bank;
use Mybankerbiz\Enquiry;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class OfferChancesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('da_DK');

        DB::table('offer_chances')->delete();

        $banks = Bank::with('users')->whereIsActive(true)->get();

        $offerChances = [];

        foreach (Enquiry::all() as $enquiry) {
            foreach ($banks as $bank) {
                if ($bank->users->count()) {
                    $offerChances[] = [
                        'bank_id'    => $bank->id,
                        'bidder_id'  => $bank->users->random(1)->id,
                        'enquiry_id' => $enquiry->id,
                        'state'      => 'under_consideration',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'deleted_at' => null,
                    ];
                }
            }
        }

        DB::table('offer_chances')->insert($offerChances);
    }
}
