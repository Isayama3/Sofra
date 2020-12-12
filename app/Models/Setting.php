<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('about_us', 'app_commission', 'alahly_account_num', 'raghy_account_num', 'account_name');

}