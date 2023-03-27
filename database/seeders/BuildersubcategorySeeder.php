<?php

namespace Database\Seeders;
use App\Models\Buildersubcategory;
use Illuminate\Database\Seeder;

class BuildersubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buildersubcategory::create(
            [
            'builder_category_id'             => 1,
            'builder_subcategory_name'        => 'Air Conditioning Installation',
            'status'                          => 'status',
            ]
        );
    }
}
