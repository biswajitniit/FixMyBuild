<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubAreaCover;

class SubAreaCoverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        SubAreaCover::create([
            'area_type_id' => '1',
            'sub_area_type' => 'Barking and Dagenham',
            'status'    => 1,
        ]);

        SubAreaCover::create([
            'area_type_id' => '1',
            'sub_area_type' => 'Barking and Dagenham',
            'status'    => 1,
        ]);

        SubAreaCover::create([
            'area_type_id' => '1',
            'sub_area_type' => 'Barnet',
            'status'    => 1,
        ]);

        SubAreaCover::create([
            'area_type_id' => '2',
            'sub_area_type' => 'Barn Conversions',
            'status'    => 1,
        ]);

        SubAreaCover::create([
            'area_type_id' => '2',
            'sub_area_type' => 'Handmade Kitchens Designed / Installed',
            'status'    => 1,
        ]);

        SubAreaCover::create([
            'area_type_id' => '2',
            'sub_area_type' => 'Architraves',
            'status'    => 1,
        ]);

        SubAreaCover::create([
            'area_type_id' => '3',
            'sub_area_type' => 'Bespoke Windows / Doors',
            'status'    => 1,
        ]);

        SubAreaCover::create([
            'area_type_id' => '3',
            'sub_area_type' => 'Log Cabins',
            'status'    => 1,
        ]);

        SubAreaCover::create([
            'area_type_id' => '3',
            'sub_area_type' => 'Boat Building / Repairs',
            'status'    => 1,
        ]);
    }
}
