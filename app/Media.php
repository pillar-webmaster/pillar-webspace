<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    /**
     * TODO: not sure why medias table is interpreted by eloquent to media.
     * The naming convention for table and model is followed correctly
     * https://laravel.com/docs/5.4/eloquent#eloquent-model-conventions
     * For now, we will manually tell Eloquent to use medias table statically.
     */
    protected $table = 'medias';

    protected $fillable = ['description','path','status', 'webspace_id'];

    public function webspace(){
        return $this->belongsTo('App\Webspace');
    }
}
