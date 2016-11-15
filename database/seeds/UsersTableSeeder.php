<?php

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Mybankerbiz\Enumerations\EnumRole;
use Mybankerbiz\Bank;
use Mybankerbiz\User;
use Mybankerbiz\DepositorType;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('da_DK');

        DB::table('user_has_roles')->delete();
        DB::table('users')->delete();

        // Grab the roles needed by this seeder
        $sysAdminRole  = Role::find(EnumRole::SYS_ADMIN);
        $adminRole     = Role::find(EnumRole::ADMIN);
        $bidderRole    = Role::find(EnumRole::BIDDER);
        $depositorRole = Role::find(EnumRole::DEPOSITOR);

        // Grab and prep the collecton of depositorTypes
        $depositorTypes      = DepositorType::all();
        $depositorTypesCount = $depositorTypes->count();
        $depositorTypes      = $depositorTypes->all();


        // Create a known SysAdmin: Superman (SysAdmin role)
        $user = User::create([
            'bank_id'    => null,
            'name'       => 'Clark Kent',
            'email'      => 'sup@man.com',
            'password'   => 'secret',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $sysAdminRole->users()->attach($user);

        // Create a known Admin: Batman (Admin role)
        $user = User::create([
            'bank_id'    => null,
            'name'       => 'Bruce Wayne',
            'email'      => 'bat@man.com',
            'password'   => 'secret',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $adminRole->users()->attach($user);

        // Create a known Banker (Bidder role)
        $user = User::create([
            'bank_id'    => 1,
            'name'       => 'Nick Fury',
            'email'      => 'nick@fury.com',
            'password'   => 'secret',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $bidderRole->users()->attach($user);

        // Create a known Customer (Depositor role)
        $user = User::create([
            'bank_id'    => null,
            'name'       => 'Paris Hilton',
            'email'      => 'paris@hilton.com',
            'password'   => 'secret',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $depositorRole->users()->attach($user);

        // Attach 1 or more random depositorProfiles to the Customer
        $count = 1;
        foreach (range(1, mt_rand(1, 3)) as $index) {
            $depositorType = $depositorTypes[mt_rand(0, $depositorTypesCount - 1)];

            $profile = [
                'name'              => "{$user->name} ({$depositorType['name']})",
                'vatin'             => in_array($depositorType['name'], ['personal', 'coop']) ? null : $faker->cvr,
                'pin'               => $faker->cpr,
                'is_primary'        => $count == 1 ? true : false,
                'is_active'         => true,
                'depositor_type_id' => $depositorType['id'],
            ];
            $user->depositorProfiles()->create($profile);
            $count++;
        }

        // Create some random bank-specific users
        foreach (Bank::all() as $bank) {
            $iNetDomain = $this->buildInetDomainFromBank($bank);
            $name       = $faker->name;
            $alias      = $this->buildAliasFromName($name);
            $email      = $alias . '@' . $iNetDomain;

            // Create some bankers
            foreach (range(1, mt_rand(1, 5)) as $index) {
                $name  = $faker->name;
                $alias = $this->buildAliasFromName($name);
                $email = $alias . '@' . $iNetDomain;

                $user = User::create([
                    'bank_id'    => $bank->id,
                    'name'       => $name,
                    'email'      => $email,
                    'password'   => 'secret',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $bidderRole->users()->attach($user);
            }
        }

        // Create some random customers
        foreach (range(1, mt_rand(25, 100)) as $index) {
            $user = User::create([
                'bank_id'    => null,
                'name'       => $faker->name,
                'email'      => $faker->email,
                'password'   => 'secret',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $depositorRole->users()->attach($user);

            // Attach 1 or more random depositorProfiles to the user
            $count = 1;
            foreach (range(1, mt_rand(1, 3)) as $index) {
                $depositorType = $depositorTypes[mt_rand(0, $depositorTypesCount - 1)];

                $profile = [
                    'name'              => "{$user->name} ({$depositorType['name']})",
                    'vatin'             => in_array($depositorType['name'], ['personal', 'coop']) ? null : $faker->cvr,
                    'pin'               => $faker->cpr,
                    'is_primary'        => $count == 1 ? true : false,
                    'is_active'         => true,
                    'depositor_type_id' => $depositorType['id'],
                ];
                $user->depositorProfiles()->create($profile);
                $count++;
            }
        }
    }

    private function buildInetDomainFromBank($bank)
    {
        $iNetDomain = strtolower(str_replace(' ', '.', $bank->name));

        return $iNetDomain . $bank->country->tld;
    }

    private function buildAliasFromName($name)
    {
        $patterns     = ['/Æ/', '/æ/', '/Ø/', '/ø/', '/Å/', '/å/', '/Ö/', '/ö/', '/Ä/', '/ä/', '/É/', '/é/', '/Ü/', '/ü/'];
        $replacements = [ 'Ae',  'ae',  'Oe',  'oe',  'Aa',  'aa',  'Oe',  'oe',  'Aa',  'aa',  'E',   'e',   'U',   'u' ];

        $name      = preg_replace($patterns, $replacements, $name);
        $nameParts = explode(' ', $name);
        $alias     = strtolower($nameParts[0] . '.' . $nameParts[count($nameParts)-1]);

        return $alias;
    }
}
