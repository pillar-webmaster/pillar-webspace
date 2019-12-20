<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelHasHistorie extends Model
{
    protected $fillable = [
        'description',
    ];

    /*public function historable(){
        return $this->morphTo();
    }*/

    public function model(){
        return $this->morphTo();
    }
}
