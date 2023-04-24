<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AreaCover;
use App\Models\SubAreaCover;

class AreaCoverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $area = [
            [
                'area_type' => 'Aberdeenshire',
                'status'    => 1,
            ],
            [
                'area_type' => 'Angus',
                'status'    => 1,
            ],
            [
                'area_type' => 'Argyll and Bute',
                'status'    => 1,
            ],
            [
                'area_type' => 'Ayrshire and Arran',
                'status'    => 1,
            ],
            [
                'area_type' => 'Banffshire',
                'status'    => 1,
            ],
            [
                'area_type' => 'Caithness',
                'status'    => 1,
            ]
        ];
        AreaCover::insert($area);

        


        $subarea = [
            [
                'area_type_id' => 1,
                'sub_area_type' => 'Abergeldie',
                'status' => 1
            ],
            [
                'area_type_id' => 1,
                'sub_area_type' => 'Aboyne',
                'status' => 1
            ],
            [
                'area_type_id' => 1,
                'sub_area_type' => 'Affleck',
                'status' => 1
            ],
            [
                'area_type_id' => 2,
                'sub_area_type' => 'Aberlemno',
                'status' => 1
            ],
            [
                'area_type_id' => 3,
                'sub_area_type' => 'Acha',
                'status' => 1
            ],
            [
                'area_type_id' => 3,
                'sub_area_type' => 'Achahoish',
                'status' => 1
            ],
            [
                'area_type_id' => 3,
                'sub_area_type' => 'Achaleven',
                'status' => 1
            ],
            [
                'area_type_id' => 3,
                'sub_area_type' => 'Achanelid',
                'status' => 1
            ],
            [
                'area_type_id' => 3,
                'sub_area_type' => 'Achleck',
                'status' => 1
            ],
            [
                'area_type_id' => 3,
                'sub_area_type' => 'Achlonan',
                'status' => 1
            ],
            [
                'area_type_id' => 3,
                'sub_area_type' => 'Achnacroish',
                'status' => 1
            ],
            [
                'area_type_id' => 3,
                'sub_area_type' => 'Achnagoul',
                'status' => 1
            ],
            [
                'area_type_id' => 3,
                'sub_area_type' => 'Achnahard',
                'status' => 1
            ],
            [
                'area_type_id' => 3,
                'sub_area_type' => 'Achnamara',
                'status' => 1
            ],
            [
                'area_type_id' => 3,
                'sub_area_type' => 'Aird',
                'status' => 1
            ],
            [
                'area_type_id' => 3,
                'sub_area_type' => 'Airds',
                'status' => 1
            ],
            [
                'area_type_id' => 3,
                'sub_area_type' => 'Airds Bay',
                'status' => 1
            ],
            [
                'area_type_id' => 4,
                'sub_area_type' => 'Afton Bridgend',
                'status' => 1
            ],
            [
                'area_type_id' => 5,
                'sub_area_type' => 'Aberchirder',
                'status' => 1
            ],
            [
                'area_type_id' => 6,
                'sub_area_type' => 'Achalone',
                'status' => 1
            ],
            [
                'area_type_id' => 6,
                'sub_area_type' => 'Achastle',
                'status' => 1
            ],
            [
                'area_type_id' => 6,
                'sub_area_type' => 'Achavanich',
                'status' => 1
            ],
            [
                'area_type_id' => 6,
                'sub_area_type' => 'Achavar',
                'status' => 1
            ],
            [
                'area_type_id' => 6,
                'sub_area_type' => 'Achingills',
                'status' => 1
            ],
            [
                'area_type_id' => 6,
                'sub_area_type' => 'Achnavast',
                'status' => 1
            ],
            [
                'area_type_id' => 6,
                'sub_area_type' => 'Achow',
                'status' => 1
            ],
            [
                'area_type_id' => 6,
                'sub_area_type' => 'Achreamie',
                'status' => 1
            ],
            [
                'area_type_id' => 6,
                'sub_area_type' => 'Achscrabster',
                'status' => 1
            ],
            [
                'area_type_id' => 6,
                'sub_area_type' => 'Ackergill',
                'status' => 1
            ],
            [
                'area_type_id' => 6,
                'sub_area_type' => 'Ackergillshore',
                'status' => 1
            ],
        ];
        SubAreaCover::insert($subarea);
    }
}
