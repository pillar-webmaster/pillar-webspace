<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webspace extends Model
{
    public function scopeActive($query){
        return $query->where('status', 1);
    }
    
    public function owner(){
        return $this->belongsTo('App\Owner');
    }
}
