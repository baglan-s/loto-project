<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Present extends Model
{
    protected $fillable = ['present_category_id', 'name', 'amount', 'region_amount'];

    public function category()
    {
        return $this->belongsTo('App\Models\PresentCategory', 'present_category_id');
    }

    public function regions()
    {
        return $this->belongsToMany('App\Models\Region', 'region_presents')->withPivot('id', 'region_amount');
    }

    public function regionPresents()
    {
        return $this->hasMany('App\Models\RegionPresent', 'present_id');
    }
}
