<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkType;

class WorktypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        WorkType::create([
            'work_type' => 'Bathroom',
            'status'    => 1,
        ]);

        WorkType::create([
            'work_type' => 'Builder',
            'status'    => 1,
        ]);
        WorkType::create([
            'work_type' => 'Carpenter',
            'status'    => 1,
        ]);
    }
}
