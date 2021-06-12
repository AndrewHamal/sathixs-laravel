<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['id' => 1, 'city'=> 'Kathmandu', 'state'=> 'Bagmati', 'country'=> 'Nepal', 'long' => '85.300140', 'lat' => '27.700769', 'whole_address' => 'Kathmandu, Nepal'],
            ['id' => 2, 'city'=> 'Kathmandu', 'state'=> 'Bagmati', 'country'=> 'Nepal', 'long' => '85.333336', 'lat' => '27.700001'],
            ['id' => 3, 'city'=> 'Bhaktapur', 'state'=> 'Bagmati', 'country'=> 'Nepal', 'long' => '15.300949', 'lat' => '47.784761', 'whole_address' => 'Bhaktapur, Nepal'],
            ['id' => 4, 'city'=> 'Baneshwor', 'state'=> 'Bagmati', 'country'=> 'Nepal', 'long' => '15.300991', 'lat' => '37.784711'],
            ['id' => 5, 'city'=> 'Koteshwor', 'state'=> 'Bagmati', 'country'=> 'Nepal', 'long' => '25.300949', 'lat' => '27.784761', 'whole_address' => 'Koteshwor, Nepal'],
            ['id' => 6, 'city'=> 'Banepa', 'state'=> 'Bagmati', 'country'=> 'Nepal', 'long' => '55.30099', 'lat' => '17.78471'],
            ['id' => 7, 'city'=> 'Hetauda', 'state'=> 'Makwanpur', 'country'=> 'Nepal', 'long' => '85.029716', 'lat' => '27.429071'],
            ['id' => 8, 'city'=> 'Butwal', 'state'=> 'Lumbini', 'country'=> 'Nepal', 'long' => '83.432426', 'lat' => '27.686386'],
            ['id' => 9, 'city'=> 'Dhangadhi', 'state'=> 'Sudurpashchim', 'country'=> 'Nepal', 'long' => '80.608063', 'lat' => '28.683359'],
            ['id' => 10, 'city'=> 'Birgunj', 'state'=> 'Province 2', 'country'=> 'Nepal', 'long' => '84.859085', 'lat' => '27.005915'],
        ];

        foreach ($datas as $data) {
            Location::create($data);
        }
    }
}
