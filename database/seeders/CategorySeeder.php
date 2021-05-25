<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title' => 'Electronic',
            ], [
                'title' => 'Health',
            ], [
                'title' => 'Groceries',
            ], [
                'title' => 'Mens Fashion',
            ], [
                'title' => 'Automobile',
            ]
        ];

        foreach ($categories as $category){
            Category::create($category);
        }
    }
}
