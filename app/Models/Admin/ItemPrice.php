<?php

namespace App\Models\Admin;

use App\Models\Branch;
use App\Models\PriceSize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemPrice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['item_id','price_size_id','price','stock','branch_id','cost_price','barcode', 'price_item_type', 'total_cost_price'];

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id','id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class,'item_id','id');
    }

    public function pricesize()
    {
        return $this->belongsTo(PriceSize::class,'price_size_id','id');
    }

    public function deliveryServicePrice()
    {
        return $this->hasMany(ItemDeliveryServicePrice::class, 'item_price_id', 'id');
    }

}
