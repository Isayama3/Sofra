<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('name','created_at');

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
