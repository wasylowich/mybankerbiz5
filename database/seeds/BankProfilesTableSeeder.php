<?php

use Mybankerbiz\Bank;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BankProfilesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('da_DK');

        DB::table('bank_profiles')->delete();

        $bankProfiles = [];

        foreach (Bank::all() as $bank) {
            $bankProfiles[] = [
                'id'            => $bank->id,
                'bank_id'       => $bank->id,
                'logo'          => null,
                'annual_report' => $faker->url(),
                'bio'           => $faker->paragraph(3),
            ];
        }

        DB::table('bank_profiles')->insert($bankProfiles);
    }
}
