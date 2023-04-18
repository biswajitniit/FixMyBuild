<?php

namespace Database\Seeders;
use App\Models\Buildercategory;
use App\Models\Buildersubcategory;
use Illuminate\Database\Seeder;

class BuildercategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'builder_category_name'           => 'Air Conditioning',
                'status'                          => 'Active',
            ],
            [
                'builder_category_name'           => 'Alarms / Security',
                'status'                          => 'Active',
            ],
            [
                'builder_category_name'           => 'Appliance Services / Repair',
                'status'                          => 'Active',
            ],
            [
                'builder_category_name'           => 'Aquariums',
                'status'                          => 'Active',
            ],
            [
                'builder_category_name'           => 'Architectural Services',
                'status'                          => 'Active',
            ],
            [
                'builder_category_name'           => 'Asbestos Services',
                'status'                          => 'Active',
            ],
            [
                'builder_category_name'           => 'Bathrooms',
                'status'                          => 'Active',
            ],
            [
                'builder_category_name'           => 'Bedrooms',
                'status'                          => 'Active',
            ],
            [
                'builder_category_name'           => 'Bricklayer',
                'status'                          => 'Active',
            ],
            [
                'builder_category_name'           => 'Builder',
                'status'                          => 'Active',
            ],
        ];

        Buildercategory::insert($category);

        $subcat = [
            [
                'builder_category_id'             => 1,
                'builder_subcategory_name'        => 'Air Conditioning Installation',
                'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 1,
                    'builder_subcategory_name'        => 'Air Conditioning Repair',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 1,
                    'builder_subcategory_name'        => 'Air Conditioning Servicing',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 1,
                    'builder_subcategory_name'        => 'Emergency Air Conditioning Services',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Alarm Response',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Biometric Security Systems',
                    'status'                          => 'Active',
                ],[
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Burglar Alarm - Installation',
                    'status'                          => 'Active',
                ],[
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Burglar Alarm - Supply & Installation',
                    'status'                          => 'Active',
                ],[
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Burglar Alarm - Supply Only',
                    'status'                          => 'Active',
                ],[
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Call / Door Entry Systems',
                    'status'                          => 'Active',
                ],[
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'CCTV - Installation',
                    'status'                          => 'Active',
                ],[
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'CCTV - Supply & Installation',
                    'status'                          => 'Active',
                ],[
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'CCTV - Supply Only',
                    'status'                          => 'Active',
                ],[
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Electric Gate Installation',
                    'status'                          => 'Active',
                ],[
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Electric Gate Repair',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Fire Alarm Installation',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Fire Alarm Servicing',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Fire Extinguishers',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Fire Risk Assessment',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Gate Automation',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Industrial Doors',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Intercom Entry Systems',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Intruder Alarms',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Safes',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Scaffold Alarms',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Security Assessment',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Security Barriers',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Security Fencing',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Security Shutters / Grilles',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 2,
                    'builder_subcategory_name'        => 'Security Solutions / Access Control',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 3,
                    'builder_subcategory_name'        => 'Industrial Doors',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 3,
                    'builder_subcategory_name'        => 'Intercom Entry Systems',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 3,
                    'builder_subcategory_name'        => 'Intruder Alarms',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 3,
                    'builder_subcategory_name'        => 'Safes',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 3,
                    'builder_subcategory_name'        => 'Scaffold Alarms',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 3,
                    'builder_subcategory_name'        => 'Security Assessment',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 3,
                    'builder_subcategory_name'        => 'Security Barriers',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 3,
                    'builder_subcategory_name'        => 'Security Fencing',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 3,
                    'builder_subcategory_name'        => 'Security Shutters / Grilles',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 3,
                    'builder_subcategory_name'        => 'Security Solutions / Access Control',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 4,
                    'builder_subcategory_name'        => 'Aquariums',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 5,
                    'builder_subcategory_name'        => '3D Architectural Models',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 5,
                    'builder_subcategory_name'        => 'Architect',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 5,
                    'builder_subcategory_name'        => 'Architectural Drawings',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 5,
                    'builder_subcategory_name'        => 'Architectural Technician',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 5,
                    'builder_subcategory_name'        => 'Planning / Design',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 5,
                    'builder_subcategory_name'        => 'Planning Consultants',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 5,
                    'builder_subcategory_name'        => 'Technical Drawing',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 6,
                    'builder_subcategory_name'        => 'Asbestos Removal - License',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 6,
                    'builder_subcategory_name'        => 'Asbestos Removal - Non License',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 6,
                    'builder_subcategory_name'        => 'Asbestos Surveys',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 6,
                    'builder_subcategory_name'        => 'Asbestos Testing',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 6,
                    'builder_subcategory_name'        => 'Emergency Asbestos Service',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 7,
                    'builder_subcategory_name'        => 'Bath Resurfacing',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 7,
                    'builder_subcategory_name'        => 'Bathroom Cladding',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 7,
                    'builder_subcategory_name'        => 'Bathroom Designer',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 7,
                    'builder_subcategory_name'        => 'Bathroom Fitter',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 7,
                    'builder_subcategory_name'        => 'Bathroom Showroom',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 7,
                    'builder_subcategory_name'        => 'Bathroom Supplier',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 7,
                    'builder_subcategory_name'        => 'Disabled Bathrooms / Showers',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 7,
                    'builder_subcategory_name'        => 'Emergency Bathroom Service',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 7,
                    'builder_subcategory_name'        => 'Mastic Sealant',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 7,
                    'builder_subcategory_name'        => 'Wet Rooms',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 8,
                    'builder_subcategory_name'        => 'Bedroom Planner / Designer',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 8,
                    'builder_subcategory_name'        => 'Bedroom Showroom',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 8,
                    'builder_subcategory_name'        => 'Bedroom Supplier / Installer',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 8,
                    'builder_subcategory_name'        => 'Fitted Wardrobes',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 8,
                    'builder_subcategory_name'        => 'Home Offices',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 8,
                    'builder_subcategory_name'        => 'Wardrobe Sliding Doors',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 9,
                    'builder_subcategory_name'        => 'Brickwork',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 9,
                    'builder_subcategory_name'        => 'Dry Stone Walling',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 9,
                    'builder_subcategory_name'        => 'Emergency Bricklayer Service',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 9,
                    'builder_subcategory_name'        => 'Flint / Stonework',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 9,
                    'builder_subcategory_name'        => 'Repointing',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 10,
                    'builder_subcategory_name'        => 'Agricultural Building',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 10,
                    'builder_subcategory_name'        => 'Basement / Cellar Conversions',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 10,
                    'builder_subcategory_name'        => 'Brick / Concrete Structural Repairs',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 10,
                    'builder_subcategory_name'        => 'Building Merchants',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 10,
                    'builder_subcategory_name'        => 'Car Ports',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 10,
                    'builder_subcategory_name'        => 'Cladding',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 10,
                    'builder_subcategory_name'        => 'Concrete Garages',
                    'status'                          => 'Active',
                ],
                [
                    'builder_category_id'             => 10,
                    'builder_subcategory_name'        => 'Concreting',
                    'status'                          => 'Active',
                ]
        ];
        Buildersubcategory::insert($subcat);
    }
}
