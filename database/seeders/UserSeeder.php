<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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
            'name'                           => 'Biswajit Maity',
            'email'                          => 'biswajitmaityniit@gmail.com',
            'password'                       => '$2y$10$9c4/3snzvsSVT.IuMbddLe0IoCf2JCt8kXCpxh..DwPcqnNNmqjLW',
            'phone'                          => '8768624650',
            'customer_or_tradesperson'       => 'Customer',
            'terms_of_service'               => '1',
            'remember_token'                 => 'nZSz8mqVzR4CeCpal6vzw0lnqOO1sYvMayKgItHI7e9RfavsBAs2PcWvUtDb',
            'status'                         => 'Active',
        ]);

        User::create([
            'name'                           => 'Himanshu Kumar',
            'email'                          => 'tradepersion@fixmybuild.com',
            'password'                       => '$2y$10$BYh4nqKV4ztrwDxkJgmHXebjBwbrCxhWtdp/IZaqIUqhOPHQsAaCG',
            'phone'                          => '9513103478',
            'customer_or_tradesperson'       => 'Tradepersion',
            'terms_of_service'               => '1',
            'remember_token'                 => 'nZSz8mqVzR4CeCpal6vzw0lnqOO1sYvMayKgItHI7e9RfavsBAs2PcWvUtDb',
            'status'                         => 'Active',
        ]);
    }
}
