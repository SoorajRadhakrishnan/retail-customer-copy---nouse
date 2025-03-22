<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleOrderItems extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sale_order_items';

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id','id');
    }

    public function sale_orders()
    {
        return $this->belongsTo(SaleOrders::class,'sale_order_id','id');
    }
}
