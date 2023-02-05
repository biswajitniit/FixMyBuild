<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'customer_id'                    => 1,
            'home_phone'                     => '8768624650',
            'mobile'                         => '8170915403',
            'email'                          => 'biswajitmaityniit@gmail.com',
        ]);
    }
}
