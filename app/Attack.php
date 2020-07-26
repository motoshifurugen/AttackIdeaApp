<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attack extends Model
{
    public function ideas()
    {
        return $this->belongsToMany('App\Idea');
    }
}
