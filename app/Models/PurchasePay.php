<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchasePay extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'purchase_pay_log';
        protected $fillable = [
        'branch_id',
        'purchase_id',
        'payment_type',
        'price',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Relationship with Purchase model.
     * Assuming you have a Purchase model.
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * Relationship with Branch model, if needed.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
