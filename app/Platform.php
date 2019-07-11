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

    public function webspaces(){
        return $this->hasMany('App\Webspace');
    }
}
