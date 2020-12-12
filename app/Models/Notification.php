<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'notifiable_id', 'notifiable_type');

    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }

    public function restaurants()
    {
        return $this->morphToMany('App\Models\Restaurant', 'restaurantable');
    }

}