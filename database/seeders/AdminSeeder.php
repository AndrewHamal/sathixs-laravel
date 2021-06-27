<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'id' => 1,
                'role_id' => 1,
                'name' => 'admin',
                'email' => 'admins@gmail.com',
                'password' => Hash::make('Password@1'),
                'phone' => 1111111
            ],
            [
                'id' => 2,
                'role_id' => 2,
                'name' => 'editor',
                'email' => 'editor@gmail.com',
                'password' => Hash::make('Password@1'),
                'phone' => 222222
            ]
        ];

        foreach ($datas as $data) {
            Admin::create($data);
        }
    }
}
