<?php

namespace Database\Seeders;

use App\Models\Vendor\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
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
                'id' => 5,
                'first_name'=>'John',
                'last_name'=>'Deo',
                'email'=>'john@gmail.com',
                'verification_code' => '66a9cde32e3df21d89495037b54b034d3a636f57',
                'email_verified_at' => '2021-06-30 06:15:10',
                'password'=>Hash::make('Password@1'),
                'phone'=>'2315122',
                'location_id'=>1,
                'profile_picture'=>'vendor/images/yBx3IHNIrVbD1pm3YU9v3ZwkqS1252TyrhrZA26f.jpg'
            ],
            [
                'id' => 2,
                'first_name'=>'Jack',
                'last_name'=>'Dean',
                'email'=>'jack@gmail.com',
                'verification_code' => '66a9cde32e3df21d89495037b54b034d3a636f57',
                'email_verified_at' => '2021-06-30 06:15:10',
                'password'=>Hash::make('Password@1'),
                'phone'=>'1145122',
                'location_id'=>2,
                'profile_picture'=>'vendor/images/0QX1goBnPUNTFuR8TOrFzt9p0KJYbIaegHvDHZkv.jpg'
            ],
            [
                'id' => 3,
                'first_name'=>'James',
                'last_name'=>'Cort',
                'email'=>'james@gmail.com',
                'verification_code' => '66a9cde32e3df21d89495037b54b034d3a636f57',
                'email_verified_at' => '2021-06-30 06:15:10',
                'password'=>Hash::make('Password@1'),
                'phone'=>'1145145',
                'location_id'=>3,
                'profile_picture'=>'vendor/images/yBx3IHNIrVbD1pm3YU9v3ZwkqS1252TyrhrZA26f.jpg'
            ],
            [
                'id' => 4,
                'first_name'=>'Robert',
                'last_name'=>'Joseph',
                'email'=>'robert@gmail.com',
                'verification_code' => '66a9cde32e3df21d89495037b54b034d3a636f57',
                'email_verified_at' => '2021-06-30 06:15:10',
                'password'=>Hash::make('Password@1'),
                'phone'=>'312513',
                'location_id'=>4,
                'profile_picture'=>'vendor/images/0QX1goBnPUNTFuR8TOrFzt9p0KJYbIaegHvDHZkv.jpg'
            ]
        ];

        foreach ($datas as $data) {
            Vendor::create($data);
        }
    }
}
