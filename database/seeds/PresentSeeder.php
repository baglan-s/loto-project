<?php

use Illuminate\Database\Seeder;
use App\Models\Present;
use App\Models\RegionPresent;

class PresentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Present::create([
            'present_category_id'   => 1,
            'name'                  => 'Iphone S7',
            'amount'                => 12,
            'nominal_amount'        => 12,
        ]);
        RegionPresent::create([
            'region_id'             => 1,
            'present_id'            => 1,
            'region_amount'         => 3,
            'nominal_region_amount' => 3,
        ]);
        RegionPresent::create([
            'region_id'             => 2,
            'present_id'            => 1,
            'region_amount'         => 4,
            'nominal_region_amount' => 4,
        ]);
        RegionPresent::create([
            'region_id'             => 3,
            'present_id'            => 1,
            'region_amount'         => 5,
            'nominal_region_amount' => 5,
        ]);

        Present::create([
            'present_category_id'   => 1,
            'name'                  => 'Samsung Galaxy S10',
            'amount'                => 12,
            'nominal_amount'        => 12,
        ]);
        RegionPresent::create([
            'region_id'             => 1,
            'present_id'            => 2,
            'region_amount'         => 3,
            'nominal_region_amount' => 3,
        ]);
        RegionPresent::create([
            'region_id'             => 2,
            'present_id'            => 2,
            'region_amount'         => 4,
            'nominal_region_amount' => 4,
        ]);
        RegionPresent::create([
            'region_id'             => 3,
            'present_id'            => 2,
            'region_amount'         => 5,
            'nominal_region_amount' => 5,
        ]);

        Present::create([
            'present_category_id'   => 1,
            'name'                  => 'Mercedes-Benz S63 AMG',
            'amount'                => 3,
            'nominal_amount'        => 3,
        ]);
        RegionPresent::create([
            'region_id'             => 1,
            'present_id'            => 3,
            'region_amount'         => 1,
            'nominal_region_amount' => 1,
        ]);
        RegionPresent::create([
            'region_id'             => 2,
            'present_id'            => 3,
            'region_amount'         => 1,
            'nominal_region_amount' => 1,
        ]);
        RegionPresent::create([
            'region_id'             => 3,
            'present_id'            => 3,
            'region_amount'         => 1,
            'nominal_region_amount' => 1,
        ]);
    }
}
