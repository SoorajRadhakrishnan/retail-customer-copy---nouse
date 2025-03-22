<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key','value'];

    // ['currency','decimal_point','date_format','time_format','unit_price','stock_check','stock_show','settle_check_pending','delivery_sale',];

}
