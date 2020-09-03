<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public static function allChances()
    {
        return self::sum('chance');
    }
}
