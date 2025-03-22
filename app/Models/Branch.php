<?php

namespace App\Models;

use App\Models\Admin\Item;
use App\Models\Admin\Unit;
use App\Models\Admin\Staff;
use App\Models\Admin\Driver;
use App\Models\PaymentMethod;
use App\Models\Admin\Category;
use App\Models\Admin\Customer;
use App\Models\Admin\Supplier;
use App\Models\Admin\ItemPrice;
use App\Models\Admin\ExpenseCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'branch_name',
        'prefix_inv',
        'location',
        'contact_no',
        'email',
        'social_media',
        'vat',
        'vat_percent',
        'trn_number',
        'image',
        'invoice_header',
        'expiry_date',
        'installation_date',
        'uuid'
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function category()
    {
        return $this->hasMany(Category::class,'branch_id','id');
    }
    public function item()
    {
        return $this->hasMany(Item::class);
    }
    public function unit()
    {
        return $this->hasMany(Unit::class);
    }
    public function supplier()
    {
        return $this->hasMany(Supplier::class);
    }
    public function driver()
    {
        return $this->hasMany(Driver::class);
    }
    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
    public function customer()
    {
        return $this->hasMany(Customer::class);
    }
    public function payment_method()
    {
        return $this->hasMany(PaymentMethod::class);
    }
    public function expense_category()
    {
        return $this->hasMany(ExpenseCategory::class);
    }
    public function item_price()
    {
        return $this->hasMany(ItemPrice::class);
    }

    public function priceSize()
    {
        return $this->hasMany(PriceSize::class);
    }
    // public function credit_sale()
    // {
    //     return $this->hasMany(User::class);
    // }
    // public function settle_sale()
    // {
    //     return $this->hasMany(User::class);
    // }

    public static function boot() {
        parent::boot();

        static::deleting(function($branch) {
            $branch->users()->delete();
            $branch->category()->delete();
            $branch->item()->delete();
            $branch->unit()->delete();
            $branch->supplier()->delete();
            $branch->driver()->delete();
            $branch->staff()->delete();
            $branch->customer()->delete();
            $branch->payment_method()->delete();
            $branch->expense_category()->delete();
            $branch->item_price()->delete();
            $branch->priceSize()->delete();
        });
    }
}
