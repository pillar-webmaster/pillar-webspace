<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'status',
    ];
    
    public function scopeActive($query){
        return $query->where('status', 1);
    }
}
