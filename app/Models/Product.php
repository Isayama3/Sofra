<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'price', 'offer_price', 'time', 'description', 'restaurant_id','category_id');

    public function restaurants()
    {
        return $this->belongsToMany('App\Models\Restaurant');
    }
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

}
