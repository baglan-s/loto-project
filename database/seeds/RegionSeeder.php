<?php

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create(['name' => 'Регион 1']);
        Region::create(['name' => 'Регион 2']);
        Region::create(['name' => 'Регион 3']);
    }
}
