<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CurrenciesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(PostalCodesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(DepositorTypesTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserProfilesTableSeeder::class);
        $this->call(BankProfilesTableSeeder::class);
        $this->call(EnquiriesTableSeeder::class);
        $this->call(OfferChancesTableSeeder::class);
        $this->call(OffersTableSeeder::class);
    }
}
