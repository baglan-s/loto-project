<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionPresent extends Model
{
    protected $table = 'region_presents';
    protected $fillable = ['region_amount', 'region_id', 'present_id', 'nominal_region_amount'];


}
