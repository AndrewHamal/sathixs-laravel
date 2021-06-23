<?php

namespace Database\Seeders;

use App\Models\Rider\Rider_detail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RiderDetailsSeeder extends Seeder
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
                'rider_id'=>1,
                'home_location_id'=>'1',
                'date_of_birth'=>'1982-06-08',
                'gender'=>'male',
                'driving_license'=>["rider/images/NMdsxRFK3zfKu2Y9yxwybH6BW1WYhcSgKh4l84Ky.jpg"],
                'photo_id_proof'=>["rider/images/YHB5OoChBDvBYSVO66ebk80eyWmbt51zrRq5BXkQ.jpg","rider/images/KjkmJxcc3qYQ95eHb7m3JIcvYlUTXTzOPxk2uACD.jpg"],
                'vehicle_insurance'=> ["rider/images/7Rnmng60rrIdYx9z0g8vp5MGa37nlDo5iFiimaRW.jpg","rider/images/oPUNjwbOmzYGajrCF8zgtbZs6j78lLcsedl7wlCe.jpg","rider/images/c4kbTogONzulcv1o0d4EsMTfd9uiF1eCYYiHJ92i.jpg"],
                'registration_certificate' => ["rider/images/g9UxmpInJuzoHJSesTLia3pj3IGiFAIJsy2FgR78.jpg","rider/images/MgF50O4sNnTXLfi5JgKTkTt5m4nrtarPR8AvqnUD.jpg"],
                'work_location_id' => 2,
            ],
            [
                'id' => 2,
                'rider_id'=>2,
                'home_location_id'=>'3',
                'date_of_birth'=>'1988-07-18',
                'gender'=>'male',
                'driving_license'=>["rider/images/NMdsxRFK3zfKu2Y9yxwybH6BW1WYhcSgKh4l84Ky.jpg"],
                'photo_id_proof'=>["rider/images/YHB5OoChBDvBYSVO66ebk80eyWmbt51zrRq5BXkQ.jpg","rider/images/KjkmJxcc3qYQ95eHb7m3JIcvYlUTXTzOPxk2uACD.jpg"],
                'vehicle_insurance'=> ["rider/images/7Rnmng60rrIdYx9z0g8vp5MGa37nlDo5iFiimaRW.jpg","rider/images/oPUNjwbOmzYGajrCF8zgtbZs6j78lLcsedl7wlCe.jpg","rider/images/c4kbTogONzulcv1o0d4EsMTfd9uiF1eCYYiHJ92i.jpg"],
                'registration_certificate' => ["rider/images/g9UxmpInJuzoHJSesTLia3pj3IGiFAIJsy2FgR78.jpg","rider/images/MgF50O4sNnTXLfi5JgKTkTt5m4nrtarPR8AvqnUD.jpg"],
                'work_location_id' => 4,
            ]
        ];

        foreach ($datas as $data)
        {
            Rider_detail::create($data);
        }
    }
}
