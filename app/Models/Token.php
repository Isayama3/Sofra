<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model 
{

    protected $table = 'tokens';
    public $timestamps = true;
    protected $fillable = array('token', 'type', 'tokenable_id', 'tokenable_type');

    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }

    public function restaurants()
    {
        return $this->morphToMany('App\Models\Restaurant', 'restaurantable');
    }

}