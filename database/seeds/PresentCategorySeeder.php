<?php

use Illuminate\Database\Seeder;
use App\Models\PresentCategory;

class PresentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PresentCategory::create(['name' => 'Утешительные призы']);
        PresentCategory::create(['name' => 'Супер приз']);
    }
}
