<?php

namespace App\Models\Admin;

use App\Models\Branch;
use App\Models\PriceSize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockManageItem extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'stock_manage_items';

    protected $fillable = ['stock_manage_id', 'item_price_id', 'item_price_size_id', 'item_id', 'qty', 'received_qty'];

    public function getTransfer()
    {
        return $this->belongsTo(StockManage::class, 'stock_manage_id', 'id');
    }

    public function getItem()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function getItemPrice()
    {
        return $this->belongsTo(ItemPrice::class, 'item_price_id', 'id');
    }

    public function getItemPriceSize()
    {
        return $this->belongsTo(PriceSize::class, 'item_price_size_id', 'id');
    }
}
