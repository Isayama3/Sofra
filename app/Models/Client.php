<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'district_id', 'password', 'api_token');
    protected $hidden = array('password', 'api_token','remember_token');

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function notifications()
    {
        return $this->morphedByMany('App\Models\Notification', 'clientable');
    }

    public function tokens()
    {
        return $this->morphedByMany('App\Models\Token', 'clientable');
    }

}
