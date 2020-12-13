<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $table = 'payment';
    public $timestamps = true;
    protected $fillable = array('rest_of_money','paid_money', 'notes','app_commission', 'date', 'restaurant_sales', 'restaurant_id');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}
