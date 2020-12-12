<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantsTypes extends Model 
{

    protected $table = 'restaurants_types';
    public $timestamps = true;
    protected $fillable = array('name');

    public function restaurants()
    {
        return $this->hasMany('App\Models\Restaurant');
    }

}