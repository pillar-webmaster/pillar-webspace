<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = [
        'name', 'contact', 'email', 'department_id', 'designation_id', 'status'
    ];

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function department(){
        return $this->belongsTo('App\Department')->active();
    }

    public function webspaces(){
        return $this->belongsToMany('App\Webspace')->active();
    }

    public function designation(){
        return $this->belongsTo('App\Designation')->active();
    }
}
