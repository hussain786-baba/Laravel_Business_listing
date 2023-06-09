<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           =>  'admin',
                'email'          =>  'admin@example.com',
                'password'       =>  bcrypt('123'),
                'remember_token' =>  null,
                'phone'          =>  '7079860977',
                'address'        =>  'mohali',
                'city'           =>  'india',
                'zip'            =>  '854303',
                'state'          =>  'bihar',
                'country'        =>  'india',
                'whatsapp'       =>  '123',
                'profile'        =>  'null',
            ],
        ];

        User::insert($users);
    }
}
