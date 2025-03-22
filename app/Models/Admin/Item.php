<?php

namespace App\Models\Admin;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id','unit_id','item_name','item_other_name','item_cost_price',
                            'multiple_price','item_price','barcode','stock',
                            'image','expiry_date','active','item_type','stock_applicable','branch_id','uuid','ingredient','minimum_qty', 'item_slug'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function itemprice()
    {
        return $this->hasMany(ItemPrice::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function($item) {
            $item->itemprice()->each(function($itemprice) {
                $itemprice->delete(); // This will trigger the delete in the Item model
            });
        });
    }

}
