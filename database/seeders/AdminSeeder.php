<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'reviewer',
                'email' => 'reviewer@gmail.com',
                'password' => Hash::make(123456),
                'type' => 'reviewer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make(123456),
                'type' => 'superadmin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
