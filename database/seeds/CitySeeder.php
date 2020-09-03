<?php

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create(['region_id' => 1, 'name' => 'Шымкент']);
        City::create(['region_id' => 2, 'name' => 'Алматы']);
        City::create(['region_id' => 2, 'name' => 'Тараз']);
        City::create(['region_id' => 3, 'name' => 'Кызылорда']);
        City::create(['region_id' => 3, 'name' => 'Караганда']);
        City::create(['region_id' => 2, 'name' => 'Аксукент']);
    }
}
