<?php

namespace Database\Seeders;

use App\Models\Admin\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
                'role'=>'Admin',
            ],
            [
                'id' => 2,
                'role'=>'Editor',
            ]
        ];

        foreach ($datas as $data){
            Role::create($data);
        }
    }
}
