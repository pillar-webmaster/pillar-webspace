<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $fillable = [
        'name', 'version', 'requirements', 'status',
    ];

    public function scopeActive($query){
        return $query->where('status', 1);
    }
    // remove later
    public function webspaces(){
        return $this->hasMany('App\Webspace')->active();
    }

    public function websites(){
        return $this->hasMany('App\Website')->active();
    }
}
