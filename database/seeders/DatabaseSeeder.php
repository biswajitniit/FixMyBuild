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
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            AreaCoverSeeder::Class,
            WorktypeSeeder::Class,
            SubWorkTypeSeeder::Class,
            BuildercategorySeeder::class,
        ]);
    }
}
