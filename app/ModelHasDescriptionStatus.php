<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelHasDescriptionStatus extends Model
{
    //
    protected $fillable = ['description', 'mode'];

    public function description_statusable(){
        return $this->morphTo();
    }
}
