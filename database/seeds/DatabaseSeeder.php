<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CitySeeder::class);
         $this->call(PresentCategorySeeder::class);
         $this->call(RegionSeeder::class);
         $this->call(SettingSeeder::class);
    }
}
