<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleOrderPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sale_order_payments';

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id','id');
    }

    public function sale_orders()
    {
        return $this->belongsTo(SaleOrders::class,'sale_order_id','id');
    }

    protected $fillable = [
        'sale_order_id',
        'payment_type',
        'amount',
        'currency',
        'multiplier',
        'created_at',
        'real_amount',
        'sub_payment_type',
        'remarks',
        'order_type',
        'user_id',
        'shop_id',
    ];
}
