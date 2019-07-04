<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function department(){
        return $this->belongsTo('App\Department');
    }
}
