<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //
        // ,CreateUserAccessScopeSeeder::class
        $this->call([
            CreatePermissionRoleSeeder::class,
            CreateAdminUserSeeder::class,
            CountriesTableSeeder::class,
            StatesTableSeeder::class,
            CitiesTableSeeder::class
        ]);
    }
}
