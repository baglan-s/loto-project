<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name', 'region_amount'];

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    public function presents()
    {
        return $this->belongsToMany('App\Models\Present', 'region_presents')->withPivot('id', 'region_amount');
    }

    public function getPresentAmountByRegion($present_id)
    {
        return $this->presents()
            ->where('presents.id', $present_id)
            ->first()
            ->pivot
            ->region_amount;
    }

    public function getPresentsAmount($present_id)
    {
        $sum = 0;
        foreach (self::all() as $region) {
            foreach ($region->presents()->where('presents.id', $present_id)->get() as $present) {
                $sum += $present->pivot->region_amount;
            }
        }

        return $sum;
    }
}
