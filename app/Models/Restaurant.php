<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{

    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'district_id', 'password', 'type_id', 'min_price','max_price', 'delivery_cost', 'whatsapp', 'restaurant_phone', 'status', 'api_token');
    protected $hidden = array('password', 'api_token','remember_token');

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\RestaurantsTypes');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function payment()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function notifications()
    {
        return $this->morphedByMany('App\Models\Notification', 'restaurantable');
    }

    public function tokens()
    {
        return $this->morphedByMany('App\Models\Token', 'restaurantable');
    }

}
