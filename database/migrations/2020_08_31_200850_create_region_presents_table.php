<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionPresentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_presents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('region_id');
            $table->integer('present_id');
            $table->integer('region_amount')->default(0);
            $table->integer('nominal_region_amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region_presents');
    }
}
