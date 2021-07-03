<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'User 1',
            'email' => 'user@gmail.com',
            'password' => Hash::make('Password@1'),
            'phone' => 1111111
        ]);
    }
}
