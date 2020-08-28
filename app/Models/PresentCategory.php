<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresentCategory extends Model
{
    protected $fillable = ['name'];

    public function presents()
    {
        return $this->hasMany('App\Models\Present');
    }
}
