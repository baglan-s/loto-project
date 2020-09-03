<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'region_id'];

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function participants()
    {
        return $this->hasMany('App\Models\Participant');
    }

    public function participantsChances()
    {
        $participants = $this->participants;
        $chances = 0;

        foreach ($participants as $participant) {
            $chances += $participant->chance;
        }

        return $chances;
    }
}
