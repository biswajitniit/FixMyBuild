<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AreaCover;

class AreaCoverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        AreaCover::create([
            'area_type' => 'Avon',
            'status'    => 1,
        ]);

        AreaCover::create([
            'area_type' => 'Bedfordshire',
            'status'    => 1,
        ]);
        AreaCover::create([
            'area_type' => 'Bristol',
            'status'    => 1,
        ]);
    }
}
