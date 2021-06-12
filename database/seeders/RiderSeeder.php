<?php

namespace Database\Seeders;

use App\Models\Rider\Rider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RiderSeeder extends Seeder
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
                'first_name'=>'Johnny',
                'last_name'=>'Hunter',
                'email'=>'johnny@gmail.com',
                'password'=>Hash::make('Password@1'),
                'phone'=>'2378978',
                'profile_photo'=>'rider/images/TRcL7yEOCRK2kTGhu2uW0U81epS3v4RuwaqD6Gcj.jpg',
                'status'=> 0
            ],
            [
                'id' => 2,
                'first_name'=>'Jacklin',
                'last_name'=>'Deannel',
                'email'=>'jacklin@gmail.com',
                'password'=>Hash::make('Password@1'),
                'phone'=>'984654546',
                'profile_photo'=>'rider/images/TRcL7yEOCRK2kTGhu2uW0U81epS3v4RuwaqD6Gcj.jpg',
                'status'=> 0
            ]
        ];

        foreach ($datas as $data) {
            Rider::create($data);
        }
    }
}
