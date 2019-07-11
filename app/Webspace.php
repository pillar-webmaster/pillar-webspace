<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Owner;

class Webspace extends Model
{
    protected $fillable = ['name','url','mode','service','owner','platform_id','description','status'];

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function owners(){
        return $this->belongsToMany('App\Owner');
    }
}
