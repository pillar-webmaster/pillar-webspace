<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $fillable = ['name', 'status'];

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function webspaces(){
        return $query->belongsToMany('App\Webspace')->active();
    }
}
