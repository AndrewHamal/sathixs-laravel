<?php

namespace Database\Seeders;

use App\Models\CancelReason;
use Illuminate\Database\Seeder;

class CancelReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reasons = [
            [
                'title' => 'Wrong Order',
            ], [
                'title' => 'Customer Cancel Order',
            ], [
                'title' => 'Rider Cancel Order',
            ], [
                'title' => 'Rider took time to arrive',
            ]
        ];

        foreach ($reasons as $reason){
            CancelReason::create($reason);
        }
    }
}
