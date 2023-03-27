<?php

namespace Database\Seeders;
use App\Models\Buildercategory;
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
        Buildercategory::create(
            [
            'builder_category_name'           => 'Air Conditioning',
            'status'                          => 'status',
            ]
        );
    }
}
