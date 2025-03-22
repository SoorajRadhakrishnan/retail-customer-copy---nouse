<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "purchase_orders";

    protected $fillable = [
        'supplier_id',
        'invoice_no',
        'status',
        'tax_amount',
        'total_amount',
        'payment_status',
        'user_id',
        'shop_id',
        'uuid',
    ];

    // public function getRouteKeyName(): string
    // {
    //     return 'uuid';
    // }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'shop_id','id');
    }
}
