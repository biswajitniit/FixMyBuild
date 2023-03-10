<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            AreaCoverSeeder::Class,
            SubAreaCoverSeeder::Class,
            WorktypeSeeder::Class,
            SubWorkTypeSeeder::Class,
        ]);
    }
}
