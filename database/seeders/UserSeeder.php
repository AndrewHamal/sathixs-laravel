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
            'name' => 'su.admin',
            'email' => 'admins@gmail.com',
            'password' => Hash::make('Password@1'),
            'role_id' => 1,
            'phone' => 1111111
        ]);
    }
}
