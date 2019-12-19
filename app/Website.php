<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    //
    protected $fillable = ['url','platform_id', 'webspace_id'];

    public function description_status(){
        return $this->morphOne('App\ModelHasDescriptionStatus','model');
    }
}
