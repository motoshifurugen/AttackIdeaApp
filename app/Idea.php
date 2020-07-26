<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    public function attacks()
    {
        return $this->belongsToMany('App\Attack');
    }
}
