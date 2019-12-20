<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    //
    protected $fillable = ['url','platform_id', 'webspace_id', 'status'];

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function description_status(){
        return $this->morphOne('App\ModelHasDescriptionStatus','model');
    }

    public function platform(){
        return  $this->belongsTo('App\Platform')->active();
    }
}
