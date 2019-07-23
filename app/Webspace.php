<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Owner;
use App\WebspaceMode as Mode;
use App\Platform as Platform;

class Webspace extends Model
{
    protected $fillable = ['name','url','mode','service','owner','platform_id','description','status'];

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function owners(){
        return $this->belongsToMany('App\Owner');
    }

    public function platform(){
        return  $this->belongsTo('App\Platform');
    }

    public function histories(){
        return $this->morphMany('App\ModelHasHistorie','model');
    }
}
