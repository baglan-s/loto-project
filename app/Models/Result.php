<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['present_id', 'participant_id'];

    public function present()
    {
        return $this->belongsTo('App\Models\Present');
    }

    public function participant()
    {
        return $this->belongsTo('App\Models\Participant');
    }
}
