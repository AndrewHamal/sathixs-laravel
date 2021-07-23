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
        // \App\Models\User::factory(10)->create();
        $this->call([
            // UserSeeder::class,
            // CancelReasonSeeder::class,
            // CategorySeeder::class,
            // LocationSeeder::class,
            // VendorSeeder::class,
            // RiderSeeder::class,
            // RiderDetailsSeeder::class,
            // RoleSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
