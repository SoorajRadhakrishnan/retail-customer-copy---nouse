<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleOrders extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sale_orders';

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'shop_id','id');
    }

    public function sale_order_items()
    {
        return $this->hasMany(SaleOrderItems::class,'sale_order_id','id');
    }

    public function sale_order_payments()
    {
        return $this->hasMany(SaleOrderPayment::class,'sale_order_id','id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($sale) {
            $sale->sale_order_items()->delete();
            $sale->sale_order_payments()->delete();
        });
    }
}
