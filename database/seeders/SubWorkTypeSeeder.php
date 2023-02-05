<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubWorkType;

class SubWorkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        SubWorkType::create([
            'work_type_id' => '1',
            'sub_work_type' => 'Architraves',
            'status'    => 1,
        ]);

        SubWorkType::create([
            'work_type_id' => '1',
            'sub_work_type' => 'Barn Conversions',
            'status'    => 1,
        ]);

        SubWorkType::create([
            'work_type_id' => '1',
            'sub_work_type' => 'Cupboards',
            'status'    => 1,
        ]);

        SubWorkType::create([
            'work_type_id' => '2',
            'sub_work_type' => 'Skirting',
            'status'    => 1,
        ]);

        SubWorkType::create([
            'work_type_id' => '2',
            'sub_work_type' => 'Staircases',
            'status'    => 1,
        ]);

        SubWorkType::create([
            'work_type_id' => '2',
            'sub_work_type' => 'Truss Roofing',
            'status'    => 1,
        ]);

        SubWorkType::create([
            'work_type_id' => '3',
            'sub_work_type' => 'Bespoke Furniture',
            'status'    => 1,
        ]);

        SubWorkType::create([
            'work_type_id' => '3',
            'sub_work_type' => 'Bespoke Windows / Doors',
            'status'    => 1,
        ]);

        SubWorkType::create([
            'work_type_id' => '3',
            'sub_work_type' => 'Cupboards',
            'status'    => 1,
        ]);
    }
}
