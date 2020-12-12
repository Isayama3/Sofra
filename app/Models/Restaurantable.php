<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurantable extends Model 
{

    protected $table = 'restaurantables';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'restaurantable_id');

}